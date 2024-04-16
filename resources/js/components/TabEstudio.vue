<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Servicios realizados</h5>
                <a v-if="can('create_consulta_subservicio')" class="btn border text-success cursor-pointer"
                    data-toggle="modal_laboratoryStudies" @click="openModal()">
                    <i class="fa fa-plus"></i>
                    &nbsp; Agregar
                </a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Servicio realizado</th>
                                <th>Precio</th>
                                <th>Fecha </th>
                                <th width="30"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(subservicio, index) in consultaSubservicios.subservices" :key="index">
                                <td width="10px">{{ index + 1 }}</td>
                                <td>{{ subservicio.nombre }}</td>
                                <td>{{ subservicio.precio }}</td>
                                <td>{{ subservicio.pivot.created_at | fechaFormateada }}</td>
                                <td class="d-flex">
                                    <h5>
                                        <a @click="showImagenSubservicio(subservicio)">
                                            <img src="/imagenes/clip.png" alt="clip" class="mr-3" width="20">
                                        </a>
                                    </h5>
                                    <h5 v-if="can('destroy_consulta_subservicio')"
                                        @click.prevent="eliminarSubservicio(subservicio)">
                                        <i class="fa fa-trash text-danger cursor-pointer"></i>
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5>Instrucciones medicas</h5>
                    <error-component :errors="errors" />
                    <div class="form-group">
                        <textarea rows="3" v-model="instructciones" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <button @click.prevent="saveStudioInstructions" class="btn border">
                            <img src="/imagenes/guardar.png" alt="guardar" width="35">
                            &nbsp;Guardar </button>
                        <a target="_blank" :href="`/pdf/pruebas/${consultation.id}`" class="btn border">
                            <img src="/imagenes/impresora.png" alt="impresora" width="35">
                            &nbsp;Imprimir </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_imagen" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
            data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"> Imagen subservicio </h5>
                        <button type="button" class="close" @click.prevent="closeImagenSubservicio()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div>{{ subservicioImagen }}</div>
                            <div v-if="!subservicioImagen.imagen || !subservicioImagen.imagen.imagen">
                                <label>Cargar imagen</label>
                                <div class="custom-file">
                                    <input type="file" id="fileInput" @change="selectFile" class="custom-file-input"
                                        accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                            <div v-else>
                                <img :src="`/${subservicioImagen.imagen.imagen.replace('public', 'storage')}`" alt="img"
                                    width="100%" height="400px" />
                            </div>

                        </div>
                        <div class="form-group"
                            v-if="can('create_subservicio_imagen') && !subservicioImagen.imagen">
                            <a @click.prevent="guardarImagenSubservicio()" class="btn btn-primary text-white">Guardar
                                imagen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_laboratoryStudies" tabindex="-1" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Servicios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h6>Filtrar por servicio</h6>
                                <select class="form-control" v-model="servicio_id">
                                    <option :value="sevicio.id" v-for="sevicio in servicios" :key="sevicio.id">{{
                    sevicio.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="pre-scrollable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="subservicio in filterSubservicios">
                                        <td class="cursor-pointer" @click.prevent="saveStudioCarrieOut(subservicio)">
                                            {{ subservicio.nombre }}
                                        </td>
                                        <td>{{ subservicio.precio }}</td>
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
import moment from 'moment';
export default {
    props: ['consultation'],
    mounted() {
        axios.get('/api/laboratoryStudies')
            .then(res => {
                this.laboratoryStudies = res.data;
            })
        this.getServices()
        this.getSubservicios()
        this.getStudiosCarriedOut()
        this.getStudioInstruction()
        this.getConsultaSubservicios()
    },
    data() {
        return {
            laboratoryStudies: [],
            studiesCarriedOut: [],
            search: '',
            instructciones: '',
            errors: [],
            instructions: {},
            servicios: [],
            subservicios: [],
            consultaSubservicios: [],
            servicio_id: 1,
            subservicio: {},
            subservicioImagen: {
                id: '',
                imagen: {}
            },
            imageSubservice: null,
        }
    },
    methods: {
        selectFile(event) {
            this.imageSubservice = event.target.files[0]
        },
        getServices() {
            axios.get('/api/services')
                .then(response => {
                    this.servicios = response.data;
                })
        },
        getSubservicios() {
            axios.get('/api/subservicios')
                .then(response => {
                    this.subservicios = response.data;
                })
        },
        getConsultaSubservicios() {
            axios.get('/api/consultaSubservicio/' + this.consultation.id)
                .then(response => {
                    this.consultaSubservicios = response.data;
                })
        },
        getStudiosCarriedOut() {
            axios.get('/api/consultaSubservicio/' + this.consultation.id)
                .then(res => {
                    this.studiesCarriedOut = res.data;
                })
        },
        getStudioInstruction() {
            axios.get('/api/studioInstruction/' + this.consultation.id)
                .then(res => {
                    this.instructions = res.data;
                    this.instructciones = this.instructions.instructions
                })
        },
        guardarImagenSubservicio() {
            let form = {
                imagen: this.imageSubservice,
                consultation_subservice_id: this.subservicioImagen.id
            }
            let forms = new FormData();
            for (let key in form) {
                forms.append(key, form[key])
            }
            axios.post('/api/imagenSubservicio', forms)
                .then(() => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                    this.getConsultaSubservicios()
                    $('#modal_imagen').modal('hide');
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HAY ERRORES");
                })
        },
        showImagenSubservicio(sub) {
            this.subservicioImagen.id = sub.pivot.id;
            this.consultaSubservicios.consulta_subservicio.forEach(subser => {
                if (subser.id == sub.pivot.id) {
                    if (subser.imagen != null) {
                        this.subservicioImagen.imagen = subser.imagen
                    } else {
                        this.subservicioImagen.imagen = ''
                    }
                }
            })
            $('#modal_imagen').modal('show');
        },
        closeImagenSubservicio() {
            this.subservicioImagen.id = '';
            this.subservicioImagen.imagen = {}; // Reinicializar como un objeto vacío
            $('#modal_imagen').modal('hide');
        },
        openModal() {
            $('#modal_laboratoryStudies').modal('show');
        },
        addToForm(medicine) {
            this.subservicio.consultation_id = medicine.id
            this.subservicio.medicamento = medicine.medicine
            this.subservicio.concentracion = medicine.concentration
            this.subservicio.consultation_id = this.consultation.id
        },
        saveStudioCarrieOut(studio) {
            axios.post('/api/consultaSubservicio', {
                subservice_id: studio.id,
                consultation_id: this.consultation.id,
            })
                .then(() => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                    this.getConsultaSubservicios()
                    $('#modal_laboratoryStudies').modal('hide');
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HAY ERRORES");
                })
        },
        saveStudioInstructions() {
            axios.post('/api/studioInstruction', {
                instructions: this.instructciones,
                consultation_id: this.consultation.id
            }).then(() => {
                this.$toastr.s("SE GUARDO CORRECTMENTE", "");
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HAY ERRORES");
            })
        },
        eliminarSubservicio(consultaSubservicio) {
            axios.delete('/api/consultaSubservicio/' + consultaSubservicio.pivot.id)
                .then(() => {
                    this.getConsultaSubservicios()
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HUBO ERRORES AL ELIMINAR");
                })
        },
    },
    computed: {
        filterSubservicios() {
            let questions = [];
            this.subservicios.map(question => {
                if (question.servicio_id === this.servicio_id) {
                    questions.push(question);
                }
            })
            return questions;
        }
    },
    filters: {
        fechaFormateada(fecha) {
            return moment(new Date(fecha)).format('DD-MM-YYYY HH:mm A')
        }
    }
}
</script>
