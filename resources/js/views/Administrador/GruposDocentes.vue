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
            
            <div v-if="materias.length > 0">
                <center>
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona una Materia</label>
                        <select v-model="materia" 
                                v-on:change="cambiarMateria()" class="form-control" >
                            <option v-for="(materia, index) in materias"
                                    :value="materia">
                                {{materia.nombre_materia}}
                            </option>
                        </select> 
                  </div>
                </center>
                <button v-on:click="mostrarAgregar()"
                        class="mb-3 btn btn-primary pull-left">
                    Añadir Grupo Docente
                </button>
                <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                <div v-if="grupos_docentes.length > 0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nº</th>
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Cantidad de Clases</th>
                                    <th scope="col">Clases</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(grupo_docente, index) in grupos_docentes">
                                    <td>{{index+1}}</td>
                                    <td>{{grupo_docente.detalle_grupo_docente}}</td>
                                    <td>
                                        {{grupo_docente.cantidad_horarios}}
                                    </td>
                                    <td>
                                        <router-link :to="{ name:'AdministradorClasesGrupoDocente', params: {grupo_docente_id: grupo_docente.id } }" 
                                                     class="btn btn-primary">
                                            Ver Clases
                                        </router-link>
                                    </td>
                                    <td>
                                        <i v-on:click="mostrarEditar(grupo_docente, index)"
                                           class="fas fa-edit clickleable">
                                        </i>
                                        <i v-on:click="mostrarBorrar(grupo_docente, index)" 
                                           class="fas fa-trash-alt clickleable">
                                        </i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h5 v-else>No se tiene ningún grupo docente disponible</h5>
                
                <div class="modal fade" id="modal-agregar-grupodocente">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Añadir Grupo Docente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form>
                          <div class="modal-body">
                                <label>Docente Añadidos</label><br>
                                <div v-if="docentes.length > 0" >
                                    <p v-for="(docente, index) in docentes">
                                        {{docente.nombre}} {{docente.apellido}} 
                                        <i v-on:click="borrarDocente(index)" 
                                           class="fas fa-trash-alt clickleable">
                                        </i>
                                    </p>
                                </div>
                                <p v-else>No has agregado un docente</p>
                              
                                <div v-if="docentes_posibles.length > 0">
                                    <label>Agregar Docente</label>
                                    <select v-model="docente" 
                                            class="form-control" >
                                        <option v-for="(docente, index) in docentes_posibles"
                                                :value="docente">
                                            {{docente.nombre}} {{docente.apellido}} 
                                        </option>
                                    </select> 
                                    <button v-on:click="agregarDocente()" 
                                            type="button" class="mt-3 btn btn-primary">
                                        Agregar
                                    </button>
                                </div>
                                <p v-else>No hay más docentes disponibles para esta materia</p>
                          </div>

                          <div class="modal-footer">
                            <button v-if="docentes.length > 0"
                                    v-on:click="agregar()" 
                                    type="button" class="m-3 btn btn-primary pull-left">
                                Añadir
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-editar-grupodocente">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Editar Grupo Docente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form>
                          <div class="modal-body">
                                <label>Docente Añadidos</label><br>
                                <div v-if="docentes.length > 0" >
                                    <p v-for="(docente, index) in docentes">
                                        {{docente.nombre}} {{docente.apellido}} 
                                        <i v-on:click="borrarDocente(index)" 
                                           class="fas fa-trash-alt clickleable">
                                        </i>
                                    </p>
                                </div>
                                <p v-else>No has agregado un docente</p>
                              
                                <div v-if="docentes_posibles.length > 0">
                                    <label>Agregar Docente</label>
                                    <select v-model="docente" 
                                            class="form-control" >
                                        <option v-for="(docente, index) in docentes_posibles"
                                                :value="docente">
                                            {{docente.nombre}} {{docente.apellido}} 
                                        </option>
                                    </select> 
                                    <button v-on:click="agregarDocente()" 
                                            type="button" class="mt-3 btn btn-primary">
                                        Agregar
                                    </button>
                                </div>
                                <p v-else>No hay más docentes disponibles para esta materia</p>
                          </div>

                          <div class="modal-footer">
                            <button v-if="docentes.length > 0"
                                    v-on:click="editar()" 
                                    type="button" class="m-3 btn btn-primary pull-left">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-borrar-grupodocente">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Eliminar Grupo Docente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                          <div class="modal-body">
                              <p>¿Estás seguro de eliminar el grupo docente de {{grupo_docente.detalle_grupo_docente}}?</p>
                          </div>

                          <div class="modal-footer">
                            <button v-on:click="borrar()" 
                                    type="button" class="m-3 btn btn-primary pull-left">
                                Eliminar
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
            <p v-else>No se tiene ninguna materia disponible</p>
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
                
                gestiones: [],
                gestion: {id:'', activa:false},
                materias: [],
                materia: {id:'', codigo_materia:'', nombre_materia:'', detalle_materia:''},
                grupos_docentes: [],
                grupo_docente: {id:'',materia_id:'',detalle_grupo_docente:''},
                docentes: [],
                docente: {id:'', nombre:'', apellido:''},
                docentes_posibles: [],
            }
        },
    
        methods:{
            initMensajes(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
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
                        if(this.materias.length){
                            this.materia = this.materias[0];
                            this.cambiarMateria();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarMateria(){
                this.axios
                    .get('/administrador/gruposdocentes/'+this.materia.id)
                    .then((response)=>{
                        this.grupos_docentes = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregar(){
                this.initMensajes();
                
                this.axios
                    .get('/administrador/docentes/disponibles/'+this.materia.id)
                    .then((response)=>{
                        this.docentes = [];
                        this.docentes_posibles = response.data;
                    
                        if(this.docentes_posibles.length)
                            this.docente = this.docentes_posibles[0];
                            
                        $('#modal-agregar-grupodocente').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            agregar(){
                this.initMensajes();
                
                const params = {
                    'materia_id': this.materia.id,
                    'docentes': this.docentes,
                };
                this.axios
                    .post('/administrador/grupodocente', params)
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.cambiarMateria();
                        $('#modal-agregar-grupodocente').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarEditar(grupo_docente, index){
                this.initMensajes();
                
                this.grupo_docente = grupo_docente;
                this.grupo_docente.index = index;
                
                this.axios
                    .get('/administrador/grupodocente/docentes/'+grupo_docente.id)
                    .then((response)=>{
                        this.docentes = response.data;
                        this.editarDocentesDisponibles();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            editar(){
                const params = {
                    'grupo_docente_id': this.grupo_docente.id,
                    'docentes': this.docentes,
                };
                this.axios
                    .put('/administrador/grupodocente', params)
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.cambiarMateria();
                        $('#modal-editar-grupodocente').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarBorrar(grupo_docente, index){
                this.grupo_docente = grupo_docente;
                this.grupo_docente.index = index;
                $('#modal-borrar-grupodocente').modal('show');
            },
            
            borrar(){
                const params = {
                    'grupo_docente_id': this.grupo_docente.id,
                };
                this.axios
                    .delete('/administrador/grupodocente', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.grupos_docentes.splice(this.grupo_docente.index, 1);
                        $('#modal-borrar-grupodocente').modal('hide');
                    });
            },
            
            agregarDocente(){
                this.docentes.push(this.docente);
                var index = this.docentes_posibles.findIndex((docente)=>{
                                    return this.docente == docente;
                            });
                this.docentes_posibles.splice(index,1);
                
                if(this.docentes_posibles.length)
                    this.docente = this.docentes_posibles[0];
            },
            
            borrarDocente(index){
                this.docentes_posibles.push(this.docentes[index]);
                this.docente = this.docentes_posibles[0];
                this.docentes.splice(index, 1);
            },
            
            editarDocentesDisponibles(){
                this.axios
                    .get('/administrador/docentes/disponibles/'+this.materia.id)
                    .then((response)=>{
                        this.docentes_posibles = response.data;
                    
                        if(this.docentes_posibles.length)
                            this.docente = this.docentes_posibles[0];
                            
                        $('#modal-editar-grupodocente').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Grupos Docentes';
        },
    }
</script>