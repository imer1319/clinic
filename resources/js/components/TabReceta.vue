<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Receta de medicamentos</h5>
                <a class="btn border text-success cursor-pointer" @click="openModal()">
                    <i class="fa fa-plus"></i>
                &nbsp; Agregar</a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Dosis</th>
                                <th>Frecuencia (Hrs)</th>
                                <th>Duracion (Dias)</th>
                                <th width="20"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="prescription in prescriptions">
                                <td>{{ prescription.medicamento }}</td>
                                <td>{{ prescription.tomar }}</td>
                                <td>{{ prescription.frecuencia }}</td>
                                <td>{{ prescription.durante }}</td>
                                <td @click.prevent="eliminarReceta(prescription.id)">
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
                        <a target="_blank" :href="`/pdf/receta/${consultation.id}`" class="btn border">
                            <img src="/imagenes/impresora.png" alt="impresora" width="35">
                        &nbsp;Imprimir </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_medicamentos" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Medicamentos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <error-component :errors="errors" />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="medicamento">Medicamento</label>
                                    <textarea class="form-control" v-model="prescription.medicamento" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dosis">Dosis</label>
                                    <input type="number" class="form-control" v-model="prescription.tomar">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="frecuencia">Frecuencia (Hrs)</label>
                                    <input type="number" class="form-control" v-model="prescription.frecuencia">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duracion">Duracion (Dias)</label>
                                    <input type="number" class="form-control" v-model="prescription.durante">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="savePrescription()">Guardar</button>
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
            this.getPrescriptions()
            this.getMedicalInstruction()
        },
        data() {
            return {
                medicamentos: [],
                prescriptions: [],
                search: '',
                instructciones: '',
                prescription: {
                    medicamento: '',
                    tomar: '',
                    frecuencia: '',
                    durante: '',
                    consultation_id: ''
                },
                errors: [],
                instructions: {}
            }
        },
        methods: {
            getPrescriptions() {
                axios.get('/api/prescriptions/' + this.consultation.id)
                .then(res => {
                    this.prescriptions = res.data;
                })
            },
            getMedicalInstruction() {
                axios.get('/api/medicalInstruction/' + this.consultation.id)
                .then(res => {
                    this.instructions = res.data;
                    this.instructciones = this.instructions.instructions
                })
            },
            createOrUpdate() {
                if (this.instructions.id) {
                    this.updateMedicalInstructions()
                    return
                } else {
                    this.saveMedicalInstructions()
                    return
                }
            },
            openModal() {
                $('#modal_medicamentos').modal('show');
            },
            addToForm(medicine) {
                this.prescription.medicamento = medicine.medicamento
                this.prescription.medicamento = medicine.medicine
                this.prescription.consultation_id = this.consultation.id
            },
            savePrescription() {
                this.prescription.consultation_id = this.consultation.id
                axios.post('/api/prescriptions', this.prescription)
                .then(() => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                    this.getPrescriptions()
                    $('#modal_medicamentos').modal('hide');
                    this.prescription = {
                        medicamento: '',
                        tomar: '',
                        frecuencia: '',
                        durante: '',
                        consultation_id: this.consultation.id,
                    }
                }).catch(err => {
                    if (err.response && err.response.data && err.response.data.errors) {
                        this.errors.push(err.response.data.errors);
                    }
                })
            },
            saveMedicalInstructions() {
                axios.post('/api/medicalInstruction', {
                    instructions: this.instructciones,
                    consultation_id: this.consultation.id
                }).then(() => {
                    this.$toastr.s("SE GUARDO CORRECTMENTE", "");
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HAY ERRORES");
                })
            },
            eliminarReceta(prescription) {
                axios.delete('/api/prescriptions/' + prescription)
                .then(() => {
                    this.getPrescriptions()
                }).catch(err => {
                    this.errors.push(err.response.data.errors);
                    this.$toastr.e("HUBO ERRORES AL ELIMINAR");
                })
            },
            updateMedicalInstructions() {
                axios.put('/api/medicalInstruction/' + this.instructions.id, {
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
            filteredMedicines() {
                return this.medicamentos.filter(medicine => {
                    return medicine.medicine.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        }
    }
</script>