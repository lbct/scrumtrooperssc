<template>
    <div>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
            }
        },
    
        methods:{
            init(){
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Estudiante';
        },
    }
</script>