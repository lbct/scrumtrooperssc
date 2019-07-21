<template>
    <div>
        <administrador-usuarios :key="key_auxiliares_terminal"
                                :usuarios="auxiliares_terminal"></administrador-usuarios>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                auxiliares_terminal: [],
                key_auxiliares_terminal: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuarios/auxiliaresterminal')
                    .then((response)=>{
                        this.auxiliares_terminal = response.data;
                        this.key_auxiliares_terminal++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Auxiliares de Terminal';
        },
    }
</script>