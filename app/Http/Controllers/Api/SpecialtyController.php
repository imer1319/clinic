<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        return Specialty::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return Specialty::create($request->all());
    }

    public function update(Request $request, Specialty $specialty)
    {
        $request->validate([
            'description' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $specialty->update($request->all());
    }
}
