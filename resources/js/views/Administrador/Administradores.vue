<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
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
            this.$parent.$parent.section = 'Administradores';
        },
    }
</script>