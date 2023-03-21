<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        return Diagnosis::where('status','ACTIVO')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return Diagnosis::create($request->all());
    }

    public function update(Request $request, Diagnosis $diagnosis)
    {
        $request->validate([
            'name' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $diagnosis->update($request->all());
    }
}
