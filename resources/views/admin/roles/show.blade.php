@extends('layouts.admin.layout')

@section('title', 'Detalle del rol')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Vista rol</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <th>Display name</th>
                                <td>{{ $role->display_name }}</td>
                            </tr>
                            <tr>
                                <th>Etiquetas</th>
                                <td>
                                    @forelse ($role->permissions as $permission)
                                        <span class="badge bg-green">{{ $permission->display_name }}</span>
                                    @empty
                                        <span>No tiene asignado ningun permiso</span>
                                    @endforelse
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-dark">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
