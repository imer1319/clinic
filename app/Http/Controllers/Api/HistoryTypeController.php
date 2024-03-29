<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryTypeResource;
use App\Models\HistoryType;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Contracts\Database\Eloquent\Builder;

class HistoryTypeController extends Controller
{
    public function index()
    {
        return HistoryType::with('historyQuestions')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
        ]);

        return HistoryType::create($request->all());
    }
    

    public function update(Request $request, HistoryType $historyType)
    {
        $request->validate([
            'title' => 'required|min:5',
        ]);

        return $historyType->update($request->all());
    }
}
