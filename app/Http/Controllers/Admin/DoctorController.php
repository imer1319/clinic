<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Requests\Doctor\StoreRequest;
use App\Http\Requests\Doctor\UpdateRequest;
use App\Models\Appointment;
use App\Models\Horario;
use App\Models\Specialty;
use App\Models\User;
use App\Models\Profile;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        return DataTables::of(User::with('profile','profile.specialty')->doctors()->select('id','name', 'username'))
        ->addColumn('speciality', function (User $user) {
            return optional(optional($user->profile)->specialty)->description;
        })
        ->addColumn('ci', function (User $user) {
            return optional($user->profile)->ci;
        })
        ->filterColumn('ci', function ($query, $keyword) {
            $query->whereHas('profile', function ($q) use ($keyword) {
                $q->where('ci', 'LIKE', "%{$keyword}%");
            });
        })
        ->addColumn('btn', 'admin.doctors.partials.btn')
        ->rawColumns(['btn','ci', 'speciality'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.doctors.index');
    }

    public function create()
    {
        $doctor = new User;
        $specialties = Specialty::all();
        return view('admin.doctors.create',compact('doctor','specialties'));
    }

    public function store(StoreRequest $request)
    {
        $user = (new User)->fill($request->validated());
        $user->password = $request->ci;
        $user->save();

        $user->profile()->create($request->validated());

        $user->assignRole('Doctor');

        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor creado corretamente');
    }

    public function show(User $doctor)
    {
        $fecha_nacimiento = $doctor->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.doctors.show', [
            'user' => $doctor,
            'edad' => $edad_diff->format('%y'),
            'diaries' => $doctor
            ->diariesDoctor()
            ->where('status','En espera')
            ->where('date_cita','>=',date('Y-m-d'))
            ->orderBy('date_cita')
            ->get(),
            'consultations' => $doctor->consultationsDoctor()->take(5)->get(),
        ]);
    }

    public function edit(User $doctor)
    {
        $specialties = Specialty::all();
        $doctor->load('profile');
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    public function update(UpdateRequest $request, User $doctor)
    {
        $doctor->update($request->validated());
        // por si cambia de ci, cambiara tambien la contraseña
        $doctor->password = $request->ci;
        $doctor->save();

        if ($request->hasFile('image')) {
            $doctor->profile->image = $request->file('image')->store('public/images');
        }
        $doctor->profile()->update([
            'surnames' => $request->surnames,
            'ci' => $request->ci,
            'nacimiento' => $request->nacimiento,
            'address' => $request->address,
            'celular' => $request->celular,
            'gender' => $request->gender,
            'specialty_id' => $request->specialty_id,
            'image' => $doctor->profile->image
        ]);
        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor actualizado corretamente');
    }

    public function destroy(User $doctor)
    {
        $url = str_replace('storage', 'public', $doctor->profile->image);

        Storage::delete($url);

        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor eliminado corretamente');
    }
}
