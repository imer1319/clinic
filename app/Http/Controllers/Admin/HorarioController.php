<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    
    public function edit(Doctor $doctor)
    {
        $dias = $this->dias;
        return view('admin.horarios.edit', [
            'horarios' => $doctor->horarios,
            'doctor' => $doctor,
            'dias' => $dias
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $status = $request->get('status');
        $status_array = array();

        for ($i = 0; $i <= 6; $i++) {
            if (in_array(strval($i), $status)) {
                array_push($status_array, "SI");
            } else {
                array_push($status_array, "NO");
            }
        }
        $errors = [];
        $dias = $this->dias;
        for ($i = 0; $i < 7; $i++) {

            if ($request->morning_start[$i] > $request->morning_end[$i]) {
                $errors[] = 'Inconsistencia en el intervalo de las horas del turno mañana del dia ' . $dias[$i] . '.';
            }
            if ($request->afternoon_start[$i] > $request->afternoon_end[$i]) {
                $errors[] = 'Inconsistencia en el intervalo de las horas del turno tarde del dia ' . $dias[$i] . '.';
            }
            $doctor->horarios[$i]->update([
                'morning_start' => $request->morning_start[$i],
                'morning_end' => $request->morning_end[$i],
                'afternoon_start' => $request->afternoon_start[$i],
                'afternoon_end' => $request->afternoon_end[$i],
                'status' => $status_array[$i]
            ]);
        }

        if (count($errors) > 0) {
            return back()->with(compact('errors'));
        }
        return back()->with('flash', 'Los cambios se han guardado correctamente');
    }
}
