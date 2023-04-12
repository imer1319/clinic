@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Editar perfil</h3>
        @include('admin.partials.flash-error')
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="form-group col-md-4">
                    <label for="name">Nombre:</label>
                    <input name="name" value="{{ old('name', auth()->user()->name) }}" type="text" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label for="username">Username:</label>
                    <input name="username" value="{{ old('username', auth()->user()->username) }}" type="text" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label for="email">Email:</label>
                    <input name="email" value="{{ old('email', auth()->user()->email) }}" type="email" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                </div>

                <div class="form-group col-md-4">
                    <label for="password-confirm">Confirmar contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    autocomplete="new-password">
                </div>
                <br>
            </div>
            <h5>Datos adicionales</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="email">Apellidos:</label>
                    <input name="surnames" value="{{ old('surnames', auth()->user()->profile->surnames) }}" type="surnames" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="ci">CI:</label>
                    <input name="ci" value="{{ old('ci', auth()->user()->profile->ci) }}" type="text" class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label for="nacimiento">Fecha de nacimiento</label>
                    <input name="nacimiento" value="{{ old('nacimiento', auth()->user()->profile->nacimiento) }}" type="date"
                    class="form-control">
                </div>

                <div class="form-group col-md-4">
                    <label for="celular">Celular</label>
                    <input name="celular" value="{{ old('celular', auth()->user()->profile->celular) }}" type="text" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Direccion</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address',  auth()->user()->profile->address) }}">
                </div>
                @if(auth()->user()->hasRole('Doctor'))
                <div class="form-group col-md-4">
                    <label for="specialty_id">Especialidad:</label>
                    <select id="specialty_id" name="specialty_id" class="form-control @error('doctor_id') is-invalid @enderror">
                        <option value="">Seleccionar especialidad</option>
                        @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id }}" {{ (old('specialty_id') == $specialty->id) || (auth()->user()->profile->specialty_id == $specialty->id) ? 'selected':'' }}>
                            {{ $specialty->description }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group col-md-4">
                    <label for="gender">Genero :</label>
                    <br>
                    <label class="mr-3">
                        <input type=radio name="gender" value="Masculino"
                        {{ old('gender', auth()->user()->profile->gender) == 'Masculino' ? 'checked' : '' }}>
                        <b>Hombre</b>
                    </label>
                    <label>
                        <input type=radio name="gender" value="Femenino"
                        {{ old('gender',  auth()->user()->profile->gender) == 'Femenino' ? 'checked' : '' }}>
                        <b>Mujer</b>
                    </label>
                </div>
                @if(!auth()->user()->hasRole('Paciente'))
                <div class="form-group col-md-4">
                    <label for="image">Imagen</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image-doctor" accept="image/*">
                        <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
                    </div>
                    <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
                    <br>
                </div>
                <div class="form-group col-md-4">
                    <div class="text-center">
                        @if ( auth()->user()->profile->image)
                        <img src="{{ Storage::url( auth()->user()->profile->image) }}" alt="{{  auth()->user()->name }}" width="120px">
                        @else
                        <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" alt="Avatar" width="100px">
                        @endif
                    </div>
                </div>
                @endif
            </div>
            <div class="form-group btn-group">
                <button class="btn btn-primary">Actualizar datos</button>
            </div>
        </form>
    </div>
</div>
@endsection
