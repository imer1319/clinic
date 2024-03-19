<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Doctor;
use App\Models\User;
use App\Models\VitalSigns;
use App\Models\Specialty;
use Illuminate\Support\Facades\Storage;

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
        return DataTables::of(User::patients()->select('id','name', 'username'))
        ->addColumn('ci', function (User $user) {
            return $user->profile->ci;
        })
        ->addColumn('surnames', function (User $user) {
            return $user->profile->surnames;
        })
        ->filterColumn('ci', function ($query, $keyword) {
            $query->whereHas('profile', function ($q) use ($keyword) {
                $q->where('ci', 'LIKE', "%{$keyword}%");
            });
        })
        ->addColumn('btn', 'admin.patients.partials.btn')
        ->rawColumns(['btn','ci','surnames'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.patients.index');
    }

    public function create()
    {
        $patient = new User;
        return view('admin.patients.create',compact('patient'));
    }

    public function store(StoreRequest $request)
    {
     $user = (new User)->fill($request->validated());
     $user->password = $request->ci;
     $user->save();

     $user->profile()->create($request->validated());

     $user->assignRole('Paciente');

     return redirect()->route('admin.patients.index')->with('flash', 'Paciente creado corretamente');
 }

 public function show(User $patient)
 {
    $fecha_nacimiento = $patient->profile->nacimiento;
    $dia_actual = date("Y-m-d");
    $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
    $diaries = $patient->diariesPatient()->where('status','En espera')->where('date_cita','>=',date('Y-m-d'))->orderBy('date_cita')->get();
    return view('admin.patients.show', [
        'patient' => $patient,
        'diaries' => $diaries,
        'consultations' => $patient->consultations()->latest()->get(),
        'edad' => $edad_diff->format('%y'),
        'doctors' => User::doctors()->with('profile')->get(),
        'especialidades' => Specialty::all(),
        'vitals' => VitalSigns::orderBy('created_at', 'desc')
        ->where('patient_id', $patient->id)
        ->first(),
    ]);
}

public function edit(User $patient)
{
    return view('admin.patients.edit', compact('patient'));
}

public function update(UpdateRequest $request, User $patient)
{
    $patient->update($request->validated());

    $patient->profile()->update([
        'surnames' => $request->surnames,
        'ci' => $request->ci,
        'nacimiento' => $request->nacimiento,
        'address' => $request->address,
        'celular' => $request->celular,
        'gender' => $request->gender,
        'specialty_id' => $request->specialty_id,
    ]);
    return redirect()->route('admin.patients.index')->with('flash', 'Paciente actualizado corretamente');
}
public function destroy(User $patient)
{
    $patient->delete();

    return redirect()->route('admin.patients.index')->with('flash', 'Paciente eliminado corretamente');
}
}
