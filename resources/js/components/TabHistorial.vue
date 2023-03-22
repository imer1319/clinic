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
                                <tr v-for="(question, index) in historyType.history_questions" :key="index">
                                   <td>{{ question.question }}</td>
                                   <td @click.prevent="openModal(question,index)"></td> 
                               </tr>
                           </tbody>
                       </table>
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
                    <input type="text" v-model="formPatientAnswer.answer" class="form-control" placeholder="Respuesta">
                </div>
            </div>
        </div>  
    </div>
</div>
</template>
<script>
export default{
    props:['consultation'],
    mounted(){
        axios.get('/api/historyTypes')
        .then(res => {
            this.historyTypes = res.data
        })
    },
    data(){
        return{
            historyTypes:[],
            formPatient:{},
            formPatientAnswer:{
                question:'',
                patient_id:'',
                answer:''
            },
            answerPatient:''
        }
    },
    methods:{
        openModal(question,index){
            axios.get('/api/historyPatients/'+question.id)
            .then(res => {
                this.formPatient = res.data
            })
            if(this.formPatient == ""){
                console.log("dajfilsa")
            }
            this.formPatientAnswer.answer = ''
            this.formPatientAnswer.question = question.question
            this.formPatientAnswer.patient_id = this.consultation.patient.id
            
            $('#modalPatientAnswer').modal('show');
        },
        savePatientAnswer(){

        }
    }
}
</script>