<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\Profile;
use App\Models\Specialty;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users_index')->only(['index', 'datatables']);
        $this->middleware('permission:users_create')->only(['create', 'store']);
        $this->middleware('permission:users_show')->only('show');
        $this->middleware('permission:users_edit')->only(['edit', 'update']);
        $this->middleware('permission:users_destroy')->only('destroy');
    }

    public function datatables()
    {
        return DataTables::of(User::select('id', 'username', 'name'))
            ->addColumn('role', function (User $user) {
                $return = '';
                foreach ($user->roles as $role) {
                    $return .= '<span class="badge badge-primary mr-1">' . $role->name . '</span>';
                }
                return $return;
            })
            ->addColumn('btn', 'admin.users.partials.btn')
            ->rawColumns(['btn', 'role'])
            ->toJson();
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $user = new User();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.users.create', compact('user', 'roles', 'permissions'));
    }

    public function store(StoreRequest $request)
    {
        $user = (new User)->fill($request->validated());

        $user->save();

        Profile::create(['user_id' => $user->id]);
        
        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('admin.users.edit', $user)->with('flash', 'Usuario creado corretamente');
    }

    public function show(User $user)
    {
        $fecha_nacimiento = $user->profile->nacimiento;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));

        $specialty = Specialty::find($user->profile->specialty_id);
        return view('admin.users.show', [
            'user' => $user,
            'specialty' => $specialty,
            'edad' => $edad_diff->format('%y'),
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        $specialties = Specialty::all();
        return view('admin.users.edit', compact('user', 'roles', 'specialties'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }
        return redirect()->route('admin.users.index')->with('flash', 'Usuario actualizado corretamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('flash', 'Usuario eliminado corretamente');
    }
}
