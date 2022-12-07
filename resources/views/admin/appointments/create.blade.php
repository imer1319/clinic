@extends('layouts.admin.layout')

@section('title', 'Citas medicas')

@section('content')
<div class="container">
    <div id="full-calendar"></div>
</div>
<div class="modal fade" id="modalFullCalendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cita_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="errors"></div>
                <input type="hidden" id="cita_id">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="total">Total</label>
                        <div id="total">0</div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cita_date">Fecha de la cita</label>
                        <input type="date" class="form-control" id="cita_date">
                    </div>
                    <div class='form-group col-md-4'>
                        <label for="time_start">Hora de inicio</label>
                        <input type="time" id="time_start" class="form-control">
                    </div>
                    <div class='form-group col-md-4'>
                        <label for="time_end">Hora de salida</label>
                        <input type="time" id="time_end" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cita_color">Color</label>
                        <input type="color" class="form-control" value="#ff0000" id="cita_color">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="doctor_id">Doctor:</label>
                        <select id="doctor_id"
                        class="form-control @error('doctor_id') is-invalid @enderror">
                        <option value="">Seleccionar doctor</option>
                        @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ old('doctor_id', $appointment->doctor_id) === $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="patient_id">Paciente:</label>
                        <select id="patient_id"
                        class="form-control @error('patient_id') is-invalid @enderror">
                        <option value="">Seleccionar paciente</option>
                        @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}"
                            {{ old('patient_id', $appointment->patient_id) === $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="subServices">Sub servicios</label>
                        <div class="row">
                            @foreach ($subServices as $subService)
                            <div class="checkbox col-md-4">
                                <label>
                                    <input name="subServices[]" id="subServices[]" type="checkbox" data-cy="subServ_{{ $subService->id }}" value="{{ $subService->id }}" {{ $appointment->subServices->contains($subService->id) || collect(old('subServices'))->contains($subService->id) ? 'checked' : '' }}>
                                    <span>{{ $subService->name }}: </span>
                                </label>
                                <b id="price_{{ $subService->id }}">{{ $subService->price }}</b>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="observations">Observaciones</label>
                        <textarea id="observations" rows="2" class="form-control">{{ old('observations', $appointment->observations) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @can('appointments_create')
                <button type="button" class="btn btn-success" id="addCita">Agregar</button>
                @endcan
                @can('appointments_edit')
                <button type="button" class="btn btn-warning" id="updateCita">Editar</button>
                @endcan
                @can('appointments_destroy')
                <button type="button" class="btn btn-danger" id="destroyCita">Borrar</button>
                @endcan
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('styles')
<link href="{{ asset('admin/vendors/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendors/fullcalendar/dist/fullcalendar.print.css') }}" rel="stylesheet" media="print">
<!-- Switchery -->
<link href="{{ asset('admin/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
<style>
    .fc-event, .fc-event:hover, .ui-widget .fc-event{
        color: #fff !important;
    }
</style>

@endsection

@section('scripts')
<!-- Switchery -->
<script src="{{ asset('admin/vendors/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#full-calendar').fullCalendar({
            monthNames: [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
            ],
            monthNamesShort: [
            'Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'
            ],
            dayNames: [
            'Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'
            ],
            dayNamesShort: [
            'Dom','Lun','Mar','Mié','Jue','Vie','Sáb'
            ],
            buttonText:{
               today: 'hoy',
               month: 'mes',
               week: 'semana',
               day: 'dia',
               list: 'lista'
           },
           selectable: false,
           selectHelper: true,
           editable: false,
           displayEventTime: false,
           events: '/api/citas',
           header: {
            left: 'prev,today,next',
            center: 'title',
            right: 'month,basicWeek,basicDay,agendaWeek'
        },
        dayClick: function(date) {
            $('#addCita').css("display", "block");
            $('#updateCita').css("display", "none");
            $('#destroyCita').css("display", "none");
            var currentDate = new Date()
            var day = currentDate.getDate()
            if(date.isBefore(new Date(moment().format('Y-MM-DD')))) {
                $('#full-calendar').fullCalendar('unselect');
                return false;
            }
            $('#cita_title').html("Crear cita medica");
            cleanForm();
            $('#cita_date').val(date.format());
            $('#modalFullCalendar').modal();
        },
        eventClick: function(calEvent) {
            $('#addCita').css("display", "none");
            $('#updateCita').css("display", "block");
            $('#destroyCita').css("display", "block");
            cleanForm();
            calEvent.sub_services.forEach(item => {
                $('input[type=checkbox]').each(function () {
                    if($(this).val() == item.id){
                        $(this).prop('checked',true) 
                    }
                });
            })
            $('#cita_title').html("Editar cita medica");
            $('#cita_id').val(calEvent.id);
            $('#cita_date').val(calEvent.start.format());
            $('#cita_color').val(calEvent.color);
            $('#time_start').val(calEvent.time_start);
            $('#time_end').val(calEvent.time_end);
            $('#doctor_id').val(calEvent.doctor_id);
            $('#patient_id').val(calEvent.patient_id);
            $('#observations').val(calEvent.observations);
            $('#total').html(calEvent.total);
            console.log(calEvent.total)
            $('#modalFullCalendar').modal();
        },
        eventDrop: function(calEvent) {
            $('#cita_id').val(calEvent.id);
            $('#txtTitle').val(calEvent.name);
            $('#txtColor').val(calEvent.color);
            $('#txtAmount').val(calEvent.amount);
            $('#txtDescription').val(calEvent.description);
            $('#txtFechaInicio').val(calEvent.start.format('Y-MM-DD'));
            $('#txtFechaFin').val(calEvent.end.format('Y-MM-DD'));
            recolectarDatosGUI();
            addCita('/api/events/' + newCita.id, 'PUT', newCita, true);
        },
        select: function(start, end) {
            $('#addCita').css("display", "block");
            $('#updateCita').css("display", "none");
            $('#destroyCita').css("display", "none");

            $('#cita_title').html("Crear cita medica");
            cleanForm();
            $('#txtFechaInicio').val(start.format());
            $('#txtFechaFin').val(end.format());
            $('#modalFullCalendar').modal();
        }
    });

        let newCita;
        $('#addCita').click(function() {
            recolectarDatosGUI();
            addCita('/appointments', 'POST', newCita);
        });

        $('#updateCita').click(function() {
            recolectarDatosGUI();
            addCita('/appointments/' + newCita.id, 'PUT', newCita);
        });

        $('#destroyCita').click(function() {
            recolectarDatosGUI();
            addCita('/appointments/' + newCita.id, 'DELETE', newCita);
        });

        $("input[name='subServices[]']").click(function() {
            let sum = 0
            var checked = [];
            $("input[name='subServices[]']:checked").each(function (){
                checked.push(parseInt($("#price_"+$(this).val()).html()))
            });
            checked.forEach(price => {
                sum +=price
            })
            $("#total").html(sum)
        });
        function recolectarDatosGUI() {
            var checked = []
            $("input[name='subServices[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            newCita = {
                id: $('#cita_id').val(),
                start: $('#cita_date').val(),
                title: 'Cita a las '+ $('#time_start').val(),
                color: $('#cita_color').val(),
                time_start: $('#time_start').val(),
                time_end: $('#time_end').val(),
                patient_id: $('#patient_id').val(),
                doctor_id: $('#doctor_id').val(),
                observations: $('#observations').val(),
                total: $('#total').html(),
                subServices: checked,
            }
        }

        function addCita(url, type, objEvent, modal) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: type,
                url: url,
                data: objEvent,
                success: function() {
                    $('#errors').html("");
                    $('#full-calendar').fullCalendar('refetchEvents');
                    if (!modal) {
                        $('#modalFullCalendar').modal('toggle');
                    }
                    cleanForm();
                },
                error: function(xhr, status, error){
                    $('#errors').html("");
                    var response = JSON.parse(xhr.responseText);
                    var errorString = '<div class="alert alert-danger"><ul>';
                    $.each( response.errors, function( key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul></div>';
                    $("#errors").append(errorString);
                }
            });
        }

        function cleanForm() {
            $('#cita_id').val('');
            $('#cita_color').val('');
            $('#time_start').val('');
            $('#time_end').val('');
            $('#doctor_id').val('');
            $('#patient_id').val('');
            $('#observations').val('');
            $('#total').html("");
            $('#errors').html("");
            $("input[name='subServices[]']:checked").each(function (){
                $(this).prop('checked', false);
            });
        }
    });
</script>
@endsection