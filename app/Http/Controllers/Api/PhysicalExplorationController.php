<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\PhysicalExploration;
use App\Models\PhysicalExplorationQuestion;
use Illuminate\Http\Request;
use App\Http\Requests\PhysicalExploration\StoreRequest;

class PhysicalExplorationController extends Controller
{
    public function index(Consultation $consultation)
    {
        return PhysicalExploration::with(['physicalExplorationQuestions' => function ($query) use ($consultation) {
            $query->where('physical_exploration_questions.consultation_id', $consultation->id);
        }])->get();
    }

    public function store(StoreRequest $request)
    {
        return PhysicalExplorationQuestion::create($request->validated());
    }

    public function update(StoreRequest $request, PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        return $physicalExplorationQuestion->update($request->validated());
    }

    public function destroy(PhysicalExplorationQuestion $physicalExplorationQuestion)
    {
        return $physicalExplorationQuestion->delete();
    }
}
