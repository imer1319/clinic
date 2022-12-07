@extends('layouts.admin.layout')

@section('title', 'Detalle del sub servicio')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Vista sub servicio</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $subservice->name }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>{{ $subservice->status }}</td>
                        </tr>
                        <tr>
                            <th>Precio</th>
                            <td>{{ $subservice->price }}</td>
                        </tr>
                        <tr>
                            <th>Servicio</th>
                            <td>{{ $subservice->service->name }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    <a href="{{ route('admin.subservices.index') }}" class="btn btn-dark">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
