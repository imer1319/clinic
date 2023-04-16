<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoryPatient;
use App\Models\HistoryType;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\HistoryPatient\StoreRequest;

class HistoryPatientController extends Controller
{
    public function index(User $patient)
    {
        return HistoryType::with(['historyQuestions' => function ($query) use ($patient) {
            $query->with(['historyPatient' => function ($q) use ($patient) {
                $q->where('history_patients.patient_id', $patient->id);
            }]);
        }])->get();
    }

    public function store(StoreRequest $request)
    {
        return HistoryPatient::create($request->validated());
    }

    public function update(StoreRequest $request, HistoryPatient $historyPatient)
    {
        return $historyPatient->update($request->validated());
    }
}
