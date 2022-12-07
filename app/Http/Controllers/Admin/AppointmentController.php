<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\SubService;
use App\Models\Appointment;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:appointments_index')->only(['index', 'appointments','datatables']);
        $this->middleware('permission:appointments_create')->only(['create', 'store']);
        $this->middleware('permission:appointments_show')->only('show');
        $this->middleware('permission:appointments_edit')->only(['edit', 'update']);
        $this->middleware('permission:appointments_destroy')->only('destroy');
        $this->middleware('permission:invoce_show')->only('pdf');
    }

    public function datatables()
    {
        return DataTables::of(Appointment::orderBy('created_at','DESC')->select('id','start','time_start','time_end','total','status'))
        ->addColumn('btn', 'admin.appointments.partials.btn')
        ->rawColumns(['btn'])
        ->toJson();
    }
    
    public function appointments()
    {
        return Appointment::with(['subServices'])->get();
    }

    public function index()
    {
        return view('admin.appointments.index', [
            'appointments' => Appointment::all(),
        ]);
    }

    public function create()
    {
        return view('admin.appointments.create', [
            'appointment' => new Appointment(),
            'patients' => Patient::all(),
            'subServices' => SubService::orderBy('name','asc')->get(),
            'doctors' => Doctor::all(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        $appointment->subServices()->attach($request->input('subServices'));

        return $appointment;
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', [
            'appointment' => $appointment->withSum('debts as total_debts','amount')->where('id', $appointment->id)->first()
        ]);
    }

    public function update(UpdateRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        $appointment->subServices()->sync($request->input('subServices'));

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->subServices()->detach();

        $appointment->delete();

        return $appointment;
    }

    public function pdf(Appointment $appointment)
    {
        $pdf = \PDF::loadView('pdf', [
            'appointment' => $appointment->withSum('debts as total_debts','amount')->where('id', $appointment->id)->first()
        ]);
        $pdf->setPaper('a4','landscape');
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
        return $pdf->stream("X ray med -".$fecha.".pdf");
    }
}
