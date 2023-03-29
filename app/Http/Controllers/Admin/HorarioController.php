<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function edit(Doctor $doctor)
    {
        return view('admin.horarios.edit', [
            'horarios' => $doctor->horarios,
            'doctor' => $doctor
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        return $request->all();

        // validar los campos
    }
}
