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
            
            <div class="container-fluid">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Nombre del auxiliar</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Clases cursadas</th>
                            <th scope="col" v-if="gestion.activa">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>INTRODUCCIÓN A LA PROGRAMACIÓN</td>
                            <td>Wilson Alcocer</td>
                            <td>Wilson.Alcocer@gmail.com</td>
                            <td>12</td>
                            <td v-if="gestion.activa">
                                <i class="fas fa-trash-alt clickleable"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="text-left">Total de clases cursadas: 12</h4>
            </div>
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
            cambiarGestion(){
                console.log(this.gestion);
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Auxiliares';
        },
    }
</script>