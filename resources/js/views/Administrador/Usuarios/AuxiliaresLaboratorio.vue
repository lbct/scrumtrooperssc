<template>
    <div>
        <administrador-usuarios :key="key_auxiliares_laboratorio"
                                :usuarios="auxiliares_laboratorio"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                auxiliares_laboratorio: null,
                key_auxiliares_laboratorio: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/auxiliareslaboratorio')
                    .then((response)=>{
                        this.auxiliares_laboratorio = response.data;
                        this.key_auxiliares_laboratorio++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Auxiliares de Laboratorio';
        },
    }
</script>