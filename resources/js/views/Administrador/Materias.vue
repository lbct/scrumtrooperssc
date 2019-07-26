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
            
            <button v-on:click="mostrarAgregarMateria()"
                    class="mb-3 btn btn-primary pull-left">
                Añadir Materia
            </button>
            <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
            <div v-if="materias.length > 0" class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(materia, index) in materias">
                            <td>{{index+1}}</td>
                            <td>{{materia.codigo_materia}}</td>
                            <td>{{materia.nombre_materia}}</td>
                            <td>{{materia.detalle_materia}}</td>
                            <td>
                                <i v-on:click="mostrarEditarMateria(materia, index)" 
                                   class="fas fa-edit clickleable">
                                </i>
                                <i v-if="materia.borrable"
                                   v-on:click="mostrarBorrarMateria(materia, index)" 
                                   class="fas fa-trash-alt clickleable">
                                </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else>No se tiene ninguna materia disponible</p>
            
            <div class="modal fade" id="modal-agregar-materia">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Añadir Materia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                            <Alertas :key=key_mensajes_materia 
                                     :mensajes=mensajes_materia  
                                     :tipo=tipo_mensaje_materia >
                            </Alertas>
                          
                            <div class="form-group">
                              <label>Código de la Materia</label>
                              <input v-model='materia.codigo_materia' class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Nombre de la Materia</label>
                              <input v-model='materia.nombre_materia' class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Detalle de la Materia</label>
                              <input v-model='materia.detalle_materia'class="form-control" required>
                            </div>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="agregarMateria()"
                                type="button" class="m-3 btn btn-primary pull-left">
                            Añadir
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="modal-editar-materia">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Editar Materia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                            <Alertas :key=key_mensajes_materia 
                                     :mensajes=mensajes_materia  
                                     :tipo=tipo_mensaje_materia >
                            </Alertas>
                          
                            <div class="form-group">
                              <label>Código de la Materia</label>
                              <input v-model='materia.codigo_materia' class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Nombre de la Materia</label>
                              <input v-model='materia.nombre_materia' class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Detalle de la Materia</label>
                              <input v-model='materia.detalle_materia'class="form-control" required>
                            </div>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="editarMateria()"
                                type="button" class="m-3 btn btn-primary pull-left">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="modal-borrar-materia">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Eliminar Materia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                          <p>¿Estás seguro de eliminar la materia {{materia.nombre_materia}} con código: {{materia.codigo_materia}}?</p>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="borrarMateria()"
                                type="button" class="m-3 btn btn-primary pull-left">
                            Eliminar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
        <p v-else>No existen gestiones disponibles</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                mensajes_materia: [],
                tipo_mensaje_materia: '',
                key_mensajes_materia: 0,
                
                gestiones: [],
                gestion: {id:'', activa:false},
                materias: [],
                materia: {id:'', codigo_materia:'', nombre_materia:'', detalle_materia:''},
            }
        },
    
        methods:{
            initMensajes(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.mensajes_materia = [];
                this.tipo_mensaje_materia = '';
                this.key_mensajes_materia = 0;
            },
            
            init(){
                this.axios
                    .get('/administrador/gestiones')
                    .then((response)=>{
                        this.gestiones = response.data;
                        if(this.gestiones.length > 0){
                            const gestion = this.gestiones.find(gestion => gestion.activa == true);
                            
                            if(gestion)
                                this.gestion = gestion;
                            else
                                this.gestion = this.gestiones[0];
                                    
                            this.cambiarGestion();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarGestion(){
                this.axios
                    .get('/administrador/materias/'+this.gestion.id)
                    .then((response)=>{
                        this.materias = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregarMateria(){
                this.initMensajes();
                
                this.materia = {id:'', codigo_materia:'', nombre_materia:'', detalle_materia:''};
                $('#modal-agregar-materia').modal('show');
            },
            
            agregarMateria(){
                this.initMensajes();
                
                const params = {
                    'gestion_id': this.gestion.id,
                    'codigo_materia': this.materia.codigo_materia,
                    'nombre_materia': this.materia.nombre_materia,
                    'detalle_materia': this.materia.detalle_materia,
                };
                this.axios
                    .post('/administrador/materia', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            this.materias.push(datos.materia);
                            $('#modal-agregar-materia').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes_materia = datos.error;
                            this.tipo_mensaje_materia = 'danger';
                            this.key_mensajes_materia++;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarEditarMateria(materia, index){
                this.initMensajes();
                
                this.materia = Object.assign({}, materia);
                this.materia.index = index;
                
                $('#modal-editar-materia').modal('show');
            },
            
            editarMateria(){
                this.initMensajes();
                
                const params = {
                    'materia_id': this.materia.id,
                    'codigo_materia': this.materia.codigo_materia,
                    'nombre_materia': this.materia.nombre_materia,
                    'detalle_materia': this.materia.detalle_materia,
                };
                this.axios
                    .put('/administrador/materia', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            var index = this.materia.index;
                            this.materias[index].codigo_materia  = this.materia.codigo_materia;
                            this.materias[index].nombre_materia  = this.materia.nombre_materia;
                            this.materias[index].detalle_materia = this.materia.detalle_materia;
                            $('#modal-editar-materia').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes_materia = datos.error;
                            this.tipo_mensaje_materia = 'danger';
                            this.key_mensajes_materia++;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarBorrarMateria(materia, index){
                this.initMensajes();
                
                this.materia = Object.assign({}, materia);
                this.materia.index = index;
                
                $('#modal-borrar-materia').modal('show');
            },
            
            borrarMateria(){
                this.initMensajes();
                
                const params = {
                    'materia_id': this.materia.id,
                };
                this.axios
                    .delete('/administrador/materia', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.materias.splice(this.materia.index,1);
                            $('#modal-borrar-materia').modal('hide');
                            
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Materias';
        },
    }
</script>