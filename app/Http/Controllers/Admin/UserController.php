<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\StoreRequest;
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
                    $return .= '<span class="badge badge-primary mr-1">' . $role->display_name . '</span>';
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
        $user = User::create($request->validated());

        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }

        if ($request->filled('permissions')) {
            $user->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.users.index')->with('flash', 'Usuario creado corretamente');
    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }

        if ($request->filled('permissions')) {
            $user->givePermissionTo($request->permissions);
        }
        return redirect()->route('admin.users.index')->with('flash', 'Usuario actualizado corretamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('flash', 'Usuario eliminado corretamente');
    }
}
