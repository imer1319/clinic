<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\Consultation;

class DiaryController extends Controller
{
    public function update(Request $request, Diary $diary)
    {
        $diary->update([
            'status' => 'Aceptada'
        ]);

        $consultation = Consultation::create([
            'motivo' => $request->motivo,
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
        ]);
        return redirect()->route('admin.consultations.edit', $consultation);
    }
}
