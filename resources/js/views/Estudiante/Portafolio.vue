<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <center v-if="materias.length > 0">
          <div class="form-group form-group col-md-6">
                <label for="materia">Selecciona la Materia</label>
                <select v-model="materia.id" class="form-control" v-on:change="obetnerPortafolio()">
                    <option v-for="(materia, index) in materias" 
                            v-bind:value="materia.id" :selected="true">
                        {{materia.nombre_materia}}
                    </option>
                </select>
          </div>
        </center>
        <p v-else>No tienes materias inscritas</p>
        
        <div class="container-fluid">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Asistencia</th>
                        <th scope="col">Semana</th>
                        <th scope="col">Comentario Del Auxiliar</th>
                        <th scope="col">Archivos Subidos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-1"><i class="fas fa-check"></i></td>
                        <td>1</td>
                        <td>Hizo 7</td>
                        <td>ABB.zip ABC.zip</td>
                    </tr>
                    <tr class="table-danger">
                        <td><i class="fas fa-times"></i></td>
                        <td>2</td>
                        <td></td>
                        <td>Sin Archivos</td>
                    </tr>
                    <tr class="table-info">
                        <td><i class="fas fa-times"></i></td>
                        <td>3</td>
                        <td></td>
                        <td>ABB.zip</td>
                    </tr>
                </tbody>
            </table>
            <h4 class="text-left">Porcentaje de asistencia: 33%</h4>
            <p class="text-left">Arhivos subidos: 3</p>
        </div>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                materias: [],
                materia: {'id':'','nombre_materia':''},
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/estudiante/materias/inscritas')
                    .then((response)=>{
                        var datos = response.data;
                        this.materias = datos;
                        
                        if(this.materias.length)
                            this.materia.id = this.materias[0].id;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obetnerPortafolio(){
                console.log(this.materia.id);
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Portafolio';
        },
    }
</script>