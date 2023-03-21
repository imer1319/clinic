<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->prescriptions;
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'medicamento' => 'required',
            'concentracion' => 'required',
            'tomar' => 'required|numeric',
            'durante' => 'required|numeric',
            'frecuencia' => 'required|numeric',
        ]);

        return Prescription::create($request->all());
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
    }
}
