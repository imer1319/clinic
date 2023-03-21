@extends('layouts.admin.layout')

@section('title', 'Editar usuario')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar usuario</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input class="form-control" name="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input class="form-control" name="username" value="{{ old('username', $user->username) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">Contraseña:</label>
                            <input name="password" type="password" class="form-control" placeholder="Contraseña">
                            <span class="form-text text-muted">Dejar en blanco si no quieres cambiar la contraseña</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Repita la contraseña:</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                placeholder="Repita la contraseña">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="image">Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image-doctor"
                                    accept="image/*">
                                <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
                            </div>
                            @if ($user->image)
                                <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
                                <br>
                                <img src="{{ Storage::url($user->image) }}" alt="{{ $user->image }}" width="120px">
                            @endif
                        </div>
                        <div class="form-group btn-group">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Regresar</a>
                            <button class="btn btn-primary">Actuaizar usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="text-center">Roles</h5>
                </div>
                <div class="card-body">
                    @role('Admin')
                        <form action="{{ route('admin.users.roles.update', $user) }}" method="POST">
                            @csrf @method('put')

                            @include('admin.roles.checkboxes')

                            <button class="btn btn-primary btn-block">Actualizar roles</button>
                        </form>
                    @else
                        <ul class="list-group">
                            @forelse ($user->roles as $role)
                                <li class="list-group-item">{{ $role->name }}</li>
                            @empty
                                <li class="list-group-item">
                                    <span class="text-muted">No tienes roles para mostrar</span>
                                </li>
                            @endforelse
                        </ul>
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
