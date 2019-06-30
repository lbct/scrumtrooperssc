<template>
    <div>
        <div v-if="gestiones.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label>Selecciona una Gestión</label>
                    <select v-model="gestion" 
                            v-on:change="cambiarGestion()" class="form-control" >
                        <option v-for="(gestion, index) in gestiones"
                                :value="gestion">
                            Gestion: {{gestion.anho_gestion}} - {{gestion.periodo}}
                        </option>
                    </select> 
              </div>
            </center>
        </div>
        <p v-else>No tienes gestiones disponibles</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                gestiones: [{id:1,anho_gestion:'2019',periodo:'Primer Semestre',activa:true},
                            {id:2,anho_gestion:'2019',periodo:'Segundo Semestre',activa:false}],
                gestion: {id:'', activa:false},
            }
        },
    
        methods:{
            init(){
                if(this.gestiones.length){
                    this.gestion = this.gestiones[0];
                }
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Clases';
        },
    }
</script>