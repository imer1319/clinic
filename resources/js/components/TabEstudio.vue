<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Estudios de laboratorio</h5>
                <a class="btn border text-success cursor-pointer" data-toggle="modal_laboratoryStudies"
                    @click="openModal()">
                    <i class="fa fa-plus"></i>
                    &nbsp; Agregar</a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Estudios realizado</th>
                                <th>Fecha </th>
                                <th width="20"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="studio in studiesCarriedOut.laboratories">
                                <td>{{ studio.description }}</td>
                                <td>{{ studio.created_at }}</td>
                                <td @click.prevent="eliminarStudioCarrieOut(studio)">
                                    <h5><i class="fa fa-trash text-danger cursor-pointer"></i></h5>
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
                        <button @click.prevent="createOrUpdate" class="btn border">
                            <img src="/imagenes/guardar.png" alt="guardar" width="35">
                            &nbsp;Guardar </button>
                        <a target="_blank" :href="`/pdf/pruebas/${consultation.id}`" class="btn border">
                            <img src="/imagenes/impresora.png" alt="impresora" width="35">
                            &nbsp;Imprimir </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_laboratoryStudies" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Estudios de laboratorio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Buscar estudios</h6>
                            <input v-model="search" class="form-control form-control-sm" placeholder="Buscar"
                                style="width: 170px;">
                        </div>
                        <div class="pre-scrollable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Medicamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="studio in filteredStudio">
                                        <td class="cursor-pointer" @click.prevent="saveStudioCarrieOut(studio)">
                                            {{ studio.description }}
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
        axios.get('/api/laboratoryStudies')
            .then(res => {
                this.laboratoryStudies = res.data;
            })
        this.getStudiosCarriedOut()
        this.getStudioInstruction()
    },
    data() {
        return {
            laboratoryStudies: [],
            studiesCarriedOut: [],
            search: '',
            instructciones: '',
            errors: [],
            instructions: {}
        }
    },
    methods: {
        getStudiosCarriedOut() {
            axios.get('/api/studioCarriedOut/' + this.consultation.id)
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
        createOrUpdate() {
            if (this.instructions.id) {
                this.updateStudioInstructions()
                return
            } else {
                this.saveStudioInstructions()
                return
            }
        },
        openModal() {
            $('#modal_laboratoryStudies').modal('show');
        },
        addToForm(medicine) {
            this.studio.consultation_id = medicine.id
            this.studio.medicamento = medicine.medicine
            this.studio.concentracion = medicine.concentration
            this.studio.consultation_id = this.consultation.id
        },
        saveStudioCarrieOut(studio) {
            axios.post('/api/studioCarriedOut', {
                laboratory_id: studio.id,
                consultation_id: this.consultation.id,
            })
                .then(() => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                    this.getStudiosCarriedOut()
                    $('#modal_laboratoryStudies').modal('hide');
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
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
        eliminarStudioCarrieOut(studio) {
            axios.delete('/api/studioCarriedOut/' + studio.pivot.id)
                .then(() => {
                    this.getStudiosCarriedOut()
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HUBO ERRORES AL ELIMINAR");
                })
        },
        updateStudioInstructions() {
            axios.put('/api/studioInstruction/' + this.instructions.id, {
                instructions: this.instructciones,
                consultation_id: this.consultation.id,
                id: this.instructions.id
            }).then(() => {
                this.$toastr.s("SE GUARDO CORRECTMENTE", "");
            }).catch(err => {
                this.errors.push(err.response.data.errors);
                this.$toastr.e("HAY ERRORES");
            })
        }
    },
    computed: {
        filteredStudio() {
            return this.laboratoryStudies.filter(studio => {
                return studio.description.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>