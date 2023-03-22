<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryQuestion;

class HistoryPatientController extends Controller
{
    public function index(HistoryQuestion $historyQuestion)
    {
        return $historyQuestion->historyPatient;
    }
}
