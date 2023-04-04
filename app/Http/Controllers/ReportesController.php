<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Patient;
use App\Models\HistoryType;
use App\Http\Resources\HistoryTypeResource;

class ReportesController extends Controller
{
    public function historialPatient(Patient $patient)
    {
        $fecha_nacimiento = $patient->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));

        $pdf = \PDF::loadView('historialPatientPdf', [
            'patient' => $patient,
            'history' => HistoryTypeResource::collection(HistoryType::all()),
            'edad' => $edad_diff->format('%y'),
        ]);
        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );
        $fecha = date('Y-m-d');
        return $pdf->stream("Reporte historial-".$fecha."-paciente'. $patient->name .'.pdf");
    }
}
