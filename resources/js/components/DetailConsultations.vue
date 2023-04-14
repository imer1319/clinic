<template>
    <div>
        <div class="card" style="height: 45vh !important">
            <div class="card-body">
                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="consultas-tab" data-toggle="tab" href="#consultas" role="tab"
                            aria-controls="consultas" aria-selected="true">Consultas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="recetas-tab" data-toggle="tab" href="#recetas" role="tab"
                            aria-controls="recetas" aria-selected="false">Recetas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
                        <div class="pre-scrollable" style="height: 30vh;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(consultation, i) in consultations" class="cursor-pointer" :key="i"
                                        :class="{ 'activo': i === activeIndexConsulta }"
                                        @click.prevent="showDetailConsulta(consultation, i)">
                                        <td>{{ consultation.created_at | fechaFormateada }}</td>
                                        <td>{{ consultation.motivo }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="recetas" role="tabpanel" aria-labelledby="recetas-tab">
                        <div class="pre-scrollable" style="height: 30vh;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(consultation, index) in consultations" class="cursor-pointer" :key="index"
                                        :class="{ 'activo': index === activeIndexReceta }"
                                        @click.prevent="showDetailReceta(consultation, index)">
                                        <td>{{ consultation.created_at | fechaFormateada }}</td>
                                        <td>{{ consultation.motivo }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h5>Detalle de la cita</h5>
                <textarea v-model="description_cita" style="resize: none;" readonly rows="5"
                    class="form-control pre-scrollable"></textarea>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
export default {
    props: ['consultations'],
    data() {
        return {
            description_cita: '',
            description_receta: '',
            activeIndexConsulta: null,
            activeIndexReceta: null,
        }
    },
    methods: {
        showDetailConsulta(consultation, index) {
            this.activeIndexConsulta = index;
            this.activeIndexReceta = null;

            let sintoma = consultation.sintoma !== 'null' ? consultation.sintoma : ''
            let diagnosis = consultation.diagnosis !== null ? consultation.diagnosis : ''
            let altura = consultation.vital_signs.altura !== null ? consultation.vital_signs.altura : ''
            let peso = consultation.vital_signs.peso !== null ? consultation.vital_signs.peso : ''
            let temperatura = consultation.vital_signs.temp !== null ? consultation.vital_signs.temp : ''
            let fr = consultation.vital_signs.fr !== null ? consultation.vital_signs.fr : ''
            let fc = consultation.vital_signs.fc !== null ? consultation.vital_signs.fc : ''
            let presion = consultation.vital_signs.pa !== null ? consultation.vital_signs.pa : ''
            this.description_cita = `MOTIVO DE LA CONSULTA\n${consultation.motivo} \nSINTOMAS SUBJETIVOS\n${sintoma}\n` +
                'DIAGNOSTICOS \n' + diagnosis +
                '\nSIGNOS VITALES \n' +
                'Altura : ' + altura + ' cm\n' +
                'Peso : ' + peso + ' kg\n' +
                'Temp : ' + temperatura + ' ºC\n' +
                'P.A. : ' + presion + ' mmHg\n' +
                'F.R. : ' + fr + ' r/m\n' +
                'F.C. : ' + fc + ' f.c\n'
        },
        async showDetailReceta(consultation, index) {
            this.activeIndexReceta = index;
            this.activeIndexConsulta = null;
            let prescripciones = ''
            let medical_instruction = consultation.medical_instruction === 'null' ? consultation.medical_instruction.instructions : ''

            if (consultation.medicines.length == 0) {
                prescripciones = ''
            } else {
                consultation.medicines.forEach(prescription => {
                    prescripciones += `*${prescription.medicine} - ${prescription.concentration} - Tomar: ${prescription.pivot.tomar} - Cada: ${prescription.pivot.frecuencia} Hrs - Durante: ${prescription.pivot.durante} Dias\n`
                })
            }
            this.description_cita = "MEDICAMENTOS" + "\n"
                + prescripciones + "\nINDICACIONES MEDICAS \n" + medical_instruction
        }
    },
	filters: {
		fechaFormateada(fecha) {
			return moment(new Date(fecha)).format('DD-MM-YYYY HH:mm A')
		}
	}
}
</script>
<style>
.activo {
    background-color: #0b5fb4 !important;
    color: aliceblue;
}
</style>