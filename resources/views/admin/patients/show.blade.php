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
                    <form-vitales :patient_id="{{ $patient->id }}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <detail-consultation
                :consultations="{{ $patient->consultations->load('diagnoses', 'vitalSigns', 'medicalInstruction', 'medicines') }}">
            </detail-consultation>

            <div class="card mt-2">
                <div class="card-body d-flex justify-content-around">
                    <a class="btn border d-flex align-items-center" data-toggle="modal" data-target="#modalArchive">
                        <img src="/imagenes/clip.png" alt="clip" width="35">
                    </a>
                    <button class="btn border">
                        <img src="/imagenes/impresora.png" alt="impresora" width="35">
                        &nbsp;Imprimir </button>
                </div>
            </div>

            <div class="modal fade" id="modalArchive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Arvhivos del paciente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <archivo-paciente :patient="{{ $patient }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal">Iniciar
                            nueva consulta</a>
                        <a id="showAgenda" class="btn btn-primary text-white cursor-pointer"><i
                                class="fa fa-clock-o"></i></a>
                    </div>
                    <div class="showAgenda">
                        <div class="card">
                            <div class="card-body">
                                <a id="closeAgenda" class="closeAgenda"><i class="fa fa-times"></i></a>
                                <h5>Agendar consulta</h5>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select name="doctor_id" class="form-control">
                                            <option value="0" selected>Seleccione un doctor</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" placeholder="Motivo de la consulta" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div id="datepicker" class="shadow-sm" name="date_cita"></div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block">Programar consulta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                <h6 class="pt-2 px-2">CONSULTAS AGENDADAS</h6>
                @forelse ($patient->consultations as $consultation)
                    <a href="{{ route('admin.consultations.edit', $consultation) }}" class="a_hover pre-scrollable">
                        <div class="mx-1 mt-1 mb-2 p-2 b-left-agenda border-consulta a_hover">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <span class="h5">{{ $consultation->created_at->format('d') }}</span><br>
                                    <span class="h6">{{ $consultation->created_at->format('M') }}</span><br>
                                    <span>{{ $consultation->created_at->format('Y') }}</span>
                                </div>
                                <div class="col-9 border-left d-flex flex-column justify-content-between">
                                    <span class="d-flex justify-content-between">
                                        <span>Dr. {{ $consultation->doctor->user->name }}</span>
                                        <span>{{ $consultation->hora }}</span>
                                    </span>
                                    <span>{{ $consultation->motivo }}</span>
                                    <span>{{ $consultation->motivo }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <span class="mx-auto">Aún no hay citas </span>
                @endforelse
            </div>
            <div class="card mt-2">
                <h6 class="pt-2 px-2">CONSULTAS INICIADAS</h6>
                @forelse ($patient->consultations as $consultation)
                    <a href="{{ route('admin.consultations.edit', $consultation) }}" class="a_hover pre-scrollable">
                        <div class="mx-1 mt-1 mb-2 p-2 b-left-consulta border-consulta a_hover">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <span class="h5">{{ $consultation->created_at->format('d') }}</span><br>
                                    <span class="h6">{{ $consultation->created_at->format('M') }}</span><br>
                                    <span>{{ $consultation->created_at->format('Y') }}</span>
                                </div>
                                <div class="col-9 border-left d-flex flex-column justify-content-between">
                                    <span class="d-flex justify-content-between">
                                        <span>Dr. {{ $consultation->doctor->user->name }}</span>
                                        <span>{{ $consultation->hora }}</span>
                                    </span>
                                    <span>{{ $consultation->motivo }}</span>
                                    <span>{{ $consultation->motivo }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <span class="mx-auto">Aún no hay citas </span>
                @endforelse
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

        .b-left-consulta {
            border-left: 5px solid #0b5fb4;
            border-radius: 10px;
        }

        .b-left-agenda {
            border-left: 5px solid #f66292;
            border-radius: 10px;
        }

        .border-consulta {
            border-top: 1px solid #d9e4eb;
            border-right: 1px solid #d9e4eb;
            border-bottom: 1px solid #d9e4eb;
        }

        .a_hover {
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        .fa-clock-o {
            font-size: 22px
        }

        .a_hover:hover {
            text-decoration: none;
            color: inherit;
        }

        .showAgenda {
            display: none;
            position: absolute;
            top: -50;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .closeAgenda {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            cursor: pointer
        }

        .ui-state-default,
        .ui-widget-content .ui-state-default,
        .ui-widget-header .ui-state-default,
        .ui-button,
        html .ui-button.ui-state-disabled:hover,
        html .ui-button.ui-state-disabled:active {
            border: 1px solid #676668;
            background: #ffffff;
            font-weight: normal;
            color: #34495e;
            border-radius: 50%;
            text-align: center;
            width: 30px;
            height: 30px;
            padding: 5px;
        }

        .ui-widget.ui-widget-content {
            width: 100%
        }

        .ui-datepicker .ui-datepicker-header {
            position: relative;
            padding: 10px 0;
        }

        .ui-datepicker .ui-datepicker-prev,
        .ui-datepicker .ui-datepicker-next {
            top: 10px
        }

        .ui-widget-header {
            background: #f7f7f7;
            color: #080808;
        }
        .ui-widget-content{
            color: #D0CFD8;
        }
        .ui-state-highlight,
        .ui-widget-content .ui-state-highlight,
        .ui-widget-header .ui-state-highlight {
            border: 1px solid #052444;
            background: #0b5fb4;
            color: white;
        }

        .ui-state-active,
        .ui-widget-content .ui-state-active,
        .ui-widget-header .ui-state-active,
        a.ui-button:active,
        .ui-button:active,
        .ui-button.ui-state-active:hover {
            border: 1px solid #052444;
            background: #0b5fb4;
            color: white;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $("#showAgenda").click(function() {
            $(".showAgenda").toggle();
        });

        $("#closeAgenda").click(function() {
            $(".showAgenda").hide();
        });
    </script>
@endsection
