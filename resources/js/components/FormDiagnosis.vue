<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input v-model="form.name" class="form-control" placeholder="Diagnostico">
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
                        <th scope="col">Diagnostico</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="diagnosis in filteredDiagnoses">
                        <td class="cursor-pointer" @click.prevent="show(diagnosis)">{{ diagnosis.name }}
                        </td>
                        <td>{{ diagnosis.status }}</td>
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
                name: '',
                status: 'ACTIVO'
            },
            services: [],
            errors: [],
            search: ''
        }
    },
    methods: {
        show(diagnosis) {
            this.form.id = diagnosis.id
            this.form.name = diagnosis.name
            this.form.status = diagnosis.status
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.name = ''
            this.form.status = 'ACTIVO'
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/services')
                .then(response => {
                    this.services = response.data;

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
            axios.post('/api/services/store', this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        name: '',
                        status: 'ACTIVO'
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/services/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        status: 'ACTIVO',
                        name: '',
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }
    },
    computed: {
        filteredDiagnoses() {
            return this.services.filter(diagnosis => {
                return diagnosis.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>