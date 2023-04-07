<template>
    <div>
        <div class="alert alert-danger" role="alert" v-if="errors.length">
            <b>Por favor corriga los siguientes errores:</b>
            <ul>
                <li v-for="error in errors">
                    <p v-for="err in error">{{ err[0] }}</p>
                </li>
            </ul>
        </div>
        <form @submit.prevent="updateOrCreate" v-if="can('explorations_store')">
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <input v-model="form.question" class="form-control" placeholder="Pregunta">
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
                        <th scope="col">Pregunta</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="exploration in explorations">
                        <td class="cursor-pointer" @click.prevent="show(exploration)">{{ exploration.question }}
                        </td>
                        <td>{{ exploration.status }}</td>
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
                question: '',
                status: 'ACTIVO'
            },
            explorations: [],
            errors: []
        }
    },
    methods: {
        show(exploration) {
            this.form.id = exploration.id
            this.form.question = exploration.question
            this.form.status = exploration.status
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.question = ''
            this.form.status = 'ACTIVO'
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/explorations')
                .then(response => {
                    this.explorations = response.data;
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
            axios.post('/api/explorations/store', this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        question: '',
                        status: 'ACTIVO'
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/explorations/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        status: 'ACTIVO',
                        question: '',
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }
    }
}
</script>