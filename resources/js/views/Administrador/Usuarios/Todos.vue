<template>
    <div>
        <administrador-usuarios :key="key_usuarios"
                                :usuarios="usuarios"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                usuarios: null,
                key_usuarios: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/todos')
                    .then((response)=>{
                        this.usuarios = response.data;
                        this.key_usuarios++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Todos los Usuarios';
        },
    }
</script>