<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Subservicio;

class SubservicioController extends Controller
{
    public function index(Consultation $consultation)
    {
        return Subservicio::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:5',
            'precio' => 'required|numeric',
            'status' => 'required|in:ACTIVO,BAJA',
            'servicio_id' => 'required|exists:services,id',
        ]);

        return Subservicio::create($request->all());
    }

    public function update(Request $request, Subservicio $subservicio)
    {
        $request->validate([
            'nombre' => 'required|min:5',
            'precio' => 'required|numeric',
            'status' => 'required|in:ACTIVO,BAJA',
            'servicio_id' => 'required|exists:services,id',
        ]);

        return $subservicio->update($request->all());
    }

}
