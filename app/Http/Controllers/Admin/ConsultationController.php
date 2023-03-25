<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consultation\StoreRequest;
use App\Http\Requests\Consultation\UpdateRequest;
use App\Models\Consultation;
use App\Models\Reason;
use App\Models\VitalSigns;
use App\Models\DateHistorial;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function index()
    {
        return Consultation::all();
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $consultation = Consultation::create([
                'motivo' => $request->motivo,
                'doctor_id' => $request->doctor_id,
                'patient_id' => $request->patient_id,
            ]);

            VitalSigns::create([
                'consultation_id' => $consultation->id,
                'patient_id' => $request->patient_id,
            ]);

            DateHistorial::create([
                'date_historial' => date('Y-m-d'),
                'patient_id' => $request->patient_id
            ]);
            DB::commit();

            return $consultation->id;
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('flash', 'Error al crear el doctor');
        }
    }

    public  function edit(Consultation $consultation)
    {
        $fecha_nacimiento = $consultation->patient->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.consultations.edit', [
            'consultation' => $consultation,
            'edad' => $edad_diff->format('%y'),
        ]);
    }

    public function update(UpdateRequest $request, Consultation $consultation)
    {
        return $consultation->update($request->validated());
    }
}
