<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryQuestion;
use Illuminate\Http\Request;

class HistoryQuestionController extends Controller
{
    public function index()
    {
        return HistoryQuestion::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
            'history_question_id' => 'required|numeric|exists:App\Models\HistoryType,id'
        ]);

        return HistoryQuestion::create($request->all());
    }


    public function update(Request $request, HistoryQuestion $historyQuestion)
    {
        $request->validate([
            'question' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
            'history_question_id' => 'required|numeric|exists:App\Models\HistoryType,id'
        ]);

        return $historyQuestion->update($request->all());
    }
}
