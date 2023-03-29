<template>
    <div class="row">
        <div class="col-md-6" v-for="notification in notifications">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h5>{{ notification.body }}</h5>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button @click.prevent="updateNotification(notification)" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props:['notifications'],
    methods:{
        updateNotification(notification){
            axios.put('/api/notifications/'+notification.id)
        }
    }
}
</script>