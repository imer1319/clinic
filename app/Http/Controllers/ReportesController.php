<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\HistoryType;
use App\Models\Consultation;
use App\Models\PhysicalExploration;

class ReportesController extends Controller
{
    public function historialPatient(User $patient)
    {
        $this->authorize('view', $patient->historyPatient);

        $fecha_nacimiento = $patient->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        $pdf = \PDF::loadView('historialPatientPdf', [
            'patient' => $patient,
            'histories' => HistoryType::with(['historyQuestions' => function ($query) use ($patient) {
                $query->with(['historyPatient' => function ($q) use ($patient) {
                    $q->where('history_patients.patient_id', $patient->id);
                }]);
            }])->get(),
            'edad' => $edad_diff->format('%y'),
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        $fecha = date('Y-m-d');
        return $pdf->stream("Reporte historial-" . $fecha . "-paciente'. $patient->name .'.pdf");
    }

    public function recetaPatient(Consultation $consultation)
    {
        $this->authorize('view', $consultation);

        $fecha_nacimiento = $consultation->patient->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        $pdf = \PDF::loadView('recetaPatientPdf', [
            'patient' => $consultation->patient,
            'prescriptions' => $consultation->prescriptions,
            'vital_signs' => $consultation->vitalSigns,
            'edad' => $edad_diff->format('%y'),
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        $fecha = date('Y-m-d');
        return $pdf->stream("Reporte historial-" . $fecha . "-paciente'. $consultation->patient->name .'.pdf");
    }

    public function pruebasPatient(Consultation $consultation)
    {
        $this->authorize('view', $consultation);

        $fecha_nacimiento = $consultation->patient->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        $pdf = \PDF::loadView('estudiosPatientPdf', [
            'patient' => $consultation->patient,
            'subservicios' => $consultation->subservices,
            'imagenes' => $consultation->archives,
            'instrucciones' => $consultation->studiosInstruction,
            'edad' => $edad_diff->format('%y'),
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        $fecha = date('Y-m-d');
        return $pdf->stream("Reporte historial-" . $fecha . "-paciente'. $consultation->patient->name .'.pdf");
    }

    public function consultaPatient(Consultation $consultation)
    {
        $this->authorize('view', $consultation);

        $fecha_nacimiento = $consultation->patient->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        $pdf = \PDF::loadView('consultationPatientPdf', [
            'exploracions' => PhysicalExploration::with(['physicalExplorationQuestions' => function ($query) use ($consultation) {
                $query->where('physical_exploration_questions.consultation_id', $consultation->id);
            }])->get(),
            'patient' => $consultation->patient,
            'consultation' => $consultation,
            'medicamentos' => $consultation->prescriptions,
            'medicalInstruction' => $consultation->medicalInstruction,
            'vital_signs' => $consultation->vitalSigns,
            'edad' => $edad_diff->format('%y'),
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed' => TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        $fecha = date('Y-m-d');
        return $pdf->stream("Reporte historial-" . $fecha . "-paciente'. $consultation->patient->name .'.pdf");
    }
}
