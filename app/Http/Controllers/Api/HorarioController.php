<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Horario;

class HorarioController extends Controller
{
    public function horas(Request $request)
    {
        $this->validate($request, [
            'date_cita' => 'required|date_format:"Y-m-d"',
            'doctor_id' => 'required|numeric|exists:App\Models\Doctor,id'
        ]);

        $date_cita = $request->input('date_cita');
        $dateCarbon = new Carbon($date_cita);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i-1);
        $doctorId = $request->input('doctor_id');

        $horario = Horario::where('status', 'SI')
        ->where('dia', $day)
        ->where('doctor_id', $doctorId)
        ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end',
        ]);
        if(!$horario){
            return [];
        }
        $morningIntervalos = $this->getIntevalos(
            $horario->morning_start, $horario->morning_end
        );
        $afternoonIntervalos = $this->getIntevalos(
            $horario->afternoon_start, $horario->afternoon_end
        );
        $data = [];
        $data['morning'] = $morningIntervalos;
        $data['afternoon'] = $afternoonIntervalos;
        return $data;
    }

    private function getIntevalos($start, $end)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervalos = [];
        while($start < $end){
            $intervalo = [];
            $intervalo['start'] = $start->format('g:i A');
            $start->addMinutes(30);
            $intervalo['end'] = $start->format('g:i A');
            $intervalos [] = $intervalo;
        }
        return $intervalos;
    }
}
