<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h6><b>Diagnostico</b></h6>
            <a class="btn btn-success text-white" data-toggle="modal_diagnostics" @click="openModal()">
                <i class="fa fa-plus"></i>
                &nbsp; Agregar</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Diagnostico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(diagnostico, i) in form_diagnosticos" :key="i">
                    <td>{{ diagnostico.id }}</td>
                    <td>{{ diagnostico.name }}</td>
                    <td @click.prevent="eliminarDiagnostico(i)">
                        <h5><i class="fa fa-trash text-danger"></i></h5>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="modal_diagnostics" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">form_diagnosticos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mx-5">
                            <input v-model="search" class="form-control form-control-sm" placeholder="Buscar">
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
                                        <td class="cursor-pointer" @click.prevent="show(diagnosis)">{{ diagnosis.name }}
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
export default {
    props: ['consultation_id','form_diagnosticos'],
    mounted() {
        this.getDiagnoses();
    },
    data() {
        return {
            diagnoses: [],
            search: '',
            form_diagnosticos: [],
        }
    },
    methods: {
        openModal() {
            $('#modal_diagnostics').modal('show');
        },
        show(diagnosis) {
            this.form_diagnosticos.push({ consulta_id: this.consultation_id, id: diagnosis.id, name: diagnosis.name })
            $('#modal_diagnostics').modal('hide');
        },
        getDiagnoses() {
            axios.get('/api/diagnoses')
                .then(response => {
                    this.diagnoses = response.data;

                })
        },
        eliminarDiagnostico(index) {
            this.form_diagnosticos.splice(index, 1);
        }
    },
    computed: {
        filteredDiagnoses() {
            return this.diagnoses.filter(diagnosis => {
                return diagnosis.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>