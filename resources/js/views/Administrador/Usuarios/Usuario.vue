<template>
    <div>
        <div v-if="usuario.id">
            <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
            <div class="container col-md-5 col-md-offset-4  ">
                <div class="row">
                    <div class="panel panel-default">
                        <div>
                            <div class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label>Usuario</label>
                                    <input v-model="usuario_edicion.username" type="email" class="form-control input-lg" placeholder="Usuario" tabindex="0" :disabled='!modo_edicion'>
                                </div>

                                <div class="col-md-6 mb-10">
                                    <label>Nombres</label>
                                    <input v-model="usuario_edicion.nombre" type="text" class="form-control" placeholder="Nombres" tabindex="1" :disabled='!modo_edicion'>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label>Apellidos</label>
                                    <input v-model="usuario_edicion.apellido" type="text" class="form-control" placeholder="Apellidos" tabindex="2" :disabled='!modo_edicion'>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label>Correo</label>
                                    <input v-model="usuario_edicion.correo" type="email" class="form-control input-lg" placeholder="nombre@ejemplo.com" tabindex="3" :disabled='!modo_edicion'>
                                </div>
                            </div>
                            
                            <div v-if="usuario.estudiante"
                                 class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label>Codigo SIS de Estudiante</label>
                                    <input v-model="usuario_edicion.estudiante.codigo_sis" type="text" class="form-control input-lg" placeholder="201000000" tabindex="4" :disabled='!modo_edicion'>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group row justify-content-center">
                                <button v-if="!modo_edicion"
                                        v-on:click="habilitarEditar()"
                                        type="button" class="m-2 btn btn-primary pull-left">
                                    Editar Perfil
                                </button>
                                
                                <div v-else>
                                    <button v-on:click="guardarDatos()"
                                            type="button" class="m-2 btn btn-primary pull-left">
                                        Guardar
                                    </button>
                                    <button v-on:click="deshabilitarEditar()"
                                            type="button" class="m-2 btn btn-danger pull-left">
                                        Cancelar
                                    </button>
                                </div>
                                
                                <button v-on:click="mostrarRoles()" 
                                        type="button" class="m-2 btn btn-success">
                                    Roles
                                </button>
                                <br>
                                <button v-on:click="mostrarCambiarPassword()"
                                        type="button" class="m-2 btn btn-danger">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-roles">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Roles</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                        <h4>Roles Asignados</h4>
                        <div v-if="usuario_edicion.roles.length > 0">
                            <p v-for="(rol, index) in usuario_edicion.roles">
                                {{rol.descripcion}} 
                                <i v-on:click="borrarRol(index)" 
                                   class="fas fa-trash-alt clickleable">
                                </i>
                            </p>
                        </div>
                        <p v-else>El usuario no tiene roles asignados</p>
                          
                        <div v-if="roles_disponibles.length > 0">
                            <label>Agregar Rol</label>
                            <select v-model="rol" 
                                    class="form-control" >
                                <option v-for="(rol, index) in roles_disponibles"
                                        :value="rol">
                                    {{rol.descripcion}}
                                </option>
                            </select> 
                            <button v-on:click="agregarRol()" 
                                    type="button" class="mt-3 btn btn-primary">
                                Agregar
                            </button>
                        </div>
                        <p v-else>No hay más roles disponibles para este usuario</p>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="guardarRoles()" 
                                type="button" class="m-3 btn btn-primary pull-left">
                            Guardar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modal-cambiar-password">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Cambiar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                          <Alertas :key=key_mensajes_password :mensajes=mensajes_password :tipo=tipo_mensajes_password></Alertas>
                            <div class="form-group">
                              <label>Nueva Contraseña</label>
                              <input v-model='usuario.password' type="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                              <label>Repita la Nueva Contraseña</label>
                              <input v-model='repetir_password' type="password" class="form-control" required>
                            </div>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="cambiarPassword()" 
                                type="button" class="m-3 btn btn-primary pull-left">
                            Cambiar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
        <p v-else>Usuario no válido</p>
    </div>
</template>

<script>    
    export default {
        props: ['usuario_id'],
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                mensajes_password: '',
                tipo_mensajes_password: '',
                key_mensajes_password: 0,
                
                usuario: {id:'', nombre: '', apellido:'', correo:'', password:'', username:'', roles:[], estudiante:{}},
                usuario_edicion: {id:'', nombre: '', apellido:'', correo:'', password:'', username:'', roles:[], estudiante:{}},
                repetir_password: '',
                
                modo_edicion: false,
                roles_disponibles: [],
                rol: {},
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/usuario/'+this.usuario_id)
                    .then((response)=>{
                        this.usuario = response.data;
                    
                        this.usuario_edicion  = Object.assign({}, this.usuario);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            guardarDatos(){
                this.key_mensajes++;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                const params = {'usuario': this.usuario_edicion};
                this.axios
                    .put('/administrador/usuario/', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                    
                        if(datos.exito){
                            this.mensajes     = datos.exito;
                            this.tipo_mensaje = 'success';
                            
                            this.usuario = Object.assign({}, this.usuario_edicion);
                            this.modo_edicion = false;
                        }
                        else if(datos.error){
                            this.mensajes     = datos.error;
                            this.tipo_mensaje = 'danger';
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarCambiarPassword(){
                this.mensajes_password = [];
                this.tipo_mensajes_password = '';
                $('#modal-cambiar-password').modal('show');
            },
            
            cambiarPassword(){
                this.key_mensajes_password++;
                this.mensajes_password = [];
                this.tipo_mensajes_password = 'danger';
                
                if(!this.repetir_password || 
                   !this.usuario.password){
                    this.mensajes_password.push('Ningún campo puede estar vacío');
                }
                
                if(this.repetir_password.localeCompare(this.usuario.password)){
                    this.mensajes_password.push('Las contraseñas no coinciden');
                }
                
                if(this.mensajes_password.length == 0){
                    const params = {
                        'usuario_id': this.usuario.id,
                        'password': this.usuario.password,
                    };
                    this.axios
                    .put('/administrador/usuario/password', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                    
                        if(datos.exito){
                            this.mensajes     = datos.exito;
                            this.tipo_mensaje = 'success';
                            
                            this.usuario.password = '';
                            this.repetir_password = '';
                            $('#modal-cambiar-password').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes_password  = datos.error;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
            
            habilitarEditar(){
                this.key_mensajes = 0;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                this.usuario_edicion = Object.assign({}, this.usuario);
                this.modo_edicion = true;
            },
            
            deshabilitarEditar(){
                this.key_mensajes = 0;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                this.usuario_edicion = Object.assign({}, this.usuario);
                this.modo_edicion = false;
            },
            
            mostrarRoles(){
                this.key_mensajes++;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                this.usuario_edicion.roles = Object.assign([], this.usuario.roles);
                
                this.axios
                    .get('/administrador/roles/usuario/disponibles/'+this.usuario_id)
                    .then((response)=>{
                        this.roles_disponibles = response.data;
                        if(this.roles_disponibles.length)
                            this.rol = this.roles_disponibles[0];
                    
                        $('#modal-roles').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            borrarRol(index){
                var rol = this.usuario_edicion.roles[index];
                this.usuario_edicion.roles.splice(index,1);
                this.roles_disponibles.push(rol);
                this.rol = this.roles_disponibles[0];
            },
            
            agregarRol(){
                this.usuario_edicion.roles.push(this.rol);
                var index = this.roles_disponibles.findIndex((rol)=>{
                                    return this.rol == rol;
                            });
                this.roles_disponibles.splice(index,1);
                
                if(this.roles_disponibles.length)
                    this.rol = this.roles_disponibles[0];
            },
            
            guardarRoles(){
                this.key_mensajes++;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                const params = {
                        'usuario_id': this.usuario.id,
                        'roles': this.usuario_edicion.roles,
                    };
                    this.axios
                    .put('/administrador/rol/usuario', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                    
                        if(datos.exito){
                            this.mensajes     = datos.exito;
                            this.tipo_mensaje = 'success';
                            
                            this.init();
                            
                            $('#modal-roles').modal('hide');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Editar Perfil';
        },
        
        
    }
</script>