<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryPatient;
use App\Models\HistoryType;
use App\Models\Patient;
use Illuminate\Http\Request;

class HistoryPatientController extends Controller
{
    public function index(Patient $patient)
    {
        return HistoryType::with(['historyQuestions' => function ($query) use ($patient) {
            $query->with(['historyPatient' => function ($q) use ($patient) {
                $q->where('history_patients.patient_id', $patient->id);
            }]);
        }])->get();
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
