<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Image;
use App\Http\Requests\Doctor\StoreRequest;
use App\Http\Requests\Doctor\UpdateRequest;
use Yajra\Datatables\Datatables;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:doctors_index')->only(['index', 'datatables']);
        $this->middleware('permission:doctors_create')->only(['create', 'store']);
        $this->middleware('permission:doctors_show')->only('show');
        $this->middleware('permission:doctors_edit')->only(['edit', 'update']);
        $this->middleware('permission:doctors_destroy')->only('destroy');
    }
    
    public function datatables()
    {
        return DataTables::of(Doctor::select('id', 'name', 'ci', 'surnames'))
        ->addColumn('btn', 'admin.doctors.partials.btn')
        ->rawColumns(['btn'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.doctors.index');
    }

    public function create()
    {
        $doctor = new Doctor();
        return view('admin.doctors.create', compact('doctor'));
    }

    public function store(StoreRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        $path = $request->file('image')->store('public/images');

        $image = new Image([
            'image' => $path
        ]);
        
        $doctor->image()->save($image);

        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor creado corretamente');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', [
            'doctor' => $doctor
        ]);
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(UpdateRequest $request, Doctor $doctor)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('public/images');

            $doctor->image()->update([
                'image' => $path,
            ]);
        }

        $doctor->update($request->validated());

        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor actualizado corretamente');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->image()->delete();

        $doctor->delete();
        
        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor eliminado corretamente');
    }
}
