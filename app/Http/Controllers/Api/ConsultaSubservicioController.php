<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\ConsultaSubservicio;

class ConsultaSubservicioController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->load('subservices');
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'subservice_id' => 'required|numeric|exists:subservicios,id'
        ]);

        return ConsultaSubservicio::create($request->all());
    }

    public function destroy(ConsultaSubservicio $consultaSubservicio)
    {
        return $consultaSubservicio->delete();
    }
}
