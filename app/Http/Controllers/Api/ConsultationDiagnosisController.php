<?php

namespace App\Http\Controllers\Api;

use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ConsultationDiagnosis;

class ConsultationDiagnosisController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->load('diagnoses');
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'diagnosis_id' => 'required|numeric|exists:App\Models\Diagnosis,id'
        ]);

        return ConsultationDiagnosis::create($request->all());
    }

    public function destroy(ConsultationDiagnosis $consultationDiagnosis)
    {
        return $consultationDiagnosis->delete();
    }
}
