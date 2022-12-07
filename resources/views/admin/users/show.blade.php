@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Vista usuario</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Roles</th>
                                <td class="d-flex flex-wrap">
                                    @forelse ($user->roles as $role)
                                        <span>{{ $role->name }}</span>
                                    @empty
                                        <span>No tiene rol asignado</span>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Permisos adicionales</th>
                                <td class="d-flex flex-wrap">
                                    @forelse ($user->permissions as $permission)
                                        <span class="badge bg-green m-1">{{ $permission->display_name }}</span>
                                    @empty
                                        <span>No tiene permisos adicionales</span>
                                    @endforelse
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
