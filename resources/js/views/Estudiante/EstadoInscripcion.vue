<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="materias.length > 0" class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Docente</th>
                        <th v-if="inscripcion_activa" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(materia, index) in materias">
                        <td>{{materia.codigo_materia}}</td>
                        <td>{{materia.nombre_materia}}</td>
                        <td>{{materia.nombre_docente}} {{materia.apellido_docente}}</td>
                        <td v-if="inscripcion_activa">
                            <i v-on:click="mostrarEditar(materia, index)"
                               class="fas fa-edit clickleable">
                            </i>
                            <i class="fas fa-trash-alt clickleable" 
                               v-on:click="mostrarRetirarMateria(index)">
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No tienes Materias Inscritas.</p>
        
        <router-link :to="{ name: 'EstudianteInscripcion' }" v-if="inscripcion_activa"
                class="mb-3 btn btn-primary pull-left">
            Inscribirme
        </router-link>
        
        <div v-if="inscripcion_activa" class="modal fade" id="modal-retiro-incripcion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Retiro de Materia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                    <h5>¿Estás seguro de retirar la Materia?</h5>
                    <p>Materia: {{materia.nombre_materia}}</p>
                    <p>Docente: {{materia.nombre_docente}} {{materia.apellido_docente}}</p>
                    <p>Aula: {{materia.nombre_aula}}</p>
                    <p>Horario: {{materia.hora_inicio}} - {{materia.hora_fin}}</p>
                  </div>

                  <div class="modal-footer">
                    <button v-on:click="retirarMateria()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Confirmar y retirar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
            </div>
          </div>
        </div>
        
        <div v-if="inscripcion_activa" class="modal fade" id="modal-editar-incripcion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Materia Inscrita</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                    <h5>Materia: {{materia.nombre_materia}}</h5>
                    <label>Selecciona un Docente</label>
                    <select v-model="docente" 
                            v-on:change="clasesDisponibles()"
                            class="form-control">
                        <option v-for="docente in docentes" :value="docente">
                            {{docente.nombre_docente}} {{docente.apellido_docente}}
                        </option>
                    </select>
                      
                    <div v-if="clases.length > 0">
                        <label>Selecciona un Horario</label>
                        <select v-model="clase" class="form-control">
                            <option v-for="clase in clases" :value="clase">
                                {{clase.descripcion}}
                            </option>
                        </select>
                    </div>
                    <p v-else><br>No se tienen horarios disponibles para este docente.</p>
                  </div>

                  <div class="modal-footer">
                    <button v-if="clase.id"
                            v-on:click="editarMateria()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Guardar y editar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
            </div>
          </div>
        </div>
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
                inscripcion_activa: false,
                
                materia: {},
                docente: {},
                docentes: [],
                clase: {},
                clases: [],
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/estudiante/materias/inscritas')
                    .then((response)=>{
                        this.materias = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/inscripcion/activa')
                    .then((response)=>{
                        this.inscripcion_activa = response.data.activa;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarRetirarMateria(index){
                this.materia = this.materias[index];
                this.materia.index = index;
                $('#modal-retiro-incripcion').modal('show');
            },
            
            retirarMateria(){
                const params = {
                    'estudiante_clase_id': this.materia.id,
                };
                this.axios
                    .delete('/estudiante/materias/inscritas', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            this.materias.splice(this.materia.index,1);
                            
                            $('#modal-retiro-incripcion').modal('hide');
                        }
                        else if(datos.error){
                            this.inscripcion_activa = false;
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            $('#modal-retiro-incripcion').modal('hide');
                        }
                    })
            },
            
            mostrarEditar(materia, index){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.materia = materia;
                this.materia.index = index;
                this.docentesDisponibles();
                $('#modal-editar-incripcion').modal('show');
            },
            
            docentesDisponibles(){
                this.axios
                    .get('/estudiante/materia/'+this.materia.materia_id+'/docentes')
                    .then((response)=>{
                        var datos = response.data;
                        if(datos.exito){
                            this.docentes = datos.exito;
                            if(this.docentes.length){
                                var index = this.docentes.findIndex((docente)=>{
                                                return docente.id == this.materia.grupo_a_docente_id; 
                                            });
                                
                                if(index >= 0)
                                    this.docente  = this.docentes[index];
                                else
                                    this.docente  = this.docentes[0];
                                
                                this.clasesDisponibles();
                            }
                        }                     
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            clasesDisponibles(){                
                this.axios
                    .get('/estudiante/materia/'+this.docente.id+'/clases')
                    .then((response)=>{
                        var datos = response.data;
                        if(datos.exito){
                            this.clases = datos.exito;
                            if(this.clases.length){
                                var index = this.clases.findIndex((clase)=>{
                                                return clase.id == this.materia.clase_id; 
                                            });
                                
                                if(index >= 0)
                                    this.clase = this.clases[index];
                                else
                                    this.clase = this.clases[0];
                            }
                            else
                                this.clase = {};
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            editarMateria(){                
                const params = {
                    'estudiante_clase_id': this.materia.id,
                    'grupo_a_docente_id':  this.docente.id,
                    'clase_id':            this.clase.id,
                };
                this.axios
                    .put('/estudiante/materia', params)
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.init();
                        $('#modal-editar-incripcion').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Materias Inscritas';
        },
        
        
    }
</script>