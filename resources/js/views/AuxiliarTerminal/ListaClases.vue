<template>
    <div>
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label for="materia">Selecciona la Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="obtenerClases()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}}
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
                                     v-on:click="verMasClase(materia)"
                                     class="clickleable table-info custom-td">
                                    {{materia.detalle_grupo_docente}}<br>
                                    {{materia.nombre_aula}}<br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else>No se tiene ninguna clase disponible</h3>
            
            <div class="modal fade" id="modal-ver-mas-clase">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">{{clase.nombre_materia}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                        <h3>Semana: {{clase.semana_actual_sesion}}</h3>
                        <h5 v-if="clase.en_curso">(En curso)</h5>
                        <p>Materia: {{clase.nombre_materia}}</p>
                        <p>Grupo Docente: {{clase.detalle_grupo_docente}}</p>
                        <p>Aula: {{clase.nombre_aula}}</p>
                        <p>Horario: {{clase.hora_inicio}} - {{clase.hora_fin}}</p>
                        <div v-if="!clase.en_curso && clase.siguiente_sesion" class="mt-2">
                            <button v-on:click="iniciarClase()" type="button" class="btn btn-primary">
                                Iniciar Clase
                            </button>
                        </div>
                        <div class="mt-2">
                            <router-link :to="{ name:'AuxiliarTerminalListaEstudiantesClase', params: {clase_id: clase.id } }" 
                                         class="btn btn-primary">
                                Lista de estudiantes
                            </router-link>
                        </div>
                        <div v-if="clase.en_curso" class="mt-2">
                            <div>
                                <a :href="'/auxiliarterminal/archivos/'+clase.siguiente_sesion.guia_practica_id"
                                   class="btn btn-primary" target="_blank">
                                    Descargar Guía Practica
                                </a>
                            </div>
                            <button v-on:click="cancelarClase()" type="button" class="btn btn-danger mt-2">
                                Cancelar Clase
                            </button>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      </div>
                </div>
              </div>
            </div>
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
                clase: {id:'-1', nombre_aula:'', nombre_materia:'', detalle_grupo_docente:'', semana_actual_sesion:''},
                
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
            
            verMasClase(clase){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.axios
                    .get('/auxiliarterminal/clase/'+clase.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clase = datos;
                        $('#modal-ver-mas-clase').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            iniciarClase(){
                const params = {
                    'clase_id': this.clase.id,
                };
                this.axios
                    .post('/auxiliarterminal/sesion', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            this.clase.semana_actual_sesion++;
                            this.clase.en_curso = true;
                        }else{
                            this.mensajes = datos.error.mensaje;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                            
                            var codigo_error = datos.error.codigo;
                            if(codigo_error==1){
                                this.clase.semana_actual_sesion++;
                                this.clase.en_curso = true;
                            }else if(codigo_error==2){
                                this.clase.semana_actual_sesion++;
                                this.clase.siguiente_sesion = null;
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cancelarClase(){
                const params = {
                    'clase_id': this.clase.id,
                };
                this.axios
                    .delete('/auxiliarterminal/sesion', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            this.clase.semana_actual_sesion--;
                            this.clase.en_curso = false;
                        }
                        else{
                            this.mensajes = datos.error.mensaje;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                            
                            var codigo_error = datos.error.codigo;
                            if(codigo_error==1){
                                this.clase.siguiente_sesion = datos.error.siguiente_sesion;
                                this.clase.en_curso = false;
                            }
                        }
                    });
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Clases';
        },
    }
</script>