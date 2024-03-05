<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\User;
use App\Models\Horario;
use App\Models\Notification;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class DiaryController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:users,id',
            'date_cita' => 'required|date',
            'hora_cita' => 'required|date_format:H:i',
        ]);

        $doctorId = $request->doctor_id;
        $dateCita = $request->date_cita;
        $horaCita = $request->hora_cita;

        $doctorSchedule = Horario::where('doctor_id', $doctorId)
        ->where('active', true)
        ->where('dia_semana', Carbon::parse($dateCita)->dayOfWeek -1)
        ->first();
        if (!$doctorSchedule) {
            $diasSemana = [
                "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"
            ];
            $diasHabiles = Horario::where('doctor_id', $doctorId)
            ->where('active', true)
            ->pluck('dia_semana')
            ->map(function ($dia) use ($diasSemana) {
                return $diasSemana[$dia];
            })->implode(', ');

            $mensajeError = 'El doctor no tiene horario disponible para la fecha seleccionada. Los días hábiles son: ' . $diasHabiles;

            return response()->json([
                'error' => $mensajeError
            ], 400);
        }

        $horaInicioManana = Carbon::parse($dateCita . ' ' . $doctorSchedule->morning_start);
        $horaFinManana = Carbon::parse($dateCita . ' ' . $doctorSchedule->morning_end);
        $horaInicioTarde = Carbon::parse($dateCita . ' ' . $doctorSchedule->afternoon_start);
        $horaFinTarde = Carbon::parse($dateCita . ' ' . $doctorSchedule->afternoon_end);

        $horaCitaCarbon = Carbon::parse($dateCita . ' ' . $horaCita);

        if (
            ($horaCitaCarbon >= $horaInicioManana && $horaCitaCarbon < $horaFinManana) ||
            ($horaCitaCarbon >= $horaInicioTarde && $horaCitaCarbon < $horaFinTarde)
        ) {
        } else {
            return response()->json(['error' => 'La hora seleccionada está fuera del horario disponible del doctor.'], 400);
        }

        $horaCitaCarbon = Carbon::createFromFormat('H:i', $horaCita);
        $fechaActual = Carbon::now();
        $fechaHoraCompleta = $fechaActual->toDateString() . ' ' . $horaCitaCarbon->toTimeString();

        $existingAppointment = Diary::where('doctor_id', $doctorId)
        ->where('hora_cita', $fechaHoraCompleta)
        ->first();
        
        if ($existingAppointment) {
            $citasOcupadas = Diary::where('doctor_id', $doctorId)
            ->where('date_cita', $dateCita)
            ->pluck('hora_cita')
            ->map(function ($hora) {
                return Carbon::parse($hora)->format('H:i');
            });

            if ($citasOcupadas->count() > 0) {
                $horasOcupadas = $citasOcupadas->implode(', ');
                return response()->json(['error' => 'Ya existe una cita reservada para la fecha y hora seleccionadas. Horas ocupadas: ' . $horasOcupadas], 400);
            }
        }


        Diary::create([
            'doctor_id' => $doctorId,
            'patient_id' => $request->patient_id,
            'status' => 'En espera',
            'date_cita' => $dateCita,
            'hora_cita' => $horaCita,
            'motivo' => $request->motivo,
        ]);

        Notification::create([
            'user_id' => $doctorId,
            'body' => "Tienes una cita el $request->date_cita a las $request->hora_cita Hrs con el paciente $request->patient",
        ]);

        //return response()->json(['message' => 'Cita médica creada correctamente.', 'appointment' => $newAppointment]);
        return response()->json(['message' => 'Cita médica creada correctamente.'], 200);
    }

    public function destroy(Diary $diary)
    {
        return $diary->delete();
    }
}
