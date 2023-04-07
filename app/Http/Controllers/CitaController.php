<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $fecha_nacimiento = $user->doctor->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.doctors.mis_citas', [
            'doctor' => $user->doctor,
            'edad' => $edad_diff->format('%y'),
            'diaries' => $user->doctor->diaries()->where('status', 'En espera')->where('date_cita', '>=', date('Y-m-d'))->orderBy('date_cita')->get(),
            'consultations' => $user->doctor->consultations()->latest()->get(),
        ]);
    }
}
