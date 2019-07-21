<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <form v-on:submit.prevent="guardarDatos()">
            <div class="container col-md-5 col-md-offset-4  ">
                <div class="row">
                    <div class="panel panel-default">
                        <div>
                            <div class="form-row">
                                <div class="col-md-6 mb-10">
                                    <label>Nombres</label>
                                    <input v-model="usuario.nombre" type="text" class="form-control" placeholder="Nombres" tabindex="1" required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label>Apellidos</label>
                                    <input v-model="usuario.apellido" type="text" class="form-control" placeholder="Apellidos" tabindex="2" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label>Correo</label>
                                    <input v-model="usuario.correo" type="email" class="form-control input-lg" placeholder="nombre@ejemplo.com" tabindex="3" required>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="form-group row justify-content-center">
                                <input type="submit" value="Guardar" class="m-3 btn btn-primary pull-left">

                                <button v-on:click="mostrarCambiarPassword()" type="button" class="m-3 btn btn-danger">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
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
                          <label>Contraseña Actual</label>
                          <input v-model='usuario.old_password' type="password" class="form-control" required>
                        </div>

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
                    <button v-on:click="cambiarPassword()" type="button" class="m-3 btn btn-primary pull-left">Guardar</button>
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
                
                mensajes_password: '',
                tipo_mensajes_password: '',
                key_mensajes_password: 0,
                
                usuario: {id:'', nombre: '', apellido:'', correo:'', old_password:'', password:''},
                repetir_password: '',
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/usuario')
                    .then((response)=>{
                        this.usuario.id       = response.data.id;
                        this.usuario.nombre   = response.data.nombre;
                        this.usuario.apellido = response.data.apellido;
                        this.usuario.correo   = response.data.correo;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            guardarDatos(){
                this.key_mensajes++;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                const params = {'usuario': this.usuario};
                this.axios
                    .put('/usuario', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                    
                        if(datos.exito!=null){
                            this.mensajes     = datos.exito;
                            this.tipo_mensaje = 'success';
                        }
                        else if(datos.error!=null){
                            this.mensajes     = datos.error;
                            this.tipo_mensaje = 'danger';
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarCambiarPassword(){
                this.key_mensajes = 0;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                this.key_mensajes_password = 0;
                this.mensajes_password = [];
                this.tipo_mensajes_password = '';
                
                $('#modal-cambiar-password').modal('show');
            },
            
            cambiarPassword(){
                this.key_mensajes_password++;
                this.mensajes_password = [];
                this.tipo_mensajes_password = 'danger';
                
                if(!this.repetir_password || 
                   !this.usuario.password || 
                   !this.usuario.old_password ){
                    this.mensajes_password.push('Ningún campo puede estar vacío');
                }
                
                if(this.repetir_password.localeCompare(this.usuario.password)){
                    this.mensajes_password.push('Las contraseñas no coinciden');
                }
                
                if(this.mensajes_password.length == 0){
                    const params = {'usuario': this.usuario};
                    this.axios
                    .put('/usuario/password', params)
                    .then((respuesta)=>{
                        var datos = respuesta.data;
                    
                        if(datos.exito!=null){
                            this.mensajes     = datos.exito;
                            this.tipo_mensaje = 'success';
                            
                            this.usuario.old_password = '';
                            this.usuario.password = '';
                            this.repetir_password = '';
                            $('#modal-cambiar-password').modal('hide');
                        }
                        else if(datos.error!=null){
                            this.mensajes_password  = datos.error;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            }
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Editar Perfil';
        },
        
        
    }
</script>