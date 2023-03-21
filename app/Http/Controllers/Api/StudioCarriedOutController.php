<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\StudioCarriedOut;
use Illuminate\Http\Request;

class StudioCarriedOutController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->load('laboratories');
    }

    public function store(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
            'laboratory_id' => 'required|numeric|exists:App\Models\Laboratory,id'
        ]);

        return StudioCarriedOut::create($request->all());
    }

    public function destroy(StudioCarriedOut $studioCarriedOut)
    {
        return $studioCarriedOut->delete();
    }
}
