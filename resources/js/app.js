require('./bootstrap');

window.Vue = require('vue').default;
import VueToastr from "vue-toastr";

Vue.component('settings-component', require('./components/SettingsComponent.vue').default);
Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('detail-consultation', require('./components/DetailConsultations.vue').default);
Vue.component('error-component', require('./components/ErrorComponent.vue').default);
Vue.component('form-historial', require('./components/FormHistorial.vue').default);
Vue.component('form-historial-titulos', require('./components/FormHistorialTitulos.vue').default);
Vue.component('form-historial-preguntas', require('./components/FormHistorialPreguntas.vue').default);
Vue.component('form-exploracion', require('./components/FormExploracion.vue').default);
Vue.component('form-medicina', require('./components/FormMedicina.vue').default);
Vue.component('form-pruebas', require('./components/FormPruebas.vue').default);
Vue.component('form-consulta', require('./components/FormConsulta.vue').default);
Vue.component('form-vitales', require('./components/FormVitales.vue').default);
Vue.component('form-diagnosis', require('./components/FormDiagnosis.vue').default);

Vue.component('form-exploracion-list', require('./components/FormExploracionList.vue').default);
Vue.component('form-diagnostico-list', require('./components/FormDiagnosticoList.vue').default);


Vue.component('tab-consulta', require('./components/TabConsulta.vue').default);
Vue.component('tab-receta', require('./components/TabReceta.vue').default);
Vue.component('tab-estudio', require('./components/TabEstudio.vue').default);
Vue.component('tab-historial', require('./components/TabHistorial.vue').default);
Vue.component('archivo-paciente', require('./components/ArchivoPaciente.vue').default);
Vue.component('archivo-show-paciente', require('./components/ArchivoShowPaciente.vue').default);

Vue.use(VueToastr);

const app = new Vue({
    mounted() {
        this.$toastr.defaultTimeout = 3000;
        this.$toastr.defaultProgressBar = false;
    },
    el: '#app',
});