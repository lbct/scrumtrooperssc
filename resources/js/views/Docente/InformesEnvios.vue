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
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Envíos de estudiantes inscritos en el grupo docente</p>
                      <div v-if="carga_grupo_docente">
                          <div v-if="materia.maxima_semana">
                              <apexchart width="100%" height="250px" 
                                         type="bar" 
                                         :options="opciones_envios_chart" 
                                         :series="series_envios_grupodocente_chart">
                              </apexchart>
                          </div>
                          <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                      </div>
                      <div v-else class="m-5"><circle-spin></circle-spin></div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Envíos de estudiantes inscritos con el docente</p>
                      <div v-if="carga_docente">
                          <div v-if="materia.maxima_semana">
                              <apexchart width="100%" height="250px" 
                                         type="bar" 
                                         :options="opciones_envios_chart" :series="series_envios_chart">
                              </apexchart>
                          </div>
                          <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                      </div>
                      <div v-else class="m-5"><circle-spin></circle-spin></div>
                    </div>
                  </div>
                </div>
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
                gestiones: [],
                gestion: {id:'', activa:false},
                
                opciones_envios_chart: {},
                series_envios_chart: [],
                
                series_envios_grupodocente_chart: [],
                
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
                
                this.opciones_envios_chart = {
                    chart: {
                        stacked: true,
                    },
                    xaxis: {
                        categories: semanas
                    },
                };
                
                this.axios
                    .get('/docente/estadisticas/enviospracticas/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                    
                        this.series_envios_chart = [
                            {
                                name: 'En laboratorio',
                                data: datos.en_laboratorio,
                            },
                            {
                                name: 'Fuera laboratorio',
                                data: datos.fuera_laboratorio,
                            },
                        ];
                    
                        this.carga_grupo_docente = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/enviospracticas/grupo/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                    
                        this.series_envios_grupodocente_chart = [
                            {
                                name: 'En laboratorio',
                                data: datos.en_laboratorio,
                            },
                            {
                                name: 'Fuera laboratorio',
                                data: datos.fuera_laboratorio,
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
            this.$parent.$parent.section = 'Envíos';
        },
    }
</script>