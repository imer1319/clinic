<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diary;
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

        Diary::create($request->all());
        Notification::create([
            'user_id' => $request->user_id,
            'body' => 'Tienes una cita el ' . $request->date_cita . ' a las ' . $request->hora_cita . ' Hrs',
        ]);
        return;
    }
}
