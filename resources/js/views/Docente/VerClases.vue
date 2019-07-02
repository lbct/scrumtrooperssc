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
            <div v-if="horarios.length > 0" class="table-responsive">
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
                        <tr v-for="(clase, index) in clases">
                            <td>{{horas[index]}}</td>
                            <td v-for="horario in clase">
                                <div v-for="materia in horario"
                                     v-on:click="verMasMateria(materia)"
                                     class="clickleable table-info custom-td">
                                    {{materia.nombre_materia}}<br>
                                    {{materia.nombre_aula}}<br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else>No se tiene ninguna clase disponible</p>
            
            <div class="modal fade" id="modal-ver-mas-clase">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">{{materia.nombre_materia}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        <h3 v-if="materia.semana_actual_sesion">Semana: {{materia.semana_actual_sesion}}</h3>
                        <h3 v-else>Clase sin iniciar</h3>
                        <p>Materia: {{materia.nombre_materia}}</p>
                        <p>Grupo Docente: {{materia.detalle_grupo_docente}}</p>
                        <p>Aula: {{materia.nombre_aula}}</p>
                        <p>Horario: {{materia.hora_inicio}} - {{materia.hora_fin}}</p>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      </div>
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
                gestiones: [],
                gestion: {id:'', activa:false},
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
                horarios: [],
                clases: [[[]]],
                key_clases: 0,
                materia: {nombre_aula:'', nombre_materia:'', detalle_grupo_docente:'', semana_actual_sesion:''},
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
                for(var i=0; i<10; i++) {
                    this.clases[i] = [[],[],[],[],[],[]];
                }
                
                this.axios
                    .get('/docente/clases/'+this.gestion.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.horarios = datos;
                        datos.forEach((materia)=>{
                            var horario = materia.horario_id-1;
                            var dia     = materia.dia-1;
                            if(this.clases[horario][dia].lenght)
                                this.clases[horario][dia] = [materia];
                            else
                                this.clases[horario][dia].push(materia);
                        });
                        this.key_clases++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            verMasMateria(materia){
                this.materia = materia;
                $('#modal-ver-mas-clase').modal('show');
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Clases';
        },
    }
</script>