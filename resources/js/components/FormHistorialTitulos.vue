<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate">
            <div class="form-group">
                <input v-model="form.title" class="form-control" placeholder="Titulo">
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
                        <th scope="col">Titulo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="historialType in historyTypes">
                        <td class="cursor-pointer" @click.prevent="show(historialType)">{{ historialType.title }}
                        </td>
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
    },
    data() {
        return {
            txt_button: 'Guardar',
            form: {
                id: '',
                title: '',
            },
            errors: [],
            historyTypes: []
        }
    },
    methods: {
        show(historialType) {
            this.form.id = historialType.id
            this.form.title = historialType.title
            this.txt_button = 'Actualizar'
            this.errors = []
        },
        cancelarEdicion() {
            this.form.id = ''
            this.form.title = ''
            this.txt_button = 'Guardar'
            this.errors = []

        },
        get() {
            axios.get('/api/historyTypes')
                .then(response => {
                    this.historyTypes = response.data;
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
            axios.post('/api/historyTypes/store', this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        title: '',
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/historyTypes/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        title: '',
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