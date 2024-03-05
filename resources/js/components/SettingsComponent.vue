<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3 cursor-pointer" v-for="(item, index) in items" :key="index"
                v-if="can(item.can)">
                <div class="card mt-3" data-toggle="modal" @click="openModal(item)">
                    <div class="card-body text-center">
                        <img :src="item.img" :alt="item.title" height="120">
                        <h6 class="mt-3">{{ item.title }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <modal-component :title="title" :component="component" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            component: '',
            items: [
                {
                    component: 'form-exploracion',
                    title: 'Exploracion fisica',
                    img: '/imagenes/estetoscopio.png',
                    can: 'explorations_index',
                },
                {
                    component: 'form-historial',
                    title: 'Historia clinica',
                    img: '/imagenes/informe-medico.png',
                    can: 'historial_index',
                },
                {
                    component: 'form-diagnosis',
                    title: 'Servicios',
                    img: '/imagenes/servicios.png',
                    can: 'services_index'
                },
                {
                    component: 'form-specialties',
                    title: 'Especialidades',
                    img: '/imagenes/specialty.png',
                    can: 'specialties_index'
                }
            ]
        }
    },
    methods: {
        openModal(item) {
            this.title = item.title
            this.component = item.component
            $('#modal').modal('show');
        }
    }
}
</script>
<style>
.cursor-pointer {
    cursor: pointer;
}
</style>