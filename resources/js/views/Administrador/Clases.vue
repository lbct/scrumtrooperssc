<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="grupo_docente.id">
            <h4>{{grupo_docente.codigo_materia}} - {{grupo_docente.nombre_materia}}</h4>
            <h5>({{grupo_docente.detalle_grupo_docente}})</h5>
            <h6>{{grupo_docente.anho_gestion}} - {{grupo_docente.periodo}}</h6>
            
            <table :key="key_clases" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miercoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sabado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(horario, hora) in horarios">
                        <td>{{horas[hora]}}</td>
                        <td v-for="(clase, dia) in horario">
                            <div v-for="aula in clase"
                                 class="clickleable table-info custom-td">
                                 {{aula.nombre_aula}}
                            </div>
                            <button v-on:click="mostrarAgregar(hora, dia)"
                                    class="btn">
                                <i class="fas fa-plus clickleable"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="modal fade" id="modal-agregar-clase">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Añadir Clase</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                          <div class="modal-body">
                              <div v-if="aulas_disponibles.length > 0">
                                <label>Aulas disponibles</label>
                                <select v-model="aula" 
                                        class="form-control" >
                                    <option v-for="(aula, index) in aulas_disponibles"
                                            :value="aula">
                                        Aula: {{aula.nombre_aula}}
                                    </option>
                                </select> 
                              </div>
                              <p>No se cuenta con aulas disponibles para este horario</p>
                          </div>

                          <div class="modal-footer">
                            <button v-if="aula.id"
                                    v-on:click="agregar()" 
                                    type="button" class="m-3 btn btn-primary pull-left">
                                Añadir
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          </div>
                    </div>
                  </div>
                </div>
        </div>
        <p v-else>No existe el grupo docente</p>
    </div>
</template>

<script>    
    export default {
        props: ['grupo_docente_id'],
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                grupo_docente: {},
                
                horas: [
                    "06:45/08:15",
                    "08:15/09:45",
                    "09:45/11:15",
                    "11:15/12:45",
                    "12:45/14:15",
                    "14:15/15:45",
                    "15:45/17:15",
                    "17:15/18:45",
                    "18:45/20:15",
                    "20:15/21:45",
                ],
                key_clases: 0,
                horarios: [[[]]],
                clases: [],
                aulas_disponibles: [],
                aula: {},
                horario_id: -1,
                dia: -1,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/administrador/grupodocente/'+this.grupo_docente_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.grupo_docente = datos;
                            this.obtenerHorarios();                   
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerHorarios(){
                for(var i=0; i<10; i++) {
                    this.horarios[i] = [[],[],[],[],[],[]];
                }
                
                this.axios
                    .get('/administrador/clases/'+this.grupo_docente_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clases = datos;
                        this.clases.forEach((clase)=>{
                            var horario = clase.horario_id-1;
                            var dia     = clase.dia-1;
                            if(this.horarios[horario][dia].lenght)
                                this.horarios[horario][dia] = [clase];
                            else
                                this.horarios[horario][dia].push(clase);
                        });
                        this.key_clases++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregar(hora, dia){
                this.horario_id = hora+1;
                this.dia  = dia+1;
                this.aula = {};
                
                this.axios
                    .get('/administrador/clases/disponibles/'+
                         this.grupo_docente.gestion_id+'/'+
                         this.horario_id+'/'+
                         this.dia)
                    .then((response)=>{
                        this.aulas_disponibles = response.data;
                        if(this.aulas_disponibles.length > 0)
                            this.aula = this.aulas_disponibles[0];
                            
                        $('#modal-agregar-clase').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            agregar(){
                const params = {
                    'horario_id': this.horario_id,
                    'dia': this.dia,
                    'aula_id': this.aula.id,
                    'grupo_docente_id': this.grupo_docente_id,
                };
                this.axios
                    .post('/administrador/clase', params)
                    .then((response)=>{
                        this.obtenerHorarios();
                        $('#modal-agregar-clase').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Clases';
        },
    }
</script>