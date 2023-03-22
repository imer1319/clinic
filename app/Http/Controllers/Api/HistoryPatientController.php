<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryPatient;
use Illuminate\Http\Request;
use App\Models\HistoryQuestion;

class HistoryPatientController extends Controller
{
    public function index(HistoryQuestion $historyQuestion)
    {
        return $historyQuestion->patients;
    }

    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required|min:1',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'history_question_id' => 'required|numeric|exists:App\Models\HistoryQuestion,id'
        ]);

        return HistoryPatient::create($request->all());
    }

    public function update(Request $request, HistoryPatient $historyPatient)
    {
        $request->validate([
            'answer' => 'required|min:1',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
            'history_question_id' => 'required|numeric|exists:App\Models\HistoryQuestion,id'
        ]);

        return $historyPatient->update($request->all());
    }
}
