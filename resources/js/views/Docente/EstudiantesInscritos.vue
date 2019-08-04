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
                        <select v-model="materia" class="form-control" v-on:change="cambiarMateria()">
                            <option v-for="(materia, index) in materias" 
                                    v-bind:value="materia">
                                {{materia.nombre_materia}}
                            </option>
                        </select>
                  </div>
                </center>
                
                <div v-if="carga_estudiantes">
                    <div v-if="estudiantes.length > 0">
                        <div class="text-right">
                            <h4>Total de estudiantes: {{estudiantes.length}}</h4>
                            <a :href="'/docente/portafolios/'+materia.id"
                               target="_blank" class="mb-3 btn btn-primary">
                                Descargar Portafolios
                            </a>
                            <button v-on:click="mostrarFiltrarSIS()"
                                    class="mb-3 btn btn-success">
                                Filtrar por Código SIS
                            </button>
                            <button v-on:click="mostrarEstadisticas()"
                                    class="mb-3 btn btn-warning">
                                Ver Estadísticas
                            </button>
                        </div>
                        <div class="text-left row mb-3">
                            <div class="col-xs-12 col-lg-4">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                          <i class="fas fa-search"></i>
                                      </div>
                                    </div>
                                    <input v-model="busqueda" v-on:keyup="filtrar()"
                                           type="text" class="form-control" placeholder="Nombre del estudiante">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Código SIS</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Semanas Asistidas</th>
                                        <th scope="col">Envíos en Laboratorio</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(estudiante, index) in estudiantes_filtrados">
                                        <td>{{estudiante.codigo_sis}}</td>
                                        <td>
                                            {{estudiante.nombre}} {{estudiante.apellido}}
                                        </td> 
                                        <td>
                                            {{estudiante.semanas_asistidas}}/{{estudiante.semanas_totales}}
                                        </td>
                                        <td>
                                            {{estudiante.en_laboratorio}}/{{estudiante.envios_totales}}
                                        </td>
                                        <td>
                                            <router-link :to="{ name:'DocentePortafolios', params: {estudiante_clase_id: estudiante.id}}" 
                                                         class="btn">
                                                <i class="fas fa-eye clickleable"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade" id="modal-filtrar-codigosis">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Filtrar por Código SIS</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                  <div class="modal-body">
                                    <h6>Separe cada Código SIS mediante un salto de línea</h6>
                                    <textarea v-model='texto_codigos_sis' 
                                              class="form-control" rows="10">
                                    </textarea>
                                  </div>

                                  <div class="modal-footer">
                                    <button v-on:click="confirmarFiltrarSIS()" 
                                            type="button" class="btn btn-primary">
                                        Filtrar
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Cancelar
                                    </button>
                                  </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="modal fade" id="modal-estadisticas">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Estadísticas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                                  <div class="modal-body">
                                    <h5>Estadísticas de los estudiantes filtrados</h5>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <h6>Asistencia Promedio</h6>
                                            <apexchart type='pie' width='100%' 
                                                       id="chart_estadistica_asistencia"
                                                       :options="opciones_asistencia_chart" 
                                                       :series="series_asistencia_chart">
                                            </apexchart>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <h6>Envíos de Prácticas Promedio</h6>
                                            <apexchart type='pie' width='100%' 
                                                       id="chart_estadistica_asistencia"
                                                       :options="opciones_envios_chart" 
                                                       :series="series_envios_chart">
                                            </apexchart>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Cerrar
                                    </button>
                                  </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <p v-else>No tienes estudiantes inscritos a esta materia</p>
                </div>
                <div v-else class="m-5"><circle-spin></circle-spin></div>
            </div>
            <p v-else>No tienes materias disponibles</p>
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
                materias: [],
                materia: {id: '', nombre_materia: ''},
                busqueda: '',
                estudiantes: [],
                estudiantes_filtrados: [],
                estudiante: {id:'', codigo_sis:'', nombre:'', apellido:'', correo:'', semanas_asistidas:0},
                
                carga_estudiantes: false,
                texto_codigos_sis: '',
                codigos_sis: [],
                
                opciones_asistencia_chart: {},
                series_asistencia_chart: [],
                
                opciones_envios_chart: {},
                series_envios_chart: [],
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
                 this.axios
                    .get('/docente/materias/'+this.gestion.id)
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
                this.carga_estudiantes = false;
                
                this.axios
                    .get('/docente/estudiantes/'+this.materia.id)
                    .then((response)=>{
                        this.estudiantes = response.data;
                        this.estudiantes_filtrados = response.data;
                        
                        this.carga_estudiantes = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            filtrar(){
                this.estudiantes_filtrados = this.estudiantes.filter(estudiante => {
                                                    var nombre = estudiante.nombre + ' ' + estudiante.apellido;
                                                    return nombre.toLowerCase().includes(this.busqueda.toLowerCase())
                                             });
            },
            
            mostrarFiltrarSIS(){
                $('#modal-filtrar-codigosis').modal('show');
            },
            
            confirmarFiltrarSIS(){
                this.codigos_sis = this.texto_codigos_sis.split('\n');
                this.estudiantes_filtrados = [];
                
                if(this.codigos_sis.length > 0 && this.codigos_sis[0].length > 0){
                    this.codigos_sis.forEach(codigo_sis => {
                        if(codigo_sis.length == 9){
                            var estudiante = this.estudiantes.find(estudiante => {
                                                return estudiante.codigo_sis == codigo_sis;
                                             });
                            
                            if(estudiante)
                                this.estudiantes_filtrados.push(estudiante);
                        }
                    });
                }else{
                    this.filtrar();
                }
                
                $('#modal-filtrar-codigosis').modal('hide');
            },
            
            mostrarEstadisticas(){
                this.opciones_asistencia_chart = { 
                    labels: ['Asistencia', 'Sin Asistencia',],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                          chart: {
                            width: '100%'
                          },
                          legend: {
                            position: 'bottom'
                          }
                        }
                    }],
                };
                
                this.opciones_envios_chart = { 
                    labels: ['En Laboratorio', 'Fuera',],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                          chart: {
                            width: '100%'
                          },
                          legend: {
                            position: 'bottom'
                          }
                        }
                    }],
                };
                
                var semanas_total = 0;
                var semanas_asistidas = 0;
                var envios_totales = 0;
                var envios_en_laboratorio = 0;
                
                this.estudiantes_filtrados.forEach(estudiante => {
                    semanas_total+=estudiante.semanas_totales;
                    semanas_asistidas+=estudiante.semanas_asistidas;
                    envios_totales+=estudiante.envios_totales;
                    envios_en_laboratorio+=estudiante.en_laboratorio;
                });
                
                var semanas_sin_asistencia = semanas_total-semanas_asistidas;
                var envios_fuera_laboratorio = envios_totales-envios_en_laboratorio;
                
                this.series_asistencia_chart = [semanas_asistidas, semanas_sin_asistencia];
                this.series_envios_chart = [envios_en_laboratorio, envios_fuera_laboratorio];
                
                $('#modal-estadisticas').modal('show');
            },
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Estudiantes Inscritos';
        },
    }
</script>