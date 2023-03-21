<template>
    <div class="pre-scrollable">
        <table class="table">
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="exploration in explorationsData">
                    <td>{{ exploration.question }}</td>
                    <td data-toggle="modal" @click.prevent="openModal(exploration)">{{ exploration.answer }}</td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <input v-model="answer" type="text" class="form-control" placeholder="respuesta">
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            <a data-dismiss="modal" aria-label="Close"
                                class="btn btn-secondary text-white mb-0">Cancelar</a>
                            <button @click.prevent="agregarRespuesta" class="btn btn-success mb-0">Agregar</button>
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
    props: ['consultation_id','form_exploration_fisica'],
    mounted() {
        axios.get('/api/explorations')
            .then(response => {
                this.explorations = response.data;
                this.explorationsData = this.explorations.map(exploration => {
                    return {
                        exploration_id: exploration.id,
                        consultation_id: this.consultation_id,
                        question: exploration.question,
                        answer: ''
                    }
                });
            });
    },
    data() {
        return {
            explorations: [],
            question: '',
            exploration_id: '',
            answer: '',
            explorationsData: []
        }
    },
    methods: {
        openModal(exploration) {
            this.question = exploration.question
            this.exploration_id = exploration.exploration_id
            this.explorationsData.forEach(element => {
                if (element.exploration_id == exploration.exploration_id) {
                    this.answer = element.answer
                }
            });
            $('#modal').modal('show');
        },
        agregarRespuesta() {
            this.explorationsData.forEach(element => {
                if (element.exploration_id == this.exploration_id) {
                    element.answer = ''
                    element.answer = this.answer
                }
            });
            $('#modal').modal('hide');
        },
    },
}
</script>