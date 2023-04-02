<template>
    <div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/altura.png" alt="altura" height="30px">
                <h6>Altura</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.altura" class="form-control form-control-sm" style="width: 60px">
                <h6>Cm</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/peso.png" alt="altura" height="30px">
                <h6>Peso</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.peso" class="form-control form-control-sm" style="width: 60px">
                <h6>Kg</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/imc.png" alt="altura" height="30px">
                <h6>IMC</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="imc" class="form-control form-control-sm" style="width: 60px">
                <h6>mbi</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/caliente.png" alt="altura" height="30px">
                <h6>Temp</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.temp" class="form-control form-control-sm" style="width: 60px">
                <h6>°C</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/pulmones.png" alt="altura" height="30px">
                <h6>F.R.</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.fr" class="form-control form-control-sm" style="width: 60px">
                <h6>r/m</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/brazo.png" alt="altura" height="30px">
                <h6>P.A.</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.pa" class="form-control form-control-sm" style="width: 60px">
                <h6>mmHg</h6>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6 d-flex justify-content-between">
                <img src="/imagenes/ritmo-cardiaco.png" alt="altura" height="30px">
                <h6>F.C.</h6>
            </div>
            <div class="col-6 d-flex justify-content-between">
                <input disabled :value="vitals.fc" class="form-control form-control-sm" style="width: 60px">
                <h6>f.c</h6>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['patient_id'],
    mounted() {
        axios.get('/api/vitalSigns/'+this.patient_id)
            .then(response => {
                this.vitals = response.data;
            })
    },
    data() {
        return {
            vitals: {}
        }
    },
    methods: {
        calcularIMC(peso, altura) {
            var alturaMetros = altura / 100; // Convertir altura a metros
            var imc = peso / (alturaMetros * alturaMetros); // Calcular IMC

            return imc.toFixed(2); // Redondear IMC a 2 decimales y devolverlo
        }
    },
    computed: {
        imc() {
            if ((this.vitals.altura === null && this.vitals.peso === null) || (this.vitals === "") ){
                return ''
            }
            return this.calcularIMC(this.vitals.peso, this.vitals.altura);
        }
    }
}
</script>