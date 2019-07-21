<template>
    <div>
        <button v-on:click="mostrarAgregarGestion()"
                class="mb-3 btn btn-primary pull-left">
            Añadir Gestión
        </button>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="gestiones.length > 0" class="table-responsive">            
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Año</th>
                        <th scope="col">Periodo</th>
                        <th scope="col">Activa</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(gestion, index) in gestiones">
                        <td>{{gestion.anho_gestion}}</td>
                        <td>{{gestion.periodo}}</td>
                        <td>
                            <button v-on:click="cambiarActiva(gestion)" class="btn" type="button">
                                <i v-if="gestion.activa" 
                                   class="fas fa-toggle-on fa-2x">
                                </i>
                                <i v-else 
                                   class="fas fa-toggle-off fa-2x">
                                </i>
                            </button>
                        </td>
                        <td>
                            <i v-on:click="mostrarEditar(gestion)"
                               class="fas fa-edit clickleable">
                            </i>
                            <i v-on:click="mostrarBorrar(gestion, index)" 
                               class="fas fa-trash-alt clickleable">
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No tienes gestiones disponibles</p>
        
        <div class="modal fade" id="modal-agregar-gestion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Añadir Gestión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <div class="modal-body">
                    <Alertas :key=key_mensajes_gestion 
                             :mensajes=mensajes_gestion  
                             :tipo=tipo_mensaje_gestion>
                    </Alertas>  
                    
                    <label>Selecciona el Año</label>
                    <div>
                        <select v-model="gestion.anho_gestion" 
                                v-on:change="actualizarPeriodos()" 
                                class="form-control" required>
                            <option v-for="anho in posibles_anhos" :value="anho">
                                {{anho}}
                            </option>
                        </select>
                    </div>
                    <div v-if="periodos.length > 0">
                        <label>Selecciona un Periodo</label>
                        <select v-model="gestion.periodo_id" class="form-control" required>
                            <option v-for="periodo in periodos" :value="periodo.id">
                                {{periodo.descripcion}}
                            </option>
                        </select>
                    </div>
                    <p v-else><br>No se tiene periodos disponibles para ese año</p>
                  </div>

                  <div class="modal-footer">
                    <button v-if="periodos.length > 0"
                            v-on:click="agregarGestion()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Añadir
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-editar-gestion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Gestión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <div class="modal-body">
                    <Alertas :key=key_mensajes_gestion 
                             :mensajes=mensajes_gestion  
                             :tipo=tipo_mensaje_gestion>
                    </Alertas> 
                      
                    <label>Selecciona el Año</label>
                    <div>
                        <select v-model="gestion.anho_gestion" 
                                v-on:change="actualizarPeriodos()" 
                                class="form-control" required>
                            <option v-for="anho in posibles_anhos" :value="anho">
                                {{anho}}
                            </option>
                        </select>
                    </div>
                    <div v-if="periodos.length > 0">
                        <label>Selecciona un Periodo</label>
                        <select v-model="gestion.periodo_id" class="form-control" required>
                            <option v-for="periodo in periodos" :value="periodo.id">
                                {{periodo.descripcion}}
                            </option>
                        </select>
                    </div>
                    <p v-else><br>No se tiene periodos disponibles para ese año</p>
                  </div>

                  <div class="modal-footer">
                    <button v-if="periodos.length > 0"
                            v-on:click="editarGestion()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Editar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-borrar-gestion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar Gestión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <div class="modal-body">
                      <p>
                          ¿Estás seguro de eliminar la gestión: {{gestion.anho_gestion}} - {{gestion.periodo}}?
                      </p>
                  </div>

                  <div class="modal-footer">
                    <button v-on:click="borrarGestion()" 
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
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                mensajes_gestion: [],
                tipo_mensaje_gestion: '',
                key_mensajes_gestion: 0,
                
                gestiones: [],
                gestion: {id:'', periodo_id:'', anho_gestion:'', periodo:'', activa:'', index:''},
                periodos: [],
                anho_actual: '',
                posibles_anhos: [],
            }
        },
    
        methods:{
            initMensajes(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.mensajes_gestion = [];
                this.tipo_mensaje_gestion = '';
                this.key_mensajes_gestion = 0;
            },
            
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.obtenerGestiones();
            },
            
            obtenerGestiones(){
                this.axios
                    .get('/administrador/gestiones')
                    .then((response)=>{
                        this.gestiones = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            actualizarPeriodos(){
                this.axios
                    .get('/administrador/periodos/'+this.gestion.anho_gestion)
                    .then((response)=>{
                        this.periodos = response.data;
                        if(this.periodos.length > 0)
                            this.gestion.periodo_id = this.periodos[0].id;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            posiblesAnhos(anho){
                anho = Number(anho);
                this.posibles_anhos = [];
                for (var i = anho-1; i < anho+2; i++) {
                    this.posibles_anhos.push(i);
                }
                
                this.gestion.anho_gestion = anho;
                this.actualizarPeriodos();
            },
            
            mostrarAgregarGestion(){
                this.initMensajes();
                
                this.anho_actual  = new Date().getFullYear();
                this.posiblesAnhos(this.anho_actual);
                
                $('#modal-agregar-gestion').modal('show');
            },
            
            agregarGestion(){
                this.initMensajes();
                
                const params = {
                    'anho_gestion': this.gestion.anho_gestion,
                    'periodo_id': this.gestion.periodo_id,
                };
                this.axios
                    .post('/administrador/gestion', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            this.obtenerGestiones();
                            $('#modal-agregar-gestion').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes_gestion = datos.error;
                            this.tipo_mensaje_gestion = 'danger';
                            this.key_mensajes_gestion++;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarEditar(gestion){
                this.initMensajes();
                
                this.gestion.id           = gestion.id;
                this.gestion.periodo_id   = gestion.periodo_id;
                this.posiblesAnhos(gestion.anho_gestion);
                
                $('#modal-editar-gestion').modal('show');
            },
            
            editarGestion(){
                this.initMensajes();
                
                const params = {
                    'gestion_id': this.gestion.id,
                    'anho_gestion': this.gestion.anho_gestion,
                    'periodo_id': this.gestion.periodo_id,
                };
                this.axios
                    .put('/administrador/gestion', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            this.obtenerGestiones();
                            $('#modal-editar-gestion').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes_gestion = datos.error;
                            this.tipo_mensaje_gestion = 'danger';
                            this.key_mensajes_gestion++;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarBorrar(gestion, index){
                this.initMensajes();
                
                this.gestion = gestion;
                this.gestion.index = index;
                $('#modal-borrar-gestion').modal('show');
            },
            
            borrarGestion(){
                const params = {
                    'gestion_id': this.gestion.id,
                };
                this.axios
                    .delete('/administrador/gestion', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            this.gestiones.splice(this.gestion.index, 1);
                            $('#modal-borrar-gestion').modal('hide');
                        }
                    });
            },
            
            cambiarActiva(gestion){
                this.initMensajes();
                
                var gestion_activa = true;
                
                if(gestion.activa)
                    gestion_activa = false;
                
                const params = {
                    'gestion_id': gestion.id,
                    'activa': gestion_activa,
                };
                this.axios
                    .put('/administrador/gestion/activa', params)
                    .then((response)=>{
                        var datos = response.data;
                        if(datos.exito){
                            if(gestion_activa){
                                this.gestiones.forEach((gestion)=> {
                                    gestion.activa = false
                                });
                            }

                            gestion.activa = gestion_activa;
                            
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                            
                            this.obtenerGestiones();
                            $('#modal-editar-gestion').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }                        
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Gestiones';
        },
    }
</script>