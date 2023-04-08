<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\PhysicalExploration;
use App\Models\PhysicalExplorationQuestion;
use Illuminate\Http\Request;

class PhysicalExplorationController extends Controller
{
    public function index(Consultation $consultation)
    {
        return PhysicalExploration::with(['physicalExplorationQuestions' => function ($query) use ($consultation) {
            $query->where('physical_exploration_questions.consultation_id', $consultation->id);
        }])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'physical_exploration_id' => 'required|numeric|exists:App\Models\PhysicalExploration,id',
            'answer' => 'required|min:4'
        ]);

        return PhysicalExplorationQuestion::create($request->all());
    }

    public function update(Request $request, PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'physical_exploration_id' => 'required|numeric|exists:App\Models\PhysicalExploration,id',
            'answer' => 'required|min:4'
        ]);

        return $physicalExplorationQuestion->update($request->all());
    }

    public function destroy(PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        return $physicalExplorationQuestion->delete();
    }
}
