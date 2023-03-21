@extends('layouts.admin.layout')

@section('title', 'Editar doctor')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar doctor</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-3 text-center">
                                @can('doctors_create')
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin.users.edit', $doctor->user_id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    </div>
                                    @if ($doctor->user->image)
                                        <img src="{{ Storage::url($doctor->user->image) }}" alt="{{ $doctor->user->image }}"
                                            width="120px">
                                    @endif
                                @endcan
                            </div>
                            <div class="col-md-9">
                                <div class="form-group col-md-4">
                                    <label for="ci">CI:</label>
                                    <input name="ci" value="{{ old('ci', $doctor->ci) }}" type="text"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="surnames">Apellidos:</label>
                                    <input name="surnames" value="{{ old('surnames', $doctor->surnames) }}" type="text"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="nacimiento">Fecha de nacimiento</label>
                                    <input name="nacimiento" value="{{ old('nacimiento', $doctor->nacimiento) }}"
                                        type="date" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="celular">Celular</label>
                                    <input name="celular" value="{{ old('celular', $doctor->celular) }}" type="text"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Direccion</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $doctor->address) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="specialty_id">Especialidad:</label>
                                    <select id="specialty_id" name="specialty_id"
                                        class="form-control @error('doctor_id') is-invalid @enderror">
                                        <option value="">Seleccionar especialidad</option>
                                        @foreach ($specialties as $specialty)
                                            <option value="{{ $specialty->id }}"
                                                {{ old('specialty_id', $doctor->specialty_id) === $specialty->id ? 'selected' : '' }}>
                                                {{ $specialty->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gender">Genero :</label>
                                    <br>
                                    <label class="mr-3">
                                        <input type=radio name="gender" value="Masculino"
                                            {{ old('gender', $doctor->gender) == 'Masculino' ? 'checked' : '' }}>
                                        <b>Hombre</b>
                                    </label>
                                    <label>
                                        <input type=radio name="gender" value="Femenino"
                                            {{ old('gender', $doctor->gender) == 'Femenino' ? 'checked' : '' }}>
                                        <b>Mujer</b>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group btn-group">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-dark">Regresar</a>
                            <button class="btn btn-primary">Actualizar doctor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
