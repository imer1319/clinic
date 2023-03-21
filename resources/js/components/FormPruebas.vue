<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input v-model="form.description" class="form-control" placeholder="Descripcion">
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
                        <th scope="col">Pregunta</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="laboratory in filteredLaboratories">
                        <td class="cursor-pointer" @click.prevent="show(laboratory)">{{ laboratory.description }}
                        </td>
                        <td>{{ laboratory.status }}</td>
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
                description: '',
                status: 'ACTIVO'
            },
            laboratories: [],
            errors: [],
            search: ''
        }
    },
    methods: {
        show(laboratory) {
            this.form.id = laboratory.id
            this.form.description = laboratory.description
            this.form.status = laboratory.status
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.description = ''
            this.form.status = 'ACTIVO'
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/laboratories')
                .then(response => {
                    this.laboratories = response.data;

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
            axios.post('/api/laboratories/store', this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        description: '',
                        status: 'ACTIVO'
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/laboratories/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        status: 'ACTIVO',
                        description: '',
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }
    },
    computed: {
        filteredLaboratories() {
            return this.laboratories.filter(laboratory => {
                return laboratory.description.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>