<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diary;

class DiaryController extends Controller
{
    public function store(Request $request)
    {
        return $request->all();
        $request->validate([
            'date_cita' => 'required|date|date_format:Y-m-d|after_or_equal:'. date("Y-m-d"),
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'doctor_id' => 'required|numeric|exists:App\Models\Doctor,id',
            'motivo' => 'required',
            'hora_cita' => 'required'
        ]);
        return Diary::create($request->all());

        //crear notificacion
    }
}
