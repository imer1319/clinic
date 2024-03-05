<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate" v-if="can('historial_store')">
            <div class="row">
                <div class="form-group col-8">
                    <select class="form-control" v-model="form.servicio_id">
                        <option :value="sevicio.id" v-for="sevicio in servicios" :key="sevicio.id">{{
                            sevicio.name }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input v-model="form.precio" type="number" class="form-control" placeholder="Precio">
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <input v-model="form.nombre" class="form-control" placeholder="Nombre del subservicio">
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
        <div class="pre-scrollable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subservicio in filterSubservicios">
                        <td class="cursor-pointer" @click.prevent="show(subservicio)">{{ subservicio.nombre }}
                        </td>
                        <td>{{ subservicio.precio }}</td>
                        <td>{{ subservicio.status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.get()
        this.errors = []
        this.getServices()
    },
    data() {
        return {
            txt_button: 'Guardar',
            form: {
                id: '',
                nombre: '',
                precio: '',
                status: 'ACTIVO',
                servicio_id: 1
            },
            errors: [],
            servicios: [],
            subservicios: []
        }
    },
    methods: {
        show(subservicio) {
            this.form.id = subservicio.id
            this.form.nombre = subservicio.nombre
            this.form.precio = subservicio.precio
            this.form.servicio_id = subservicio.servicio_id
            this.form.status = subservicio.status
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.nombre = ''
            this.form.precio = ''
            this.form.status = 'ACTIVO'
            this.form.servicio_id = 1
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/subservicios')
                .then(response => {
                    this.subservicios = response.data;
                })
        },
        getServices() {
            axios.get('/api/services')
                .then(response => {
                     this.servicios = response.data;
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
            axios.post('/api/subservicios/store', this.form)
                .then(() => {
                    this.get()
                    this.form = {
                        id: '',
                        nombre: '',
                        precio: '',
                        status: 'ACTIVO',
                        servicio_id: this.form.servicio_id
                    }
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/subservicios/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        nombre: '',
                        precio: '',
                        status: 'ACTIVO',
                        servicio_id: this.form.servicio_id
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }

    },
    computed: {
        filterSubservicios() {
            let questions = [];
            this.subservicios.map(question => {
                if (question.servicio_id === this.form.servicio_id) {
                    questions.push(question);
                }
            })
            return questions;
        }
    }
}
</script>