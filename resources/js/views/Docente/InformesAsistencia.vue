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
                
                <div class="row">
                    <div class="col-12 col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <p class="card-title">Asistencia de estudiantes inscritos en el grupo docente</p>
                          <div v-if="carga_grupo_docente">
                              <div v-if="materia.maxima_semana">
                                  <apexchart width="100%" height="250px" 
                                             type="bar" 
                                             :options="opciones_asistencia_chart" 
                                             :series="series_asistencia_grupodocente_chart">
                                  </apexchart>
                              </div>
                              <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                          </div>
                          <div v-else class="m-5"><circle-spin></circle-spin></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <p class="card-title">Asistencia de estudiantes inscritos con el docente</p>
                          <div v-if="carga_docente">
                              <div v-if="materia.maxima_semana">
                                  <apexchart width="100%" height="250px" 
                                             type="bar" 
                                             :options="opciones_asistencia_chart" 
                                             :series="series_asistencia_chart">
                                  </apexchart>
                              </div>
                              <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                          </div>
                          <div v-else class="m-5"><circle-spin></circle-spin></div>
                        </div>
                      </div>
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
                gestiones: [],
                gestion: {id:'', activa:false},
                
                series_asistencia_grupodocente_chart: [],
                
                opciones_asistencia_chart: {},
                series_asistencia_chart: [],
                
                materias: [],
                materia: {id:'', nombre_materia:'', maxima_semana:0},
                
                carga_grupo_docente: false,
                carga_docente: false,
            }
        },
    
        methods:{
            init(){
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
                this.carga_grupo_docente = false;
                this.carga_docente = false;
                
                var semanas = [];
                for(var semana=1; semana<=this.materia.maxima_semana; semana++){
                    semanas.push('Semana '+semana);
                }
                
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
                    .get('/docente/estadisticas/asistencia/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.series_asistencia_chart = [
                            {
                                name: 'Asistencia',
                                data: datos.asistencia,
                            },
                            {
                                name: 'Sin asistencia',
                                data: datos.no_asistencia,
                            },
                        ];
                    
                        this.carga_grupo_docente = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/asistencia/grupo/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.series_asistencia_grupodocente_chart = [
                            {
                                name: 'Asistencia',
                                data: datos.asistencia,
                            },
                            {
                                name: 'Sin asistencia',
                                data: datos.no_asistencia,
                            },
                        ];
                    
                        this.carga_docente = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Asistencia';
        },
    }
</script>