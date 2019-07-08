<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <button v-on:click="mostrarAgregar()"
                class="mb-3 btn btn-primary pull-left">
            Añadir Fecha de Inscripción
        </button>
        <div v-if="fechas.length > 0" class="table-responsive">            
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nº</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(fecha, index) in fechas">
                        <td>{{index+1}}</td>
                        <td>{{fecha.inicio_inscripcion}}</td>
                        <td>{{fecha.fin_inscripcion}}</td>
                        <td>
                            <i v-on:click="mostrarBorrar(fecha, index)" 
                               class="fas fa-trash-alt clickleable">
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No existe fechas de inscripción disponibles</p>
        
        <div class="modal fade" id="modal-agregar-fecha">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Añadir Fecha</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form>
                  <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                  <div class="modal-body">
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
        
        <div class="modal fade" id="modal-borrar-fecha">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar Fecha</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                      <p>¿Estás seguro de eliminar la fecha con inicio {{fecha.inicio_inscripcion}} y fin {{fecha.fin_inscripcion}}?</p>
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
                fechas: [],
                fecha: {id:'', inicio_inscripcion:'', fin_inscripcion:''},
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.obtenerFechas();
            },
            
            obtenerFechas(){
                this.axios
                    .get('/administrador/fechasinscripcion')
                    .then((response)=>{
                        this.fechas = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregar(){
                this.fecha = {id:'', inicio_inscripcion:'', fin_inscripcion:''};
                $('#modal-agregar-fecha').modal('show');
            },
            
            agregar(){
                const params = {
                    'inicio_inscripcion': this.fecha.inicio_inscripcion,
                    'fin_inscripcion': this.fecha.fin_inscripcion,
                };
                this.axios
                    .post('/administrador/fecha', params)
                    .then((response)=>{
                        var fecha = response.data;
                        this.fechas.push(fecha);
                        this.fechas.push(response.data);
                        $('#modal-agregar-fecha').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarBorrar(fecha, index){
                this.fecha = Object.assign({}, fecha);
                this.fecha.index = index;
                
                $('#modal-borrar-fecha').modal('show');
            },
            
            borrar(){
                const params = {
                    'fecha_inscripcion_id': this.fecha.id,
                };
                this.axios
                    .delete('/administrador/fechasinscripcion', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        var index = this.fecha.index;
                        this.fechas.splice(index, 1);
                        $('#modal-borrar-fecha').modal('hide');
                    });
            },
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Fechas de Inscripción';
        },
    }
</script>