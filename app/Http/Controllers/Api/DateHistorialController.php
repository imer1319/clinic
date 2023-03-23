<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\DateHistorial;

class DateHistorialController extends Controller
{
    public function index(Patient $patient)
    {
        return $patient->dateHistorial;
    }

    public function update(Request $request, DateHistorial $dateHistorial)
    {
        $request->validate([
            'date_historial' => 'nullable|date|date_format:Y-m-d|before_or_equal:'. date("Y-m-d"),
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id'
        ]);

        return $dateHistorial->update($request->all());
    }
}
