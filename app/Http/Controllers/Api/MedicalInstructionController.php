<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\MedicalInstruction;
use Illuminate\Http\Request;

class MedicalInstructionController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->medicalInstruction;
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'instructions' => 'nullable',
        ]);

        return MedicalInstruction::create($request->all());
    }

    

    public function update(Request $request, MedicalInstruction $medicalInstruction)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'instructions' => 'required',
        ]);

        return $medicalInstruction->update($request->all());
    }
}
