<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function citas()
    {
        $fecha_nacimiento = auth()->user()->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.doctors.mis_citas', [
            'doctor' => auth()->user(),
            'edad' => $edad_diff->format('%y'),
            'diaries' => auth()->user()->diariesDoctor()->where('status', 'En espera')->where('date_cita', '>=', date('Y-m-d'))->orderBy('date_cita')->get(),
            'consultations' => auth()->user()->consultationsDoctor()->latest()->take(5)->get(),
        ]);
    }

    public function archivos()
    {
       $fecha_nacimiento = auth()->user()->profile->nacimiento;
       $dia_actual = date("Y-m-d");
       $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
       return view('admin.patients.mis_archivos', [
        'paciente' => auth()->user(),
        'edad' => $edad_diff->format('%y'),
        'diaries' => auth()->user()->diariesPatient()->where('status', 'En espera')->where('date_cita', '>=', date('Y-m-d'))->orderBy('date_cita')->get(),
        'consultations' => auth()->user()->consultations()->latest()->get(),
    ]);
   }
}
