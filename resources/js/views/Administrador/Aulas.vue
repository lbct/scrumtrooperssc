<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <button v-on:click="mostrarAgregar()"
                class="mb-3 btn btn-primary pull-left">
            Añadir Aula
        </button>
        <div v-if="aulas.length > 0" class="table-responsive">            
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
                    <tr v-for="(aula, index) in aulas">
                        <td>{{index+1}}</td>
                        <td>{{aula.codigo_aula}}</td>
                        <td>{{aula.nombre_aula}}</td>
                        <td>{{aula.detalle_aula}}</td>
                        <td>
                            <i v-on:click="mostrarEditar(aula, index)"
                               class="fas fa-edit clickleable">
                            </i>
                            <i v-on:click="mostrarBorrar(aula, index)" 
                               class="fas fa-trash-alt clickleable">
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No tienes aulas disponibles</p>
        
        <div class="modal fade" id="modal-agregar-aula">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Añadir Aula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                  <div class="modal-body">
                        <div class="form-group">
                          <label>Código</label>
                          <input v-model='aula.codigo_aula' class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label>Nombre</label>
                          <input v-model='aula.nombre_aula' class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label>Detalle</label>
                          <input v-model='aula.detalle_aula'class="form-control" required>
                        </div>
                  </div>

                  <div class="modal-footer">
                    <button v-on:click="agregar()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Añadir
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-editar-aula">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Aula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                  <div class="modal-body">
                        <div class="form-group">
                          <label>Código</label>
                          <input v-model='aula.codigo_aula' class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label>Nombre</label>
                          <input v-model='aula.nombre_aula' class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label>Detalle</label>
                          <input v-model='aula.detalle_aula'class="form-control" required>
                        </div>
                  </div>

                  <div class="modal-footer">
                    <button v-on:click="editar()" 
                            type="button" class="m-3 btn btn-primary pull-left">
                        Editar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-borrar-aula">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar Aula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                      <p>¿Estás seguro de eliminar el aula {{aula.nombre_aula}} con código: {{aula.codigo_aula}}?</p>
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
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                aulas: [],
                aula: {id:'', codigo_aula:'', nombre_aula:'', detalle_aula:''},
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.obtenerAulas();
            },
            
            obtenerAulas(){
                this.axios
                    .get('/administrador/aulas')
                    .then((response)=>{
                        this.aulas = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregar(){
                this.aula = {id:'', codigo_aula:'', nombre_aula:'', detalle_aula:''};
                $('#modal-agregar-aula').modal('show');
            },
            
            agregar(){
                const params = {
                    'codigo_aula': this.aula.codigo_aula,
                    'nombre_aula': this.aula.nombre_aula,
                    'detalle_aula': this.aula.detalle_aula,
                };
                this.axios
                    .post('/administrador/aula', params)
                    .then((response)=>{
                        var aula = response.data;
                        this.aulas.push(aula);
                        this.aulas.push(response.data);
                        $('#modal-agregar-aula').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarEditar(aula, index){
                this.aula = Object.assign({}, aula);
                this.aula.index = index;
                
                $('#modal-editar-aula').modal('show');
            },
            
            editar(){
                const params = {
                    'aula_id': this.aula.id,
                    'codigo_aula': this.aula.codigo_aula,
                    'nombre_aula': this.aula.nombre_aula,
                    'detalle_aula': this.aula.detalle_aula,
                };
                this.axios
                    .put('/administrador/aula', params)
                    .then((response)=>{
                        var index = this.aula.index;
                        this.aulas[index].codigo_aula = this.aula.codigo_aula;
                        this.aulas[index].nombre_aula = this.aula.nombre_aula;
                        this.aulas[index].detalle_aula = this.aula.detalle_aula;
                        $('#modal-editar-aula').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarBorrar(aula, index){
                this.aula = Object.assign({}, aula);
                this.aula.index = index;
                
                $('#modal-borrar-aula').modal('show');
            },
            
            borrar(){
                const params = {
                    'aula_id': this.aula.id,
                };
                this.axios
                    .delete('/administrador/aula', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        var index = this.aula.index;
                        this.aulas.splice(index, 1);
                        $('#modal-borrar-aula').modal('hide');
                    });
            },
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Aulas';
        },
    }
</script>