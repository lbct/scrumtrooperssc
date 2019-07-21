<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="clase">
            <h4>{{clase.nombre_materia}}</h4>
            <h5>({{clase.detalle_grupo_docente}})</h5>
            <p>Aula: {{clase.nombre_aula}} - Horario: {{numeroDia(clase.dia)}} ({{clase.hora_inicio}} - {{clase.hora_fin}})</p>
            <div v-if="sesiones.length > 0">
                <center>
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona la Semana</label>
                        <select v-model="sesion" v-on:change="obtenerEstudiantes()" class="form-control" >
                            <option v-for="(sesion, index) in sesiones" 
                                    v-bind:value="sesion">
                                Semana: {{sesion.semana}}
                            </option>
                        </select>
                  </div>
                </center>
                <p>
                    <a :href="'/auxiliarterminal/archivos/guia_practica/'+sesion.guia_practica_id"
                       target="_blank" class="btn btn-primary">
                        Descargar Guía Práctica
                    </a>
                </p>
                <div v-if="estudiantes.length > 0">
                <div class="text-left">
                    <div class="col-xs-12 col-lg-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="fas fa-search"></i>
                              </div>
                            </div>
                            <input v-model="busqueda" v-on:keyup="filtrar()"
                                   type="text" class="form-control" placeholder="Nombre del estudiante">
                        </div>
                    </div>
                    <br>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Comentario del Auxiliar</th>
                                <th scope="col">Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(estudiante, index) in estudiantes_filtrados">
                                <td>{{index+1}}</td>
                                <td>{{estudiante.nombre}}</td>
                                <td>{{estudiante.apellido}}</td>
                                <td v-if="estudiante.comentario_auxiliar">
                                    {{estudiante.comentario_auxiliar}}&nbsp;&nbsp;&nbsp;
                                    <i v-on:click="comentar(estudiante, index)" 
                                       class="fas fa-edit clickleable"></i> 
                                    <i v-on:click="borrarComentario(estudiante)" 
                                       class="fas fa-trash-alt clickleable"></i>
                                </td>
                                <td v-else>
                                    <button v-if="estudiante.asistencia_sesion"
                                            v-on:click="comentar(estudiante, index)" 
                                            type="button" class="btn btn-primary">
                                        Comentar
                                    </button>
                                </td>
                                <td>
                                    <button v-on:click="asistencia(estudiante)" class="btn" type="button">
                                        <i v-if="estudiante.asistencia_sesion" 
                                           class="fas fa-toggle-on fa-2x">
                                        </i>
                                        <i v-else 
                                           class="fas fa-toggle-off fa-2x">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="modal-comentar-a-estudiante">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Comentario del Auxiliar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form>
                          <div class="modal-body">
                                <div class="form-group">
                                  <label>Por favor escriba el comentario</label>
                                  <input v-model='estudiante.comentario_auxiliar' 
                                         type="text" class="form-control" required>
                                </div>
                          </div>

                          <div class="modal-footer">
                            <button v-on:click="guardarComentario()" type="button" class="m-3 btn btn-primary pull-left">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>
                </div>
                <p v-else>No se tiene estudiantes en esta clase</p>
            </div>
            <p v-else>No se tiene sesiones de laboratorio para esta clase</p>
        </div>
        <p v-else>No tienes acceso a esta clase</p>
    </div>
</template>

<script>    
    export default {
        props: ['clase_id'],
        data() {
            return {
                busqueda: '',
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                sesion: {id:'', semana:''},
                sesiones: [],
                clase: {},
                estudiantes_filtrados: [],
                estudiantes: [],
                estudiante: {id:'', comentario_auxiliar:'', index:''}
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/auxiliarterminal/clase/'+this.clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clase = datos;
                        this.obtenerSesiones();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            numeroDia(dia){
                var dia_literal = '';
        
                if (dia == 1) {
                    dia_literal = 'Lunes';
                } else if (dia == 2) {
                    dia_literal = 'Martes';
                } else if (dia == 3) {
                    dia_literal = 'Miercoles';
                } else if (dia == 4) {
                    dia_literal = 'Jueves';
                } else if (dia == 5) {
                    dia_literal = 'Viernes';
                } else if (dia == 6) {
                    dia_literal = 'Sabado';
                } else if (dia == 7) {
                    dia_literal = 'Domingo';
                }
                
                return dia_literal;
            },
            
            obtenerSesiones(){
                this.axios
                    .get('/auxiliarterminal/sesion/'+this.clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.sesiones = datos;
                        
                        if(this.sesiones.length){
                            this.sesion = this.sesiones[0];
                            this.obtenerEstudiantes();
                        } 
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerEstudiantes(){
                this.axios
                    .get('/auxiliarterminal/sesion/estudiantes/'+this.sesion.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.estudiantes = datos;
                        this.estudiantes_filtrados = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            filtrar(){
                this.estudiantes_filtrados = this.estudiantes.filter(estudiante => {
                                                    var nombre = estudiante.nombre + ' ' + estudiante.apellido;
                                                    return nombre.toLowerCase().includes(this.busqueda.toLowerCase())
                                             });
            },
            
            asistencia(estudiante){
                var asistencia_sesion = true;
                
                if(estudiante.asistencia_sesion)
                    asistencia_sesion = false;
                
                const params = {
                    'sesion_estudiante_id': estudiante.id,
                    'asistencia_sesion': asistencia_sesion
                };
                this.axios
                    .put('/auxiliarterminal/sesion/estudiante/asistencia', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                        estudiante.asistencia_sesion = asistencia_sesion;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            comentar(estudiante, index){
                this.estudiante.id                  = estudiante.id;
                this.estudiante.comentario_auxiliar = estudiante.comentario_auxiliar;
                this.estudiante.index               = index;
                $('#modal-comentar-a-estudiante').modal('show');
            },
            
            borrarComentario(estudiante){
                const params = {
                    'sesion_estudiante_id': estudiante.id,
                    'comentario_auxiliar': ''
                };
                this.axios
                    .put('/auxiliarterminal/sesion/estudiante/comentario', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                        estudiante.comentario_auxiliar = '';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            guardarComentario(){
                const params = {
                    'sesion_estudiante_id': this.estudiante.id,
                    'comentario_auxiliar': this.estudiante.comentario_auxiliar
                };
                this.axios
                    .put('/auxiliarterminal/sesion/estudiante/comentario', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                        this.estudiantes_filtrados[this.estudiante.index].comentario_auxiliar = this.estudiante.comentario_auxiliar;
                        $('#modal-comentar-a-estudiante').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Estudiantes';
        },
    }
</script>