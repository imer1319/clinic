<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;
use App\Models\Doctor;
use App\Models\VitalSigns;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:patients_index')->only(['index', 'datatables']);
        $this->middleware('permission:patients_create')->only(['create', 'store']);
        $this->middleware('permission:patients_show')->only('show');
        $this->middleware('permission:patients_edit')->only(['edit', 'update']);
        $this->middleware('permission:patients_destroy')->only('destroy');
    }

    public function datatables()
    {
        return DataTables::of(Patient::select('id', 'name', 'surnames', 'ci')->orderBy('id', 'Desc'))
            ->addColumn('btn', 'admin.patients.partials.btn')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function index()
    {
        return view('admin.patients.index');
    }

    public function create()
    {
        $patient = new Patient();
        return view('admin.patients.create', compact('patient'));
    }

    public function store(StoreRequest $request)
    {
        $patient = (new Patient)->fill($request->validated());

        if ($request->hasFile('image')) {

            $patient->image = $request->file('image')->store('public/images');
        }
        $patient->save();

        return redirect()->route('admin.patients.index')->with('flash', 'Paciente creado corretamente');
    }

    public function show(Patient $patient)
    {
        $fecha_nacimiento = $patient->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.patients.show', [
            'patient' => $patient,
            'diaries' => $patient->diaries()->latest()->get(),
            'consultations' => $patient->consultations()->latest()->get(),
            'edad' => $edad_diff->format('%y'),
            'doctors' => Doctor::with('user')->get(),
            'vitals' => VitalSigns::orderBy('created_at', 'desc')->where('patient_id', $patient->id)->first(),
        ]);
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(UpdateRequest $request, Patient $patient)
    {
        if ($request->hasFile('image')) {

            $patient->image = $request->file('image')->store('public/images');
        }
        $patient->update($request->except(['image']));

        return redirect()->route('admin.patients.show', $patient->id)->with('flash', 'Paciente actualizado corretamente');
    }

    public function destroy(Patient $patient)
    {
        $patient->image()->delete();

        $patient->delete();

        return redirect()->route('admin.patients.index')->with('flash', 'Doctor eliminado corretamente');
    }
}
