<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\VitalSigns;
use Illuminate\Http\Request;

class VitalSignsController extends Controller
{
    public function index(Patient $patient)
    {
        return VitalSigns::latest()->where('patient_id',$patient->id)->first();
    }
    
    public function update(Request $request, VitalSigns $vitalSigns)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'altura' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'temp' => 'nullable|numeric',
            'fr' => 'nullable|numeric',
            'pa' => 'nullable|numeric',
            'fc' => 'nullable|numeric'
        ]);
        return $vitalSigns->update($request->all());
    }
}
