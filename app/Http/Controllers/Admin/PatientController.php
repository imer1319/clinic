<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRequest;
use App\Http\Requests\Patient\UpdateRequest;

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
        return DataTables::of(Patient::select('id', 'name','surnames', 'ci'))
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
        $patient = Patient::create($request->validated());

        $path = $request->file('image')->store('public/images');

        $image = new Image([
            'image' => $path
        ]);
        
        $patient->image()->save($image);

        return redirect()->route('admin.patients.index')->with('flash', 'Paciente creado corretamente');
    }

    public function show(Patient $patient)
    {
        return view('admin.patients.show', [
            'patient' => $patient
        ]);
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(UpdateRequest $request, Patient $patient)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/images');

            $patient->image()->update([
                'image' => $path,
            ]);
        }

        $patient->update($request->validated());

        return redirect()->route('admin.patients.index')->with('flash', 'Paciente actualizado corretamente');
    }

    public function destroy(Patient $patient)
    {
        $patient->image()->delete();

        $patient->delete();
        
        return redirect()->route('admin.patients.index')->with('flash', 'Doctor eliminado corretamente');
    }
}
