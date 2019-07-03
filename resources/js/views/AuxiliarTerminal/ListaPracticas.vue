<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label for="materia">Selecciona la Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="obtenerPracticas()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}}
                        </option>
                    </select>
              </div>
            </center>
            
            <div v-if="practicas.length > 0" class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Semana</th>
                            <th scope="col">Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="practica in practicas">
                            <td>{{practica.semana}}</td>
                            <td><a :href="'/auxiliarterminal/archivos/' + practica.id" class="btn btn-primary" target="_blank">{{practica.archivo}}</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else>No se tiene ninguna práctica</h3>
        </div>
        <p v-else>No eres auxiliar en ninguna materia</p>
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
                materia: {id:'', nombre_materia:''},
                practicas: [],
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/auxiliarterminal/materias')
                    .then((response)=>{
                        var datos = response.data;
                        this.materias = datos;
                        
                        if(this.materias.length){
                            this.materia = this.materias[0];
                            this.obtenerPracticas();
                        }                            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerPracticas(){
                this.axios
                    .get('/auxiliarterminal/practicas/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.practicas = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Prácticas';
        },
    }
</script>