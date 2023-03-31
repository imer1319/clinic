<template>
    <div>
        <error-component :errors="errors" />
        <h5>Agendar consulta</h5>
        <div id="errors"></div>
        <div class="form-group">
            <select v-model="doctor_id" class="form-control">
                <option value="0" selected>Seleccione un doctor</option>
                <option v-for="doctor in doctors" :value="doctor.id">{{ doctor.user.name }}</option>
            </select>
        </div>
        <div class="form-group">
            <input type="text" v-model="motivo" placeholder="Motivo de la consulta" class="form-control">
        </div>
        <div class="form-group">
            <input @change="getHoras" type="text" v-model="date_cita" id="date_cita" class="form-control" placeholder="Selecciona la fecha">
            <input type="hidden" id="patient_id" :value="patient.id">
            <input type="hidden" id="patient" :value="patient.name">
        </div>
        <template>
            <hr>
            <h6>Horarios disponibles en la mañana</h6>
            <div class="form-group">
                <select v-model="hora_cita" class="form-control">
                    <option value="0">Seleccione un horario</option>
                    <option :value="morning.start" v-for="morning in mornings">De {{ morning.start }} a {{ morning.end }} </option>
                </select>
            </div>
            <h6>Horarios disponibles en la tarde</h6>
            <div class="form-group">
                <select v-model="hora_cita" class="form-control">
                    <option value="0">Seleccione un horario</option>
                    <option :value="afternoon.start"  v-for="afternoon in afternoons">De {{ afternoon.start }} a {{ afternoon.end }} </option>
                </select>
            </div>
        </template>
        <div class="form-group mb-0">
            <button :disabled="btnSent" id="addDiary" class="btn btn-primary btn-block">Programar consulta</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['doctors','patient'],
    data(){
        return {
            btnSent:true,
            motivo:'',
            doctor_id:0,
            date_cita:'',
            hora_cita: 0,
            errors:[],
            mornings:[],
            afternoons:[],
        }
    },
    methods:{
      getHoras(){
        this.errors = []
        let date = $('#date_cita').val()
        let form = {
            doctor_id: this.doctor_id,
            date_cita: date
        }
        axios.get('/api/horas', { params: form })
        .then(res => {
            this.mornings = res.data.morning
            this.afternoons = res.data.afternoon
        })
        .catch(err => {
            if (err.response && err.response.data && err.response.data.errors) {
                this.errors.push(err.response.data.errors);
            }
        })
    }
}
}
</script>