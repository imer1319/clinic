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
                <a href="" target="_blank" class="btn border" id="imprimirHistorial">
                    <img src="/imagenes/impresora.png" alt="impresora" width="35">
                &nbsp;Imprimir </a>
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
                                <h5>Agendar consulta</h5>
                                <div id="errors"></div>
                                <div class="form-group">
                                    <select id="doctor_id" class="form-control">
                                        <option value="0" selected>Seleccione un doctor</option>
                                        @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="motivo" placeholder="Motivo de la consulta"
                                    class="form-control">
                                </div>
                                <div class="form-group">
                                    <input id="timePickr" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="date_cita" class="form-control"
                                    placeholder="Selecciona la fecha">
                                    <input type="hidden" id="patient_id" value="{{ $patient->id }}">
                                    <input type="hidden" id="patient"
                                    value="{{ $patient->name }} {{ $patient->surnames }}">
                                </div>
                                <div class="form-group mb-0">
                                    <button id="addDiary" class="btn btn-primary btn-block">Programar consulta</button>
                                </div>
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
                <div class="card mt-2 pre-scrollable">
                    <h6 class="pt-2 px-2">CONSULTAS AGENDADAS</h6>
                    @forelse ($diaries as $diary)
                    <form action="{{ route('admin.diaries.update', $diary) }}" method="POST" onclick="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="motivo" value="{{ $diary->motivo }}">
                        <input type="hidden" name="doctor_id" value="{{ $diary->doctor->id }}">
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <button type="submit" style="background: inherit; color: #5A738E; border: none; width: 100%; margin: 0;"
                        onclick="return confirm('¿Seguro que desea iniciar esta consulta?')">
                        <div class="mx-1 mt-1 mb-2 p-2 b-left-agenda border-consulta a_hover">
                            <div class="row">
                                <div class="col-3 text-center d-flex flex-column justify-content-between">
                                    <span class="h5">{{ $diary->date_cita->format('d') }}</span>
                                    <span class="h6 text-capitalize">{{ $diary->date_cita->formatLocalized('%b') }}</span>
                                </div>
                                <div class="col-9 border-left d-flex flex-column text-left">
                                    <span class="d-flex justify-content-between">
                                        <span><i>Dr. {{ $diary->doctor->user->name }}</i></span>
                                        <span>{{ $diary->hora_cita->format('H:i A') }}</span>
                                    </span>
                                    <span><b>{{ $diary->motivo }}</b></span>
                                    <span class="text-primary">{{ $diary->status }}</span>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
                @empty
                <span class="mx-auto">Aún no hay citas </span>
                @endforelse
            </div>
            <div class="card mt-2 pre-scrollable">
                <h6 class="pt-2 px-2">CONSULTAS INICIADAS</h6>
                @forelse ($consultations as $consultation)
                <a href="{{ route('admin.consultations.edit', $consultation) }}" class="a_hover">
                    <div class="mx-1 mt-1 mb-2 p-2 b-left-consulta border-consulta a_hover">
                        <div class="row">
                            <div class="col-3 text-center">
                                <span class="h5">{{ $consultation->created_at->format('d') }}</span><br>
                                <span class="h6">{{ $consultation->created_at->format('M') }}</span><br>
                                <span>{{ $consultation->created_at->format('Y') }}</span>
                            </div>
                            <div class="col-9 border-left d-flex flex-column justify-content-between">
                                <span class="d-flex justify-content-between">
                                    <span><i>Dr. {{ $consultation->doctor->user->name }}</i></span>
                                    <span>{{ $consultation->hora }}</span>
                                </span>
                                <span><b>{{ $consultation->motivo }}</b></span>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

        button:focus {
            outline: none;
        }
    </style>
    @endsection
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

    <script>
        var hoy = new Date();
        var maxFecha = new Date();
        maxFecha.setDate(hoy.getDate() + 14);

        $("#timePickr").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minTime: "08:00",
            maxTime: "21:00",
            defaultDate: "08:00",
            time_24hr: false,
            minuteIncrement: 30
        });
        $("#date_cita").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: maxFecha,
            locale: "es",
            i18n: {
                es: {
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
                        longhand: [
                            "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                            "Sábado"
                            ]
                    },
                    months: {
                        shorthand: [
                            "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
                            ],
                        longhand: [
                            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                            "Septiembre", "Octubre", "Noviembre", "Diciembre"
                            ]
                    }
                }
            },
            onValueUpdate: function(selectedDates, dateStr, instance) {
                instance.close();
            }
        });
        $('#showAgenda').click(function() {
            $('.showAgenda').toggle();
        });
        let newCita = '';
        $('#addDiary').click(function() {
            recolectarDatos();
            addAgenda('/api/diaries', 'POST', newCita);
        });

        function recolectarDatos() {
            newCita = {
                date_cita: $('#date_cita').val(),
                patient: $('#patient').val(),
                doctor_id: $('#doctor_id').val(),
                patient_id: $('#patient_id').val(),
                motivo: $('#motivo').val(),
                hora_cita: $('#timePickr').val(),
            }
        }

        $('#imprimirHistorial').click(function() {
            $("#imprimirHistorial").attr("href","http://www.google.es");
        });

        function addAgenda(url, type, objEvent) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: type,
                url: url,
                data: objEvent,
                success: function() {
                    $('#errors').html("");
                    window.location.reload()
                },

                error: function(xhr, status, error) {
                    $('#errors').html("");
                    var response = JSON.parse(xhr.responseText);
                    var errorString = '<div class="alert alert-danger"><ul>';
                    $.each(response.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul></div>';
                    $("#errors").append(errorString);
                }
            });


        }
    </script>
    @endsection
