<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\StudioInstruction;
use Illuminate\Http\Request;

class StudioInstructionController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->studiosInstruction;
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'instructions' => 'nullable',
        ]);

        return StudioInstruction::create($request->all());
    }

    

    public function update(Request $request, StudioInstruction $studioInstruction)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'instructions' => 'required',
        ]);

        return $studioInstruction->update($request->all());
    }
}
