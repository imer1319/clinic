<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:services_index')->only(['index', 'datatables']);
        $this->middleware('permission:services_create')->only(['create', 'store']);
        $this->middleware('permission:services_edit')->only(['edit', 'update']);
        $this->middleware('permission:services_destroy')->only('destroy');
    }
    
    public function datatables()
    {
        return DataTables::of(Service::select('id', 'name'))
        ->addColumn('btn', 'admin.services.partials.btn')
        ->rawColumns(['btn'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.services.index');
    }

    public function create()
    {
        $service = new Service();
        return view('admin.services.create', compact('service'));
    }

    public function store(StoreRequest $request)
    {
        Service::create($request->validated());

        return redirect()->route('admin.services.index')->with('flash', 'Servicio creado corretamente');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('admin.services.index')->with('flash', 'Servicio actualizado corretamente');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        
        return redirect()->route('admin.services.index')->with('flash', 'Servicio eliminado corretamente');
    }
}
