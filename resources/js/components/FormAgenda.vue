<template>
    <div>
        <h5>Agendar consulta</h5>
        <div id="errors"></div>
        <div class="form-group">
            <select id="doctor_id" class="form-control">
                <option value="0" selected>Seleccione un doctor</option>
                @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor -> user -> name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" id="motivo" placeholder="Motivo de la consulta" class="form-control">
        </div>
        <div class="form-group">
            <input id="timePickr" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" id="date_cita" class="form-control" placeholder="Selecciona la fecha">
            <input type="hidden" id="patient_id" value="{{ $patient->id }}">
            <input type="hidden" id="patient" value="{{ $patient->name }} {{ $patient->surnames }}">
        </div>
        <div class="form-group mb-0">
            <button id="addDiary" class="btn btn-primary btn-block">Programar consulta</button>
        </div>
    </div>
</template>
<script>
export default {

}
</script>