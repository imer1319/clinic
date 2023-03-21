<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        return Laboratory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return Laboratory::create($request->all());
    }

    public function update(Request $request, Laboratory $laboratory)
    {
        $request->validate([
            'description' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $laboratory->update($request->all());
    }
}
