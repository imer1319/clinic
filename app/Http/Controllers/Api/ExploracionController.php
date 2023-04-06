<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\PhysicalExploration;
use Illuminate\Http\Request;

class ExploracionController extends Controller
{
    public function index()
    {
        return PhysicalExploration::with('physicalExplorationQuestions')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return PhysicalExploration::create($request->all());
    }


    public function update(Request $request, PhysicalExploration $physicalExploration)
    {
        $request->validate([
            'question' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $physicalExploration->update($request->all());
    }
}
