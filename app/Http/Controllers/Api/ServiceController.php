<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Consultation $consultation)
    {
        return Service::with(['consultations' => function($query) use($consultation){
            $query->where('consultations.id', $consultation->id);
        }])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return Service::create($request->all());
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|min:5',
            'status' => 'required|in:ACTIVO,BAJA',
        ]);

        return $service->update($request->all());
    }
}
