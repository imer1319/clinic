@extends('layouts.admin.layout')

@section('title', 'Detalle del doctor')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Vista doctor</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $doctor->name }}</td>
                            </tr>
                            <tr>
                                <th>Apellidos</th>
                                <td>{{ $doctor->surnames }}</td>
                            </tr>
                            <tr>
                                <th>CI</th>
                                <td>{{ $doctor->ci }}</td>
                            </tr>
                            <tr>
                                <th>Imagen</th>
                                <td>
                                    @if($doctor->image->image)
                                        <img src="{{ Storage::url($doctor->image->image) }}" alt="{{ $doctor->image->image }}" width="120px">
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-dark">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
