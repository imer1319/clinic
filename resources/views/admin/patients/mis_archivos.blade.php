@extends('layouts.admin.layout')

@section('title', 'Detalle del paciente')

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
                        <h2>{{ $paciente->name }} {{ $paciente->profile->surnames }}</h2>
                        <p>{{ $paciente->profile->nacimiento }} </p>
                        <p> {{ $edad }} años </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-right">
                        <span>Genero</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $paciente->profile->gender }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>CI</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $paciente->profile->ci }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Correo</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $paciente->email }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Celular</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $paciente->profile->celular }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <span>Direccion</span>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $paciente->profile->address }}</p>
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
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diaries as $diary)
                        <tr>
                            <td>{{ $diary->doctor->name }} {{ $diary->doctor->profile->surnames }}</td>
                            <td>{{ $diary->date_cita->format('M d') }}</td>
                            <td>{{ $diary->hora_cita->format('H:i A') }}</td>
                            <td>{{ $diary->status }}</td>
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
                <div class="d-flex justify-content-between">
                    <h6><b>Consulta médica: </b>C</h6>
                    <h6><b>Receta médica: </b>R</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h6><b>Estudios de laboratorio: </b>E</h6>
                    <H6 class="d-flex justify-content-end">
                        <b>Historial: &nbsp;</b><a target="_blank" href="{{ route('admin.historialPatient.pdf', auth()->id()) }}" class="btn btn-sm btn-primary">Ver</a>
                    </H6>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>C</th>
                            <th>R</th>
                            <th>E</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                        <tr>
                            <td>{{ $consultation->doctor->name }} {{ $consultation->doctor->profile->surnames }}</td>
                            <td>{{ $consultation->created_at->format('M d') }}</td>
                            <td>{{ $consultation->created_at->format('H:i A') }}</td>
                            <td>
                                <a target="_blank" href="{{ route('admin.consultaPatient.pdf', $consultation) }}" class="btn btn-sm btn-primary">Ver</a>
                            </td>
                            <td>
                                <a target="_blank" href="{{ route('admin.recetaPatient.pdf', $consultation) }}" class="btn btn-sm btn-primary">Ver</a>
                            </td>
                            <td>
                                <a target="_blank" href="{{ route('admin.pruebasPatient.pdf', $consultation) }}" class="btn btn-sm btn-primary">Ver</a>
                            </td>
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
