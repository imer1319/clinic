@extends('layouts.admin.layout')

@section('title', 'Detalle del doctor')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ Storage::url($doctor->user->image) }}" alt="{{ $doctor->user->image }}" height="80">
                        <div class="ml-3 d-flex flex-column">
                            <h2>{{ $doctor->user->name }}</h2>
                            <p>{{ $doctor->nacimiento }} </p>
                            <p> {{ $edad }} años </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <span>Genero</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->gender }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>CI</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->ci }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>Correo</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->user->email }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>Celular</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->celular }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>Direccion</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->address }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <span>Especialidad</span>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->specialty->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3">Mis proximas citas medicas</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($diaries as $diary)
                                <tr>
                                    <td>{{ $diary->patient->name }}</td>
                                    <td>{{ $diary->date_cita->format('M d') }}</td>
                                    <td>{{ $diary->hora_cita->format('H:i A') }}</td>
                                    <td>{{ $diary->patient->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="text-center mb-3">Mis consultas realizadas</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($consultations as $consultation)
                                <tr>
                                    <td>{{ $consultation->patient->name }}</td>
                                    <td>{{ $consultation->created_at->format('M d') }}</td>
                                    <td>{{ $consultation->created_at->format('H:i A') }}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection