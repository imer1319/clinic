<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input v-model="form.medicine" class="form-control" placeholder="Medicina">
                    </div>
                    <div class="form-group">
                        <input v-model="form.concentration" class="form-control" placeholder="Concentracion">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select class="form-control" v-model="form.status">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="BAJA">BAJA</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end">
                <a v-if="form.id" @click.prevent="cancelarEdicion" class="btn btn-secondary text-white mb-0">Cancelar</a>
                <button type="submit" class="btn btn-success mb-0">{{ txt_button }}</button>
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
                        <th scope="col">Medicamento</th>
                        <th scope="col">Concentracion</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="medicine in filteredMedicines">
                        <td class="cursor-pointer" @click.prevent="show(medicine)">{{ medicine.medicine }}
                        </td>
                        <td>{{ medicine.concentration }}</td>
                        <td>{{ medicine.status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.get();
        this.errors = []
    },
    data() {
        return {
            txt_button: 'Guardar',
            form: {
                id: '',
                medicine: '',
                concentration: '',
                status: 'ACTIVO'
            },
            medicines: [],
            errors: [],
            search: ''
        }
    },
    methods: {
        show(medicine) {
            this.form.id = medicine.id
            this.form.medicine = medicine.medicine
            this.form.concentration = medicine.concentration
            this.form.status = medicine.status
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.medicine = ''
            this.form.concentration = ''
            this.form.status = 'ACTIVO'
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/medicines')
                .then(response => {
                    this.medicines = response.data;

                })
        },
        updateOrCreate() {
            if (this.form.id) {
                this.update(this.form);
            }
            else {
                this.store();
            }
        },
        store() {
            axios.post('/api/medicines/store', this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        medicine: '',
                        concentration: '',
                        status: 'ACTIVO'
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/medicines/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        status: 'ACTIVO',
                        medicine: '',
                        concentration: '',
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }
    },
    computed: {
        filteredMedicines() {
            return this.medicines.filter(medicine => {
                return medicine.medicine.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>