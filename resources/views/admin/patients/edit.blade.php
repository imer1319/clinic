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
                        <div class="col-12">
                            <span><i>La contraseña será el numero de ci</i> </span>
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
