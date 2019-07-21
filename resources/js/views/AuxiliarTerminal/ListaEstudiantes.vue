<template>
    <div>
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label for="materia">Selecciona la Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="obtenerClases()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}} - {{materia.detalle_grupo_docente}}
                        </option>
                    </select>
              </div>
            </center>
            
            <div v-if="horarios.length > 0" class="table-responsive">
                <table :key="key_clases" class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Hora</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                            <th scope="col">Sabado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(clase, index) in clases">
                            <td>{{horas[index]}}</td>
                            <td v-for="horario in clase">
                                <div v-for="materia in horario"
                                     v-on:click="verClase(materia)"
                                     class="clickleable table-info custom-td">
                                    {{materia.detalle_grupo_docente}}<br>
                                    {{materia.nombre_aula}}<br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else>No se tiene ninguna clase disponible</p>
        </div>
        <p v-else>No eres auxiliar en ninguna materia</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                materias: [],
                materia: {id:'', nombre_materia:''},
                horarios: [],
                clases: [[[]]],
                key_clases: 0,
                clase: {nombre_aula:'', nombre_materia:'', detalle_grupo_docente:'', semana_actual_sesion:''},
                
                horas: [
                    "06:45/08:15",
                    "08:15/09:45",
                    "09:45/11:15",
                    "11:15/12:45",
                    "12:45/14:15",
                    "14:15/15:45",
                    "15:45/17:15",
                    "17:15/18:45",
                    "18:45/20:15",
                    "20:15/21:45",
                ],
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
                            this.obtenerClases();
                        }                            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerClases(){
                for(var i=0; i<10; i++) {
                    this.clases[i] = [[],[],[],[],[],[]];
                }
                
                this.axios
                    .get('/auxiliarterminal/clases/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.horarios = datos;
                        datos.forEach((materia)=>{
                            var horario = materia.horario_id-1;
                            var dia     = materia.dia-1;
                            if(this.clases[horario][dia].lenght)
                                this.clases[horario][dia] = [materia];
                            else
                                this.clases[horario][dia].push(materia);
                        });
                        this.key_clases++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            verClase(clase){
                this.$router.push({ name: 'AuxiliarTerminalListaEstudiantesClase', params: { clase_id: clase.id } });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Estudiantes';
        },
    }
</script>