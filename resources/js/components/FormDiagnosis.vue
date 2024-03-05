<template>
    <div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-titles-tab" data-toggle="pill" data-target="#pills-titles" type="button"
                role="tab" aria-controls="pills-titles" aria-selected="false">Servicios</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="pills-questions-tab" data-toggle="pill" data-target="#pills-questions"
                type="button" role="tab" aria-controls="pills-questions" aria-selected="false">Subservicios</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane show active" id="pills-titles" role="tabpanel" aria-labelledby="pills-titles-tab">
                <form-servicios />
            </div>
            <div class="tab-pane" id="pills-questions" role="tabpanel" aria-labelledby="pills-questions-tab">
                <form-subservicios />
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>