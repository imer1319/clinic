@extends('layouts.admin.layout')

@section('title', 'Editar paciente')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Actualizar datos del paciente</h3>
                @include('admin.partials.flash-error')
                <form action="{{ route('admin.patients.update', $patient) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="user_id" value="{{ $patient->id }}">
                        <div class="form-group col-md-4">
                            <label for="name">Nombre:</label>
                            <input name="name" value="{{ old('name', $patient->name) }}" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="username">Username:</label>
                            <input name="username" value="{{ old('username', $patient->username) }}" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="email">Email:</label>
                            <input name="email" value="{{ old('email', $patient->email) }}" type="email" class="form-control">
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
                            <input name="surnames" value="{{ old('surnames', $patient->profile->surnames) }}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ci">CI:</label>
                            <input name="ci" value="{{ old('ci', $patient->profile->ci) }}" type="text" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="nacimiento">Fecha de nacimiento</label>
                            <input name="nacimiento" value="{{ old('nacimiento', $patient->profile->nacimiento) }}" type="date"
                            class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="celular">Celular</label>
                            <input name="celular" value="{{ old('celular', $patient->profile->celular) }}" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Direccion</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address',  $patient->profile->address) }}">
                        </div>
                        @if($patient->hasRole('Doctor'))
                        <div class="form-group col-md-4">
                            <label for="specialty_id">Especialidad:</label>
                            <select id="specialty_id" name="specialty_id" class="form-control @error('patient_id') is-invalid @enderror">
                                <option value="">Seleccionar especialidad</option>
                                @foreach ($specialties as $specialty)
                                <option value="{{ $specialty->id }}" {{ (old('specialty_id') == $specialty->id) || ($patient->profile->specialty_id == $specialty->id) ? 'selected':'' }}>
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
                                {{ old('gender', $patient->profile->gender) == 'Masculino' ? 'checked' : '' }}>
                                <b>Hombre</b>
                            </label>
                            <label>
                                <input type=radio name="gender" value="Femenino"
                                {{ old('gender',  $patient->profile->gender) == 'Femenino' ? 'checked' : '' }}>
                                <b>Mujer</b>
                            </label>
                        </div>
                        @if(!$patient->hasRole('Paciente'))
                        <div class="form-group col-md-4">
                            <label for="image">Imagen</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image-patient" accept="image/*">
                                <label class="custom-file-label" for="image-patient">Seleccionar imagen</label>
                            </div>
                            <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
                            <br>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="text-center">
                                @if ( $patient->profile->image)
                                <img src="{{ Storage::url( $patient->profile->image) }}" alt="{{  $patient->name }}" width="120px">
                                @else
                                <img src="{{ Avatar::create( $patient->name )->toBase64() }}" alt="Avatar" width="100px">
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
    </div>
</div>
@endsection
