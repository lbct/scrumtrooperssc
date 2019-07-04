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
            
            <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
            <div v-if="auxiliares.length > 0" class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Nombre del auxiliar</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Clases cursadas</th>
                            <th scope="col" v-if="gestion.activa">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(auxiliar, index) in auxiliares">
                            <td>{{auxiliar.nombre_materia}}</td>
                            <td>{{auxiliar.nombre}} {{auxiliar.apellido}}</td>
                            <td>{{auxiliar.correo}}</td>
                            <td>{{auxiliar.clases_cursadas}}</td>
                            <td v-if="gestion.activa">
                                <i v-on:click="mostrarRetirarAuxiliar(auxiliar, index)" class="fas fa-trash-alt clickleable"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="text-left">Total de clases cursadas: {{clases_cursadas}}</h4>
            </div>
            <p v-else>No cuentas con auxiliares asignados</p>
            
            <div class="modal fade" id="modal-retirar_auxiliar">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Retirar Auxiliar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form>
                      <div class="modal-body">
                          {{auxiliar.nombre_materia}} - {{auxiliar.nombre}} {{auxiliar.apellido}}
                          <p>¿Estás seguro de retirar a este Auxiliar?</p>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="retirarAuxiliar(auxiliar)" type="button" class="m-3 btn btn-primary pull-left">Confirmar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
        <p v-else>No tienes gestiones disponibles</p>
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
                auxiliares: [],
                auxiliar: {id:'', nombre_materia:'', nombre:'', apellido:'', correo:'', clases_cursadas:''},
                clases_cursadas: 0,
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.axios
                    .get('/docente/gestiones')
                    .then((response)=>{
                        this.gestiones = response.data;
                        if(this.gestiones.length){
                            const gestion = this.gestiones.find(gestion => gestion.activa == true);
                            this.gestion = gestion;
                            this.cambiarGestion();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarGestion(){
                 this.axios
                    .get('/docente/auxiliares/'+this.gestion.id)
                    .then((response)=>{
                        this.auxiliares = response.data;
                        this.calcularClasesCursadas();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            calcularClasesCursadas(){
                this.clases_cursadas = 0;
                this.auxiliares.forEach((auxiliar)=>{
                    this.clases_cursadas+=auxiliar.clases_cursadas;
                });
            },
            
            mostrarRetirarAuxiliar(auxiliar, index){
                this.auxiliar = auxiliar;
                this.auxiliar.index = index;
                $('#modal-retirar_auxiliar').modal('show');
            },
            
            retirarAuxiliar(auxiliar){
                const params = {
                    'grupo_docente_auxiliar_id': auxiliar.grupo_docente_auxiliar_id,
                };
                this.axios
                    .delete('/docente/auxiliares', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.clases_cursadas-=auxiliar.clases_cursadas;
                            this.auxiliares.splice(auxiliar.index,1);
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            $('#modal-retirar_auxiliar').modal('hide');
                        }
                        else if(datos.error){

                        }
                    });
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Auxiliares';
        },
    }
</script>