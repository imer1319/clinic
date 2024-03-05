<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="store">
            <div class="form-group">
                <select v-model="especialidad_id" class="form-control">
                    <option value="0" selected>Seleccione una especialidad</option>
                    <option v-for="especialidad in especialidades" :key="especialidad.id" :value="especialidad.id">
                        {{ especialidad.description }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <select v-model="form.doctor_id" class="form-control">
                    <option value="0" selected>Seleccione un doctor</option>
                    <option v-for="doctor in filterEspecialidad" :value="doctor.id">{{ doctor.name }}</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <input v-model="form.motivo" class="form-control" placeholder="Motivo">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-success">Iniciar consulta</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['doctors', 'patient_id','especialidades'],
        mounted() {
           this.form.patient_id = this.patient_id
       },
       data() {
        return {
            search: '',
            errors: [],
            consultations: [],
            especialidad_id: 0,
            form: {
                motivo: '',
                doctor_id: 0,
                patient_id: '',
            }
        }
    },
    methods: {
        store() {
            this.errors = []
            axios.post('/api/consultations/store', this.form)
            .then((res) => {
                window.location.href = '/consultations/' + res.data + '/edit';
                this.errors = []
            }).catch((err) => {
                this.errors.push(err.response.data.errors);
            })
        }
    },
    computed: {
        filterEspecialidad() {
            let doctores = [];
            this.doctors.map(doctor => {
                if (doctor.profile.specialty_id === this.especialidad_id) {
                    doctores.push(doctor);
                }
            })
            return doctores;
        }
    }
}
</script>