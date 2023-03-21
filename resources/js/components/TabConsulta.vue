<template>
    <div class="row">
        <div class="col-md-12">
            <error-component :errors="errors" />
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6><b>Exploración física</b></h6>
                            <div class="pre-scrollable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th>Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="exploration in physicalExploration">
                                            <td>{{ exploration.question }}</td>
                                            <td data-toggle="modal"
                                                @click.prevent="openModalExplorationRespuestas(exploration)">
                                                {{
                                                    (exploration.physical_exploration_questions !== null) ?
                                                    exploration.physical_exploration_questions.answer : ''
                                                }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">{{ question }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input v-model="answer" type="text" class="form-control"
                                                        placeholder="respuesta">
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <a data-dismiss="modal" aria-label="Close"
                                                        class="btn btn-secondary text-white mb-0">Cancelar</a>
                                                    <button @click.prevent="createOrUpdateOrDeleteExplorationRespuesta"
                                                        class="btn btn-success mb-0">Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <h6><b>Motivos consulta</b></h6>
                                <textarea v-model="consultation.motivo_consulta" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <h6><b>Sintomas subjetivos</b></h6>
                                <textarea v-model="consultation.sintoma" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6><b>Diagnostico</b></h6>
                                    <a class="btn border text-success cursor-pointer" data-toggle="modal_diagnostics"
                                        @click="openModalExplorationRespuestasDiagnosis()">
                                        <i class="fa fa-plus"></i>
                                        &nbsp; Agregar</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Diagnostico</th>
                                            <th width="20px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(diagnostico, i) in consultationDiagnosis.diagnoses" :key="i">
                                            <td>{{ i + 1 }}</td>
                                            <td>{{ diagnostico.name }}</td>
                                            <td @click.prevent="eliminarDiagnostico(diagnostico.id, i)">
                                                <h5><i class="fa fa-trash text-danger cursor-pointer"></i></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modal_diagnostics" tabindex="-1" aria-labelledby="modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Diagnosticos</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mx-5">
                                                    <input v-model="search" class="form-control form-control-sm"
                                                        placeholder="Buscar">
                                                </div>
                                                <div class="pre-scrollable">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Diagnostico</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="diagnosis in filteredDiagnoses">
                                                                <td class="cursor-pointer"
                                                                    @click.prevent="addDiagnosis(diagnosis)">
                                                                    {{ diagnosis.name }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Signos vitales</h5>
                    <div>
                        <div class="row mt-3">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/altura.png" alt="altura" height="30px">
                                <h6>Altura</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.altura" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>Cm</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/peso.png" alt="altura" height="30px">
                                <h6>Peso</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.peso" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>Kg</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/imc.png" alt="altura" height="30px">
                                <h6>IMC</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="imc" readonly class="form-control form-control-sm" style="width: 60px">
                                <h6>mbi</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/caliente.png" alt="altura" height="30px">
                                <h6>Temp</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.temp" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>°C</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/pulmones.png" alt="altura" height="30px">
                                <h6>F.R.</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.fr" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>r/m</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/brazo.png" alt="altura" height="30px">
                                <h6>P.A.</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.pa" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>mmHg</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <img src="/imagenes/ritmo-cardiaco.png" alt="altura" height="30px">
                                <h6>F.C.</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-between align-items-center">
                                <input v-model="form_signos_vitales.fc" class="form-control form-control-sm"
                                    style="width: 60px">
                                <h6>f.c</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <button @click.prevent="guardarTodo" class="btn border">
                            <img src="/imagenes/guardar.png" alt="guardar" width="35">
                            &nbsp;Guardar </button>
                        <button class="btn border">
                            <img src="/imagenes/impresora.png" alt="impresora" width="35">
                            &nbsp;Imprimir </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: ['consultation'],
    mounted() {
        this.getConsultationDiagnosis()
        this.getPhysicalExploration()
        axios.get('/api/explorations')
            .then(response => {
                this.explorations = response.data;
                this.form_exploracion_fisica = this.explorations.map(exploration => {
                    return {
                        exploration_id: exploration.id,
                        consultation_id: this.consultation.id,
                        question: exploration.question,
                        answer: ''
                    }
                });
            });
        axios.get('/api/diagnoses')
            .then(response => {
                this.diagnoses = response.data;
            })
        this.form_signos_vitales = {
            altura: this.consultation.vital_signs.altura,
            peso: this.consultation.vital_signs.peso,
            temp: this.consultation.vital_signs.temp,
            fr: this.consultation.vital_signs.fr,
            pa: this.consultation.vital_signs.pa,
            fc: this.consultation.vital_signs.fc
        }
    },
    data() {
        return {
            errors: [],
            form_signos_vitales: {},
            form_diagnosticos: {},

            explorations: [],
            question: '',
            exploration: '',
            answer: '',
            form_exploracion_fisica: [],

            diagnoses: [],
            search: '',
            form_consultation: {},
            consultationDiagnosis: [],
            physicalExploration: [],
            form_exploration_answers: {},
            modificarRespuesta: '',
            oldAnswer: ''
        }
    },
    methods: {
        openModalExplorationRespuestas(exploration) {
            this.form_exploration_answers.physical_exploration_id = exploration.id
            this.form_exploration_answers.consultation_id = this.consultation.id
            this.question = exploration.question

            this.exploration_id = exploration.exploration_id

            if (exploration.physical_exploration_questions === null) {
                this.answer = ''
                this.modificarRespuesta = 'guardar'
            } else {
                this.physicalExploration.forEach(element => {
                    if (element.id == exploration.id) {
                        this.answer = element.physical_exploration_questions.answer
                        this.oldAnswer = element.physical_exploration_questions.answer
                        this.modificarRespuesta = 'editar'
                    }
                });
            }
            $('#modal').modal('show');
        },
        openModalExplorationRespuestasDiagnosis() {
            $('#modal_diagnostics').modal('show');
        },
        getConsultationDiagnosis() {
            axios.get('/api/consultationDiagnosis/' + this.consultation.id)
                .then(res => {
                    this.consultationDiagnosis = res.data;
                })
        },
        getPhysicalExploration() {
            axios.get('/api/physicalExploration/' + this.consultation.id)
                .then(res => {
                    this.physicalExploration = res.data;
                })
        },
        addDiagnosis(diagnosis) {
            this.form_diagnosticos = {
                diagnosis_id: diagnosis.id,
                consultation_id: this.consultation.id,
            }
            axios.post('/api/consultationDiagnosis', this.form_diagnosticos)
                .then(() => {
                    this.getConsultationDiagnosis()
                    $('#modal_diagnostics').modal('hide');
                }).catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        createOrUpdateOrDeleteExplorationRespuesta() {
            this.form_exploration_answers.answer = this.answer
            if (this.modificarRespuesta == 'guardar') {
                this.addExplorationRespuesta()
                console.log('guarnd')
                return
            } else if(this.answer === ''){
                this.deleteExplorationRespuesta()
                console.log('eliminando')
                return
            } if (this.modificarRespuesta == 'editar') {
                this.updateExplorationRespuesta()
                console.log('editando')
                return
            }
        },
        addExplorationRespuesta() {
            axios.post('/api/physicalExploration', this.form_exploration_answers)
                .then(() => {
                    this.getPhysicalExploration()
                    this.answer = ''
                    $('#modal').modal('hide');
                }).catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        updateExplorationRespuesta(){
            this.form_exploration_answers.answer = this.answer
            axios.put('/api/physicalExploration/'+this.form_exploration_answers.physical_exploration_id, this.form_exploration_answers)
                .then(() => {
                    this.getPhysicalExploration()
                    this.answer = ''
                    $('#modal').modal('hide');
                }).catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        deleteExplorationRespuesta(){
            axios.delete('/api/physicalExploration/'+this.form_exploration_answers.physical_exploration_id, this.form_exploration_answers)
                .then(() => {
                    this.getPhysicalExploration()
                    this.answer = ''
                    $('#modal').modal('hide');
                }).catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        eliminarDiagnostico(id, index) {
            axios.delete('/api/consultationDiagnosis/' + id)
                .then(res => {
                    this.getConsultationDiagnosis()
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HUBO ERRORES AL ELIMINAR");
                })
        },
        guardarTodo() {
            this.errors = []
            this.form_signos_vitales.consultation_id = this.consultation.id
            this.form_signos_vitales.patient_id = this.consultation.patient.id
            this.form_consultation = {
                motivo_consulta: this.consultation.motivo_consulta,
                sintoma: this.consultation.sintoma,
                doctor_id: this.consultation.doctor_id,
                patient_id: this.consultation.patient_id
            }
            axios.all([
                axios.put('/api/vitalSigns/' + this.consultation.vital_signs.id, this.form_signos_vitales),
                axios.put('/api/consultations/' + this.consultation.id, this.form_consultation),
            ]).then(
                axios.spread((...responses) => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                })
            ).catch((err) => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HAY ERRORES");
            });
        },
        calcularIMC(peso, altura) {
            var alturaMetros = altura / 100;
            var imc = peso / (alturaMetros * alturaMetros);
            return imc.toFixed(2);
        }
    },
    computed: {
        filteredDiagnoses() {
            return this.diagnoses.filter(diagnosis => {
                return diagnosis.name.toLowerCase().includes(this.search.toLowerCase())
            })
        },
        imc() {
            if (this.form_signos_vitales.altura === null && this.form_signos_vitales.peso === null) {
                return ''
            }
            return this.calcularIMC(this.form_signos_vitales.peso, this.form_signos_vitales.altura);
        }
    }
}   
</script>