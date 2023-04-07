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
        return DataTables::of(Doctor::select('id', 'ci', 'user_id', 'specialty_id'))
        ->addColumn('name', function (Doctor $doctor) {
            return $doctor->user->name;
        })
        ->addColumn('username', function (Doctor $doctor) {
            return $doctor->user->username;
        })
        ->addColumn('speciality', function (Doctor $doctor) {
            return $doctor->specialty->description;
        })
        ->addColumn('btn', 'admin.doctors.partials.btn')
        ->rawColumns(['btn', 'name', 'usename', 'speciality'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.doctors.index');
    }

    public function create()
    {
        $doctor = new Doctor();
        $specialties = Specialty::all();
        return view('admin.doctors.create', compact('doctor', 'specialties'));
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = (new User)->fill([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $user->image = $request->file('image')->store('public/images');

            $user->save();

            $user->doctor()->create($request->validated());

            $user->assignRole("Doctor");

            // $dias = ['Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes','Sabado','Domingo'];
            // foreach($dias as $dia)
            // {
            //     Horario::create([
            //         'dia' => $dia,
            //         'morning_start' => '08:00',
            //         'morning_end' => '12:00',
            //         'afternoon_start' => '02:00',
            //         'afternoon_end' => '06:00',
            //         'doctor_id' => $user->doctor->id
            //     ]);
            // }

            DB::commit();

            return redirect()->route('admin.doctors.index')->with('flash', 'Doctor creado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('flash', 'Error al crear el doctor');
        }
    }

    public function show(Doctor $doctor)
    {
        $fecha_nacimiento = $doctor->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        return view('admin.doctors.show', [
            'doctor' => $doctor,
            'edad' => $edad_diff->format('%y'),
            'diaries' => $doctor->diaries()->where('status','En espera')->where('date_cita','>=',date('Y-m-d'))->orderBy('date_cita')->get(),
        ]);
    }

    public function edit(Doctor $doctor)
    {
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    public function update(UpdateRequest $request, Doctor $doctor)
    {
        $doctor->update([
            'surnames' => $request->surnames,
            'ci' => $request->ci,
            'nacimiento' => $request->nacimiento,
            'celular' => $request->celular,
            'address' => $request->address,
            'specialty_id' => $request->specialty_id,
            'gender' => $request->gender,
        ]);
        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor actualizado corretamente');
    }

    public function destroy(Doctor $doctor)
    {
        $url = str_replace('storage', 'public', $doctor->image);
        
        Storage::delete($url);

        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor eliminado corretamente');
    }
}
