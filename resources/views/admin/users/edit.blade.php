@extends('layouts.admin.layout')

@section('title', 'Editar usuario')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Datos del usuario</h5>
                @include('admin.partials.flash-error')
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
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
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Actuaizar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Datos adicionales</h5>
                <form action="{{ route('admin.user.profiles.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group col-md-6">
                            <label for="email">Apellidos:</label>
                            <input name="surnames" value="{{ old('surnames', $user->profile->surnames) }}" type="surnames" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ci">CI:</label>
                            <input name="ci" value="{{ old('ci', $user->profile->ci) }}" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nacimiento">Fecha de nacimiento</label>
                            <input name="nacimiento" value="{{ old('nacimiento', $user->profile->nacimiento) }}" type="date"
                            class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="celular">Celular</label>
                            <input name="celular" value="{{ old('celular', $user->profile->celular) }}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Direccion</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address',  $user->profile->address) }}">
                        </div>
                        @if($user->hasRole('Doctor'))
                        <div class="form-group col-md-6">
                            <label for="specialty_id">Especialidad:</label>
                            <select id="specialty_id" name="specialty_id" class="form-control @error('doctor_id') is-invalid @enderror">
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}" {{ (old('specialty_id') == $specialty->id) || ($user->profile->specialty_id == $specialty->id) ? 'selected':'' }}>
                                    {{ $specialty->description }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group col-md-6">
                            <label for="gender">Genero :</label>
                            <br>
                            <label class="mr-3">
                                <input type=radio name="gender" value="Masculino"
                                {{ old('gender', $user->profile->gender) == 'Masculino' ? 'checked' : '' }}>
                                <b>Hombre</b>
                            </label>
                            <label>
                                <input type=radio name="gender" value="Femenino"
                                {{ old('gender',  $user->profile->gender) == 'Femenino' ? 'checked' : '' }}>
                                <b>Mujer</b>
                            </label>
                        </div>
                        @if(!$user->hasRole('Paciente'))
                        <div class="form-group col-md-6">
                            <label for="image">Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image-doctor" accept="image/*">
                                <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
                            </div>
                            <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
                            <br>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="text-center">
                                @if ( $user->profile->image)
                                <img src="{{ Storage::url( $user->profile->image) }}" alt="{{  $user->name }}" width="120px">
                                @else
                                <img src="{{ Avatar::create( $user->name )->toBase64() }}" alt="Avatar" width="100px">
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Actualizar usuario</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                @role('Administrador')
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
