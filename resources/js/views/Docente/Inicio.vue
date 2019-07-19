<template>
    <div>
        <h5>(Datos de la gestión en curso)</h5>
        <div class="row">
            <tarjeta-reducida 
                titulo = "Grupos Docentes"
                :valor  = "grupos_docentes"
                icono  = "grupo">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Guías Prácticas"
                :valor  = "guias_practicas"
                icono  = "archivo">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Estudiantes Inscritos"
                :valor  = "estudiantes_inscritos"
                icono  = "usuarios">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Envíos de estudiantes"
                :valor  = "envios_totales"
                icono  = "subir">
            </tarjeta-reducida>
        </div>
        
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
                  <p class="card-title">Envíos de estudiantes por semana</p>
                  <p class="text-muted font-weight-light">
                      ({{materia.nombre_materia}})
                  </p>
                  <div v-if="materia.maxima_semana">
                      <apexchart width="100%" height="300px" 
                                 type="bar" 
                                 :options="opciones_envios_chart" :series="series_envios_chart">
                      </apexchart>
                  </div>
                  <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                </div>
              </div>
            </div>
            
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Asistencia de estudiantes por semana</p>
                  <p class="text-muted font-weight-light">
                      ({{materia.nombre_materia}})
                  </p>
                  <div v-if="materia.maxima_semana">
                      <apexchart width="100%" height="300px" 
                                 type="bar" 
                                 :options="opciones_asistencia_chart" 
                                 :series="series_asistencia_chart">
                      </apexchart>
                  </div>
                  <h5 v-else class="text-muted">No hay semanas disponibles</h5>
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
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                opciones_envios_chart: {},
                series_envios_chart: [],
                
                opciones_asistencia_chart: {},
                series_asistencia_chart: [],
                
                grupos_docentes: 0,
                guias_practicas: 0,
                estudiantes_inscritos: 0,
                envios_totales:  0,
                
                materias: [],
                materia: {id:'', nombre_materia:'', maxima_semana:0},
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/docente/materias')
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
                
                this.axios
                    .get('/docente/estadisticas/gruposdocentes')
                    .then((response)=>{
                        var datos = response.data;
                        this.grupos_docentes = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/guiaspracticas')
                    .then((response)=>{
                        var datos = response.data;
                        this.guias_practicas = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/estudiantesinscritos')
                    .then((response)=>{
                        var datos = response.data;
                        this.estudiantes_inscritos = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/enviostotales')
                    .then((response)=>{
                        var datos = response.data;
                        this.envios_totales = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarMateria(){
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
                    .get('/docente/estadisticas/enviospracticas/'+this.materia.id)
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
                    .get('/docente/estadisticas/asistencia/'+this.materia.id)
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
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Docente';
        },
    }
</script>