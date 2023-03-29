<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\Doctor;
use App\Models\Notification;

class DiaryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date_cita' => 'required|date|date_format:Y-m-d|after_or_equal:' . date("Y-m-d"),
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'doctor_id' => 'required|numeric|exists:App\Models\Doctor,id',
            'motivo' => 'required',
            'hora_cita' => 'required',
            'user_id' => 'required|numeric|exists:App\Models\User,id',
        ]);

        $doctor = Doctor::findOrFail($request->user_id);
        Diary::create($request->all());
        Notification::create([
            'user_id' => $doctor->user->id,
            'body' => "Tienes una cita el $request->date_cita a las $request->hora_cita Hrs con el paciente $request->patient",
        ]);
        return;
    }

    public function update(Request $request, Diary $diary)
    {
        return $request->all();
    }
}
