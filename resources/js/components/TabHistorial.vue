<template>
    <div class="row">
        <div class="col-md-4" v-for="historyType in historyTypes">
            <div class="card mb-2">
                <div class="card-body">
                    <h6>{{ historyType.title }}</h6>
                    <div class="pre-scrollable">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Antecedentes</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="question in historyType.history_questions" :key="question.id">
                                    <td>{{ question.question }}</td>
                                    <td @click.prevent="openModal(question)">
                                        {{ question.history_patient ? question.history_patient.answer : '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <error-component :errors="errors" />
                    <label>Fecha de elaboracion</label>
                    <input type="date" v-model="date_historial" class="form-control">
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <button @click.prevent="updateDate" class="btn border">
                            <img src="/imagenes/guardar.png" alt="guardar" width="35">
                        &nbsp;Guardar </button>
                        <a target="_blank" :href="`/pdf/historial/${consultation.patient.id}`" class="btn border">
                            <img src="/imagenes/impresora.png" alt="impresora" width="35">
                        &nbsp;Imprimir </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalPatientAnswer" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ formPatientAnswer.question }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <error-component :errors="errors" />
                        <input type="text" v-model="formPatientAnswer.answer" class="form-control" placeholder="Respuesta" @keyup.enter="createOrUpdatePatientAnswer">
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success"
                            @click.prevent="createOrUpdatePatientAnswer">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['consultation'],
    mounted() {
        this.getHistoryTypes()
        this.getDateHistorial()
    },
    data() {
        return {
            historyTypes: [],
            errors: [],
            formPatientAnswer: {
                id: '',
                question: '',
                patient_id: '',
                history_question_id: '',
                answer: ''
            },
            dateHistorial: [],
            editar: false,
            date_historial: ''
        }
    },
    methods: {
        getDateHistorial() {
            axios.get('/api/dateHistorial/' + this.consultation.patient.id)
            .then(res => {
                this.dateHistorial = res.data
                this.date_historial = this.dateHistorial.date_historial
            })
        },
        getHistoryTypes() {
            axios.get('/api/historyTypes/' + this.consultation.patient.id)
            .then(res => {
                this.historyTypes = res.data
            })
        },
        openModal(question) {
            this.errors = [];
            this.historyTypes[question.history_type_id - 1].history_questions.forEach(element => {
                if (element.question == question.question) {
                    this.formPatientAnswer.question = element.question
                    this.formPatientAnswer.patient_id = this.consultation.patient.id
                    this.formPatientAnswer.history_question_id = element.id
                    if (element.history_patient !== null) {
                        this.formPatientAnswer.id = element.history_patient.id
                        this.formPatientAnswer.answer = element.history_patient.answer
                    } else {
                        this.formPatientAnswer.answer = ""
                    }

                }
            })
            question.history_patient
            ? this.editar = true
            : this.editar = false

            $('#modalPatientAnswer').modal('show');
        },
        createOrUpdatePatientAnswer() {
            if (this.editar) {
                this.updatePatientAnswer()
            } else {
                this.savePatientAnswer()
            }
        },
        updateDate() {
            this.errors = [];
            axios.put('/api/dateHistorial/' + this.dateHistorial.id, {
                patient_id: this.consultation.patient.id,
                date_historial: this.date_historial
            })
            .then(() => {
                this.getDateHistorial()
                this.$toastr.s("SE GUARDARON LOS CAMBIOS CORRECTMENTE", "");
                this.errors = [];

            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("ERROR AL GUARDAR LOS CAMBIOS", "");
            })
        },
        updatePatientAnswer() {
            this.errors = [];
            axios.put('/api/historyPatients/' + this.formPatientAnswer.id, this.formPatientAnswer)
            .then(() => {
                this.getHistoryTypes()
                $('#modalPatientAnswer').modal('hide')
                this.$toastr.s("SE GUARDARON LOS CAMBIOS CORRECTMENTE", "");
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("ERROR AL GUARDAR LOS CAMBIOS", "");
            })
        },
        savePatientAnswer() {
            this.errors = [];
            axios.post('/api/historyPatients', this.formPatientAnswer)
            .then(() => {
                $('#modalPatientAnswer').modal('hide');
                this.getHistoryTypes()
                this.formPatientAnswer = {
                    question: '',
                    patient_id: '',
                    history_question_id: '',
                    answer: ''
                },
                this.errors = [];
                this.$toastr.s("SE GUARDO CORRECTMENTE", "");
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HAY ERRORES");
            })
        }
    }
}
</script>