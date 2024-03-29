require('./bootstrap');
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'

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
Vue.component('form-specialties', require('./components/FormSpecialties.vue').default);
Vue.component('form-diagnosis', require('./components/FormDiagnosis.vue').default);
Vue.component('form-servicios', require('./components/FormServicio.vue').default);
Vue.component('form-subservicios', require('./components/FormSubservicio.vue').default);

Vue.component('form-exploracion-list', require('./components/FormExploracionList.vue').default);
Vue.component('form-diagnostico-list', require('./components/FormDiagnosticoList.vue').default);


Vue.component('tab-consulta', require('./components/TabConsulta.vue').default);
Vue.component('tab-receta', require('./components/TabReceta.vue').default);
Vue.component('tab-estudio', require('./components/TabEstudio.vue').default);
Vue.component('tab-historial', require('./components/TabHistorial.vue').default);
Vue.component('archivo-paciente', require('./components/ArchivoPaciente.vue').default);
Vue.component('archivo-show-paciente', require('./components/ArchivoShowPaciente.vue').default);
Vue.component('notificaciones', require('./components/Notificaciones.vue').default);
Vue.component('notificaciones-list', require('./components/NotificationsList.vue').default);
Vue.component('form-agenda', require('./components/FormAgenda.vue').default);

Vue.use(VueToastr);
Vue.use(LaravelPermissionToVueJS)

const app = new Vue({
    mounted() {
        this.$toastr.defaultTimeout = 3000;
        this.$toastr.defaultProgressBar = false;
    },
    el: '#app',
});

