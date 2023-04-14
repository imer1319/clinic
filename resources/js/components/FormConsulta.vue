<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="store">
            <div class="form-group">
                <select v-model="form.doctor_id" class="form-control">
                    <option value="0" selected>Seleccione un doctor</option>
                    <option v-for="doctor in doctors" :value="doctor.id">{{ doctor.name }}</option>
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
        <hr>
        <div class="form-group mx-5">
            <input v-model="search" class="form-control form-control-sm" placeholder="Buscar">
        </div>
        <div class="pre-scrollable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Motivos frecuentes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="consultation in filteredConsultations">
                        <td class="cursor-pointer" @click.prevent="show(consultation)">{{ consultation.motivo }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: ['doctors', 'patient_id'],
    mounted() {
        axios.get('/api/consultations')
            .then(response => {
                this.consultations = response.data;
            });
        this.form.patient_id = this.patient_id
    },
    data() {
        return {
            search: '',
            errors: [],
            consultations: [],
            form: {
                motivo: '',
                doctor_id: 0,
                patient_id: '',
            }
        }
    },
    methods: {
        show(consultation) {
            this.errors = []
            this.form.id = consultation.id
            this.form.motivo = consultation.motivo
            this.form.doctor_id = this.form.doctor_id
            this.store()
        },
        store() {
            this.errors = []
            axios.post('/api/consultations/store', this.form)
                .then((res) => {
                    console.log("imer")
                    console.log(res.data)
                    window.location.href = '/consultations/' + res.data + '/edit';
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }
    },
    computed: {
        filteredConsultations() {
            return this.consultations.filter(consultation => {
                return consultation.motivo.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>