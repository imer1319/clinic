<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        return Medicine::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine' => 'required|min:5',
            'concentration' => 'nullable',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return Medicine::create($request->all());
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'medicine' => 'required|min:5',
            'concentration' => 'nullable',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $medicine->update($request->all());
    }
}
