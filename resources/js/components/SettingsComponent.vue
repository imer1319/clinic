<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3 cursor-pointer shadow" v-for="(item, index) in items" :key="index">
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
                    img: '/imagenes/estetoscopio.png'
                },
                {
                    component: 'form-historial',
                    title: 'Historia clinica',
                    img: '/imagenes/informe-medico.png'

                },
                {
                    component: 'form-medicina',
                    title: 'Medicamentos',
                    img: '/imagenes/medicina.png'
                },
                {
                    component: 'form-pruebas',
                    title: 'Pruebas laboratorio',
                    img: '/imagenes/examen-de-orina.png'
                },
                {
                    component: 'form-diagnosis',
                    title: 'Diagnosticos',
                    img: '/imagenes/diagnostico.png'
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