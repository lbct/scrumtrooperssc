<template>
    <div>
        <administrador-usuarios :key="key_administradores"
                                :usuarios="administradores"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                administradores: null,
                key_administradores: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/administradores')
                    .then((response)=>{
                        this.administradores = response.data;
                        this.key_administradores++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Administradores';
        },
    }
</script>