<template>
    <div>
        <error-component :errors="errors" />
        <form @submit.prevent="updateOrCreate">
            <div class="row">
                <div class="form-group col-12">
                    <select class="form-control" v-model="form.history_question_id">
                        <option :value="historyType.id" v-for="historyType in historyTypes" :key="historyType.id">{{
                            historyType.title }}</option>
                    </select>
                </div>
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
                    <tr v-for="historyQuestion in filterHistoryType">
                        <td class="cursor-pointer" @click.prevent="show(historyQuestion)">{{ historyQuestion.question }}
                        </td>
                        <td>{{ historyQuestion.status }}</td>
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
        axios.get('/api/historyTypes')
            .then(response => {
                this.historyTypes = response.data;
            })
    },
    data() {
        return {
            txt_button: 'Guardar',
            form: {
                id: '',
                question: '',
                status: 'ACTIVO',
                history_question_id: 1
            },
            errors: [],
            historyTypes: [],
            historyQuestions: []
        }
    },
    methods: {
        show(historyQuestion) {
            this.form.id = historyQuestion.id
            this.form.question = historyQuestion.question
            this.form.history_question_id = historyQuestion.history_question_id
            this.form.status = historyQuestion.status
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
            axios.get('/api/historyQuestions')
                .then(response => {
                    this.historyQuestions = response.data;
                })
        },
        getHistorialTypes() {
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
            axios.post('/api/historyQuestions/store', this.form)
                .then(() => {
                    this.get()
                    this.form = {
                        id: '',
                        question: '',
                        status: 'ACTIVO',
                        history_question_id: 1
                    }
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        },
        update() {
            axios.put('/api/historyQuestions/' + this.form.id, this.form)
                .then(() => {
                    this.get();
                    this.form = {
                        id: '',
                        question: '',
                        status: 'ACTIVO',
                        history_question_id: 1
                    }
                    this.txt_button = 'Guardar'
                    this.errors = []
                }).catch((err) => {
                    this.errors.push(err.response.data.errors);
                })
        }

    },
    computed: {
        filterHistoryType() {
            let questions = [];
            this.historyQuestions.map(question => {
                if (question.history_question_id === this.form.history_question_id) {
                    questions.push(question);
                }
            })
            return questions;
        }
    }
}
</script>