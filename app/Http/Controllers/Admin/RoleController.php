<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles_index')->only(['index','datatables']);
        $this->middleware('permission:roles_create')->only(['create', 'store']);
        $this->middleware('permission:roles_edit')->only(['edit', 'update']);
        $this->middleware('permission:roles_show')->only('show');
        $this->middleware('permission:roles_destroy')->only('destroy');
    }

    public function datatables()
    {
        return DataTables::of(Role::select('id', 'name', 'display_name'))
        ->addColumn('btn', 'admin.roles.partials.btn')
        ->rawColumns(['btn'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create', [
            'role' => new Role(),
            'permissions' => Permission::all()
        ]);
    }

    public function store(StoreRequest $request)
    {
        $role = Role::create($request->validated());

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.roles.index')->withFlash('El rol fue creado correctamente');
    }

    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    public function update(StoreRequest $request, Role $role)
    {
        $role->update($request->validated());
        
        $role->permissions()->detach();

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        return redirect()->route('admin.roles.index', $role)->withFlash('El rol fue actualizado correctamente');
    }

    public function destroy(Role $role)
    {
        if ($role->id === 1 || $role->id === 2) {
            return redirect()->route('admin.roles.index')->withFlash('Este rol no se puede eliminar');
        }

        $role->permissions()->detach();

        $role->delete();

        return redirect()->route('admin.roles.index')->withFlash('El rol fue eliminado');
    }

}
