@extends('layouts.admin.layout')

@section('title', 'Detalle del doctor')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    @if(auth()->user()->profile->image)
                    <img src="{{ Storage::url( auth()->user()->profile->image ) }}" alt="{{ auth()->user()->name  }}" height="150">
                    @else
                    <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" width="150"/>
                    @endif
                    <div class="ml-3 d-flex flex-column">
                        <h2>{{ $doctor->name }}</h2>
                        <p>{{ $doctor->profile->nacimiento }} </p>
                        <p> {{ $edad }} años </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-right">
                        <span>Genero</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->profile->gender }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>CI</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->profile->ci }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Correo</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->email }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Celular</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->profile->celular }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Direccion</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->profile->address }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Especialidad</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->profile->specialty ? $doctor->profile->specialty->description : ''  }}</p>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diaries as $diary)
                        <tr>
                            <td>{{ $diary->patient->name }} {{ $diary->patient->profile->surnames }}</td>
                            <td>{{ $diary->date_cita->format('M d') }}</td>
                            <td>{{ $diary->hora_cita->format('H:i A') }}</td>
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
                <h5 class="text-center mb-3">Mis ultimas consultas realizadas</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                        <tr>
                            <td>{{ $consultation->patient->name }} {{ $consultation->patient->profile->surnames }}</td>
                            <td>{{ $consultation->created_at->format('M d') }}</td>
                            <td>{{ $consultation->created_at->format('H:i A') }}</td>
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
