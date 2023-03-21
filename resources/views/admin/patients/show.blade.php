@extends('layouts.admin.layout')

@section('title', 'Detalle del paciente')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="{{ Storage::url($patient->image) }}" alt="{{ $patient->image }}" width="150">
                        <div class="d-flex flex-column justify-content-between">
                            <h6>EXP: {{ $patient->id }}</h6>
                            <h5><b>{{ $patient->name }}</b></h5>
                            <h5><b>{{ $patient->surnames }}</b></h5>

                            <h6>{{ $edad }} años </h6>
                            <h6>{{ $patient->gender }}</h6>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-sm btn-warning">Editar
                            paciente</a>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h5>Ultimos signos vitales</h5>
                    <form-vitales :readonly="true" :patient_id="{{ $patient->id }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card" style="height: 45vh !important">
                <div class="card-body">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="consultas-tab" data-toggle="tab" href="#consultas" role="tab"
                                aria-controls="consultas" aria-selected="true">Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="recetas-tab" data-toggle="tab" href="#recetas" role="tab"
                                aria-controls="recetas" aria-selected="false">Recetas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane show active" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patient->appointments as $c)
                                        <tr>
                                            <td>{{ $c->id }}</td>
                                            <td>{{ $c->nombre }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                Aun no tiene consultas registradas
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="recetas" role="tabpanel" aria-labelledby="recetas-tab">
                            <div class="pre-scrollable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->appointments as $c)
                                            <tr>
                                                <td>{{ $c->id }}</td>
                                                <td>{{ $c->nombre }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    No hay recetas
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2" style="height: 30vh !important">
                <div class="card-body">
                    <h5>Detalle de la cita</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary btn-block"
                        data-toggle="modal" data-target="#modal">Iniciar nueva consulta</a>
                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Crear consulta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form-consulta :doctors="{{ $doctors }}" :patient_id="{{ $patient->id }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body p-0">
                    <h5 class="p-3">consultas iniciadas</h5>
                    <table class="table mx-2 my-1">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patient->consultations as $consultation)
                                <tr>
                                    <td>{{ $consultation->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.consultations.edit', $consultation) }}">
                                            {{ $consultation->motivo }}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Aun no hay consultas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .pre-scrollable {
            max-height: 40vh;
            overflow-y: scroll;
        }
    </style>
@endsection
