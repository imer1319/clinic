<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubService;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\SubService\StoreRequest;
use App\Http\Requests\SubService\UpdateRequest;

class SubServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subservices_index')->only(['index', 'datatables']);
        $this->middleware('permission:subservices_create')->only(['create', 'store']);
        $this->middleware('permission:subservices_edit')->only(['edit', 'update']);
        $this->middleware('permission:subservices_destroy')->only('destroy');
    }
    
    public function datatables()
    {
        return DataTables::of(SubService::select('id', 'name','price','status'))
        ->addColumn('btn', 'admin.subServices.partials.btn')
        ->rawColumns(['btn'])
        ->toJson();
    }

    public function index()
    {
        return view('admin.subServices.index');
    }

    public function create(Service $service)
    {
        $subservice = new SubService();
        return view('admin.subServices.create', compact('subservice','service'));
    }

    public function store(StoreRequest $request)
    {
        SubService::create($request->validated());

        return redirect()->route('admin.subservices.index')->with('flash', 'Servicio creado corretamente');
    }

    public function show(SubService $subservice)
    {
        return view('admin.subServices.show', compact('subservice'));
    }

    public function edit(SubService $subservice)
    {
        return view('admin.subServices.edit', compact('subservice'));
    }

    public function update(UpdateRequest $request, SubService $subservice)
    {
        $subservice->update($request->validated());

        return redirect()->route('admin.subservices.index')->with('flash', 'Sub servicio actualizado corretamente');
    }

    public function destroy(SubService $subservice)
    {
        $subservice->delete();
        
        return redirect()->route('admin.subservices.index')->with('flash', 'Sub servicio eliminado corretamente');
    }
}
