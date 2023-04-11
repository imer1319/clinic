<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Consultation;

class ServiceConsultationController extends Controller
{
    public function getServices()
    {
        return Service::where('status','ACTIVO')->get();
    }

    public function index(Consultation $consultation)
    {
        return $consultation->services()->select('services.id','services.name')->get();
    }

    public function store(Request $request, Consultation $consultation)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'service_id' => 'required|numeric|exists:App\Models\Service,id'
        ]);
        $consultation->services()->attach([
            'service_id' => $request->service_id
        ]);
        return;
    }

    public function destroy(Consultation $consultation, $id)
    {
        return $consultation->services()->detach([$id]);
    }
}
