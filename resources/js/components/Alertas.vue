<template>
    <div>
        <div v-for="mensaje in mensajes" class="flash-message" role="alert">
            <p class="alert" v-bind:class="'alert-'+tipo">
                {{ mensaje }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['mensajes','tipo'],
    }
</script>