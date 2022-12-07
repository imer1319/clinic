@extends('layouts.admin.layout')

@section('title', 'Detalle del paciente')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Detalle del paciente</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Apellidos</th>
                            <td>{{ $patient->surnames }}</td>
                        </tr>
                        <tr>
                            <th>CI</th>
                            <td>{{ $patient->ci }}</td>
                        </tr>
                        <tr>
                            <th>Telefono</th>
                            <td>{{ $patient->phone }}</td>
                        </tr>
                        <tr>
                            <th>Direccion</th>
                            <td>{{ $patient->address }}</td>
                        </tr>
                        <tr>
                            <th>Imagen</th>
                            <td>
                                @if($patient->image->image)
                                <img src="{{ Storage::url($patient->image->image) }}" alt="{{ $patient->image->image }}" width="120px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Citas medicas</th>
                            <td>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Medico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->appointments as $appointment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Carbon\Carbon::parse($appointment->start)->format('d-m-Y'); }}</td>
                                            <td>{{ $appointment->doctor->name }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center" colspan="3">No tiene registradas citas medicas</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-dark">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
