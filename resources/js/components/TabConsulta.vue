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
                                                exploration.physical_exploration_questions ?
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
                                        <error-component :errors="errors" />
                                        <div class="form-group">
                                            <input v-model="answer" type="text" class="form-control"
                                            placeholder="respuesta"
                                            @keyup.enter="createOrUpdateOrDeleteExplorationRespuesta"
                                            >
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>Servicios realizados</h5>
                        <a class="btn border text-success cursor-pointer" data-toggle="modal"
                        data-target="#modal_servicios">
                        <i class="fa fa-plus"></i>
                    &nbsp; Agregar</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Servicio</th>
                            <th width="10px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(service, index) in servicesConsultation" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ service.name }}</td>
                            <td @click.prevent="eliminarServicio(service)">
                                <h5><i class="fa fa-trash-o text-danger cursor-pointer"></i></h5>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>
                <div class="form-group">
                    <h6><b>Diagnostico</b></h6>
                    <textarea v-model="consultation.diagnosis" rows="2" class="form-control"></textarea>
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
                        <input v-model="consultation.vital_signs.altura" class="form-control form-control-sm"
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
                        <input v-model="consultation.vital_signs.peso" class="form-control form-control-sm"
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
                        <input v-model="consultation.vital_signs.temp" class="form-control form-control-sm"
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
                        <input v-model="consultation.vital_signs.fr" class="form-control form-control-sm"
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
                        <input v-model="consultation.vital_signs.pa" class="form-control form-control-sm"
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
                        <input v-model="consultation.vital_signs.fc" class="form-control form-control-sm"
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
                <a target="_blank" :href="`/pdf/consulta/${consultation.id}`" class="btn border">
                    <img src="/imagenes/impresora.png" alt="impresora" width="35">
                &nbsp;Imprimir </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_servicios" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Servicios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Buscar servicio</h6>
                <input v-model="search" class="form-control form-control-sm" placeholder="Buscar"
                style="width: 170px;">
            </div>
            <div class="pre-scrollable">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(service, index) in filteredServices" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td class="cursor-pointer" @click.prevent="saveService(service)">
                                {{ service.name }}
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
</template>
<script>
import axios from 'axios';

export default {
    props: ['consultation'],
    mounted() {
        this.getPhysicalExploration()
        this.getServicesConsultation()
        this.getServices()
    },
    data() {
        return {
            errors: [],
            form_signos_vitales: {},
            form_diagnosticos: {},
            question: '',
            exploration: '',
            answer: '',
            search: '',
            form_consultation: {},
            physicalExploration: [],
            services: [],
            servicesConsultation: [],
            form_exploration_answers: {},
            modificarRespuesta: '',
            oldAnswer: '',
            diagnosis: '',
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
        getServicesConsultation() {
            axios.get('/api/getServices')
            .then(res => {
                this.services = res.data
            })
        },
        getServices() {
            axios.get('/api/services/'+ this.consultation.id)
            .then(res => {
                this.servicesConsultation = res.data
            })
        },
        saveService(service) {
            this.errors = [];
            axios.post('/api/serviceConsultation/'+this.consultation.id, {
                service_id: service.id,
                consultation_id: this.consultation.id,
            })
            .then(() => {
                this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                this.getServices()
                this.errors = [];
                $('#modal_servicios').modal('hide');
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HAY ERRORES");
            })
        },
        eliminarServicio(servicio){
            this.errors = [];
            axios.delete('/api/services/' + this.consultation.id+'/'+servicio.pivot.service_id)
            .then(() => {
                this.getServices()
                this.$toastr.s("SE ELIMINÓ CORRECTMENTE", "");
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HUBO ERRORES AL ELIMINAR");
            })
        },
        getPhysicalExploration() {
            axios.get('/api/physicalExploration/' + this.consultation.id)
            .then(res => {
                this.physicalExploration = res.data;
            }).catch(err => {
                this.errors = err.response.data.errors;
            })
        },
        createOrUpdateOrDeleteExplorationRespuesta() {
            this.form_exploration_answers.answer = this.answer
            if (this.modificarRespuesta == 'guardar') {
                this.addExplorationRespuesta()
                return
            } else if (this.answer === '') {
                this.deleteExplorationRespuesta()
                return
            } if (this.modificarRespuesta == 'editar') {
                this.updateExplorationRespuesta()
                return
            }
        },
        addExplorationRespuesta() {
            this.errors = [];
            axios.post('/api/physicalExploration', this.form_exploration_answers)
            .then(() => {
                this.getPhysicalExploration()
                this.answer = ''
                this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                $('#modal').modal('hide');
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("ERROR AL GUARDAR LOS CAMBIOS", "");
            })
        },
        updateExplorationRespuesta() {
            this.errors = [];
            this.form_exploration_answers.answer = this.answer
            axios.put('/api/physicalExploration/' + this.form_exploration_answers.physical_exploration_id, this.form_exploration_answers)
            .then(() => {
                this.getPhysicalExploration()
                this.answer = ''
                $('#modal').modal('hide');
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("ERROR AL GUARDAR LOS CAMBIOS", "");
            })
        },
        deleteExplorationRespuesta() {
            this.errors = [];
            axios.delete('/api/physicalExploration/' + this.form_exploration_answers.physical_exploration_id, this.form_exploration_answers)
            .then(() => {
                this.getPhysicalExploration()
                this.answer = ''
                $('#modal').modal('hide');
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("ERROR AL GUARDAR LOS CAMBIOS", "");
            })
        },
        guardarTodo() {
            this.errors = []
            let formConsulta = {
                motivo_consulta: this.consultation.motivo_consulta,
                sintoma: this.consultation.sintoma,
                diagnosis: this.consultation.diagnosis,
                doctor_id: this.consultation.doctor_id,
                patient_id: this.consultation.patient_id,
            }

            let formConsultaVitales = {
                consultation_id: this.consultation.id,
                patient_id: this.consultation.patient_id,
                altura: this.consultation.vital_signs.altura,
                peso: this.consultation.vital_signs.peso,
                pa: this.consultation.vital_signs.pa,
                fc: this.consultation.vital_signs.fc,
                fr: this.consultation.vital_signs.fr,
                temp: this.consultation.vital_signs.temp,
            }

            axios.all([
                axios.put('/api/vitalSigns/' + this.consultation.vital_signs.id, formConsultaVitales),
                axios.put('/api/consultations/' + this.consultation.id, formConsulta),
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
        imc() {
            console.log("imer")
            if (this.consultation.vital_signs.altura == null || this.consultation.vital_signs.peso == null) {
                return ''
            }
            return this.calcularIMC(this.consultation.vital_signs.peso, this.consultation.vital_signs.altura);
        },
        filteredServices() {
            return this.services.filter(service => {
                return service.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}   
</script>