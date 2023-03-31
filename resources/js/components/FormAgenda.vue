<template>
    <div>
        <error-component :errors="errors" />
        <div id="errors"></div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <select v-model="doctor_id" class="form-control" required>
                        <option value="0" selected>Seleccione un doctor</option>
                        <option v-for="doctor in doctors" :value="doctor.id">{{ doctor.user.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" v-model="motivo" placeholder="Motivo de la consulta" class="form-control">
                </div>
                <div class="form-group">
                    <input @change="getHoras" type="text" v-model="date_cita" id="date_cita" class="form-control"
                        placeholder="Selecciona la fecha">
                    <input type="hidden" id="patient_id" :value="patient.id">
                    <input type="hidden" id="patient" :value="patient.name">
                </div>
            </div>
            <div class="col-md-7">
                <div class="d-flex justify-content-between align-items-center">
                    <p>Fecha : {{ date_cita }}</p>
                    <a :disabled="btnSent" href="" class="btn btn-primary">Guardar cita</a>
                </div>
                <div class="pre-scrollable" style="max-height: 60vh !important;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="morning in mornings">
                                    <td>{{ morning.start }}</td>
                                    <td>paciente</td>
                                    <td>motivo</td>
                                    <td>estado</td>
                                </tr>
                                <tr v-for="afternoon in afternoons">
                                    <td>{{ afternoon.start }}</td>
                                    <td>paciente</td>
                                    <td>motivo</td>
                                    <td>estado</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{ disponibles }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['doctors', 'patient'],
    data() {
        return {
            btnSent: true,
            motivo: '',
            doctor_id: 0,
            date_cita: '',
            hora_cita: 0,
            errors: [],
            mornings: [],
            afternoons: [],
            diasDisponibles: []
        }
    },
    methods: {
        getHoras() {
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
                    this.diasDisponibles = res.data.agendas
                })
                .catch(err => {
                    if (err.response && err.response.data && err.response.data.errors) {
                        this.errors.push(err.response.data.errors);
                    }
                })
        }
    },
    computed: {
        disponibles() {
            
        }
    }
}
</script>