<template>
    <div class="alert alert-danger" role="alert" v-if="errors.length">
        <b>Por favor corriga los siguientes errores:</b>
        <ul>
            <li v-for="error in errors">
                <p v-for="err in error">{{ err[0] }}</p>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ['errors']
}
</script>