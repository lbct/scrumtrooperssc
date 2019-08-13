<template>
    <div>
        <administrador-usuarios :key="key_docentes"
                                :usuarios="docentes"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                docentes: null,
                key_docentes: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/docentes')
                    .then((response)=>{
                        this.docentes = response.data;
                        this.key_docentes++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Docentes';
        },
    }
</script>