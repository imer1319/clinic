<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Horario\UpdateRequest;
use App\Models\Horario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    protected $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    
    public function __construct()
    {
        $this->middleware('permission:horarios_edit')->only(['edit', 'update']);
    }

    public function edit(User $doctor)
    {
        $this->authorize('view', $doctor->horarios()->first());

        $horarios = Horario::where('doctor_id', $doctor->id)->get();
        if(count($horarios) > 0){
            $horarios->map(function ($horarios) {
                $horarios->morning_start = (new Carbon($horarios->morning_start))->format('h:i:s');
                $horarios->morning_end = (new Carbon($horarios->morning_end))->format('h:i:s');
                $horarios->afternoon_start = (new Carbon($horarios->afternoon_start))->format('h:i:s');
                $horarios->afternoon_end = (new Carbon($horarios->afternoon_end))->format('h:i:s');
            });
        }else{
            $horarios = collect();
            for ($i=0; $i < 7; ++$i)
                $horarios->push(new Horario());
        }

        $dias = $this->dias;

        return view('admin.horarios.edit', compact('doctor', 'dias','horarios'));
    }

    public function update(Request $request,User $doctor)
    {
        // dd($request->active);
        $active = $request->input('active') ? : [];
        $errors = [];

        for ($i=0; $i < 7; $i++) { 
            if($request->morning_start[$i] > $request->morning_end[$i]){
                $errors [] = 'inconsistencia en el intervalo de las horas en el turno mañana del dia '.$this->dias[$i].'.';
            }
            if($request->afternoon_start[$i] > $request->afternoon_end[$i]){
                $errors [] = 'inconsistencia en el intervalo de las horas en el turno tarde del dia '.$this->dias[$i].'.';
            }
            Horario::updateOrCreate(
                [
                    'dia_semana' => $i,
                    'doctor_id' => $doctor->id
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $request->morning_start[$i],
                    'morning_end' => $request->morning_end[$i],
                    'afternoon_start' => $request->afternoon_start[$i],
                    'afternoon_end' => $request->afternoon_end[$i]
                ]
            );
        }

        if(count($errors) > 0){
            return back()->with(compact('errors'));
        }
        else{
            return back()->with('flash','Los cambios se han guardado correctamente');
        }
    }
}
