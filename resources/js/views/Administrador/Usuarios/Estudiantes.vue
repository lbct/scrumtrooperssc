<template>
    <div>
        <administrador-usuarios :key="key_estudiantes"
                                :usuarios="estudiantes"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                estudiantes: [],
                key_estudiantes: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/estudiantes')
                    .then((response)=>{
                        this.estudiantes = response.data;
                        this.key_estudiantes++;
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