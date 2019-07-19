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
                                     v-bind:class="'clickleable custom-td '+colorGrupoDocente(materia.id)">
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
              <div class="modal-dialog modal-lg">
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
                          
                        <div v-if="materia.semana_actual_sesion" class="row">
                          <div class="col-12 col-md-6">
                          <h6>Envíos de estudiantes por semana</h6>
                          <apexchart width="100%" height="300px" 
                                     type="bar" 
                                     :options="opciones_envios_chart" 
                                     :series="series_envios_chart">
                          </apexchart>
                          </div>
                            
                          <div class="col-12 col-md-6">
                          <h6>Asistencia de estudiantes por semana</h6>
                          <apexchart width="100%" height="300px" 
                                     type="bar" 
                                     :options="opciones_asistencia_chart" 
                                     :series="series_asistencia_chart">
                          </apexchart>
                          </div>
                        </div>
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
                
                opciones_envios_chart: {},
                series_envios_chart: [],
                opciones_asistencia_chart: {},
                series_asistencia_chart: [],
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
                
                var semanas = [];
                for(var semana=1; semana<=this.materia.semana_actual_sesion; semana++){
                    semanas.push('Semana '+semana);
                }
                
                this.opciones_envios_chart = {
                    chart: {
                        stacked: true,
                    },
                    xaxis: {
                        categories: semanas
                    },
                };
                
                this.opciones_asistencia_chart = {
                    chart: {
                        stacked: true,
                        stackType: '100%'
                    },
                    xaxis: {
                        categories: semanas
                    },
                };
                
                this.axios
                    .get('/docente/estadisticas/enviospracticas/clase/'+this.materia.clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.series_envios_chart = [
                            {
                                name: 'Fuera laboratorio',
                                data: datos.fuera_laboratorio
                            },
                            {
                                name: 'En laboratorio',
                                data: datos.en_laboratorio
                            },
                        ];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/asistencia/clase/'+this.materia.clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.series_asistencia_chart = [
                            {
                                name: 'Sin asistencia',
                                data: datos.no_asistencia,
                            },
                            {
                                name: 'Asistencia',
                                data: datos.asistencia,
                            },
                        ];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                $('#modal-ver-mas-clase').modal('show');
            },
            
            colorGrupoDocente(grupo_docente_id) {
                var grupo_docente = grupo_docente_id%8;
                
                if(grupo_docente == 1)
                    return 'table-primary';
                else if(grupo_docente == 2)
                    return 'table-secondary';
                else if(grupo_docente == 3)
                    return 'table-success';
                else if(grupo_docente == 4)
                    return 'table-danger';
                else if(grupo_docente == 5)
                    return 'table-warning';
                else if(grupo_docente == 6)
                    return 'table-info';
                else if(grupo_docente == 7)
                    return 'table-light';
                else if(grupo_docente == 8)
                    return 'table-dark';
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Clases';
        },
    }
</script>