<template>
    <div>        
        <div v-if="usuarios.length > 0">
            <div class="text-right">
                <h4>Total de usuarios: {{usuarios.length}}</h4>
            </div>
            <div class="text-left">
                <div class="col-xs-12 col-lg-4">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input v-model="busqueda" v-on:keyup="filtrar()"
                               type="text" class="form-control" placeholder="Nombre del usuario">
                    </div>
                </div>
                <br>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre de Usuario</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(usuario, index) in usuarios_filtrados">
                            <td>{{usuario.username}}</td>
                            <td>{{usuario.nombre}} {{usuario.apellido}}</td>
                            <td>{{usuario.correo}}</td>
                            <td>
                                <router-link :to="{ name:'AdministradorUsuario', params: {usuario_id: usuario.usuario_id}}" 
                                             class="btn">
                                    <i class="fas fa-eye clickleable"></i>
                                </router-link>
                                <button v-on:click="mostrarBorrar(usuario, index)"
                                        class="btn">
                                    <i class="fas fa-trash-alt clickleable"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="modal fade" id="modal-borrar-usuario">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Eliminar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                          <p>¿Estás seguro de eliminar el usuario {{usuario.username}}?</p>
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
        <h5 v-else>No se cuenta con usuarios</h5>
    </div>
</template>

<script>    
    export default {
        props: ['usuarios'],
        data() {
            return {                
                usuarios_filtrados: [],
                usuario: {id:'', nombre:'', apellido:'', correo:'', username:''},
                busqueda: '',
            }
        },
    
        methods:{
            init(){
                this.usuarios_filtrados = Object.assign({}, this.usuarios);
            },
            
            filtrar(){
                this.usuarios_filtrados = this.usuarios.filter(usuario => {
                                            var nombre = usuario.nombre + ' ' + usuario.apellido;
                                            return nombre.toLowerCase().includes(this.busqueda.toLowerCase())
                                          });
            },
            
            mostrarBorrar(usuario, index){
                this.usuario = usuario;
                this.usuario.index = index;
                $('#modal-borrar-usuario').modal('show');
            },
            
            borrar(){
                const params = {
                    'usuario_id': this.usuario.usuario_id,
                };
                this.axios
                    .delete('/administrador/usuario', { data: params })
                    .then((response)=>{
                        var index = this.usuarios.findIndex((usuario)=>{
                            return usuario.usuario_id == this.usuario.usuario_id;
                        });
                        this.usuarios.splice(index, 1);
                        this.usuarios_filtrados.splice(this.usuario.index, 1);
                        $('#modal-borrar-usuario').modal('hide');
                    });
            }
        },            
        
        mounted(){
            this.init();
        },
    }
</script>