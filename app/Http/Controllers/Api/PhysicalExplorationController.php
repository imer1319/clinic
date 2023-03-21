<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhysicalExploration;
use App\Models\PhysicalExplorationQuestion;
use Illuminate\Http\Request;

class PhysicalExplorationController extends Controller
{
    public function index(PhysicalExploration $physicalExplorations)
    {
        return $physicalExplorations->with('physicalExplorationQuestions')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'physical_exploration_id' => 'required|numeric|exists:App\Models\Diagnosis,id',
            'answer' => 'required|min:4'
        ]);

        return PhysicalExplorationQuestion::create($request->all());
    }

    public function update(Request $request, PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'physical_exploration_id' => 'required|numeric|exists:App\Models\Diagnosis,id',
            'answer' => 'required|min:4'
        ]);

        return $physicalExplorationQuestion->update($request->all());
    }

    public function destroy(PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        return $physicalExplorationQuestion->delete();
    }
}
