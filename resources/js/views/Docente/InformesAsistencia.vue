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
        
        <div v-for="(materia,index) in materias_envios" class ="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">{{materia.nombre_materia}}</p>
                  <p class="text-muted font-weight-light">
                      (Envíos de estudiantes por semana)
                  </p>
                  <div v-if="materia.semanas">
                      <apexchart width="100%" height="300px" 
                                 type="bar" 
                                 :options="opciones_envios_chart[index]" :series="series_envios_chart[index]">
                      </apexchart>
                  </div>
                  <h5 v-else class="text-muted">No hay semanas disponibles</h5>
                </div>
              </div>
            </div>
        </div>
        
        <div v-for="(materia,index) in materias_asistencia" class ="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">{{materia.nombre_materia}}</p>
                  <p class="text-muted font-weight-light">
                      (Asistencia de estudiantes por semana)
                  </p>
                  <div v-if="materia.semanas">
                      <apexchart width="100%" height="300px" 
                                 type="bar" 
                                 :options="opciones_asistencia_chart[index]" 
                                 :series="series_asistencia_chart[index]">
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
                
                materias_envios: [],
                opciones_envios_chart: [],
                series_envios_chart: [],
                
                materias_asistencia: [],
                opciones_asistencia_chart: [],
                series_asistencia_chart: [],
                
                grupos_docentes: 0,
                guias_practicas: 0,
                estudiantes_inscritos: 0,
                envios_totales:  0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/docente/estadisticas/enviospracticas')
                    .then((response)=>{
                        var datos = response.data;
                        this.materias_envios = datos;
                    
                        this.materias_envios.forEach((materia)=>{
                            var semanas = [];
                            
                            for(var semana=1; semana<=materia.semanas; semana++){
                                semanas.push('Semana '+semana);
                            }
                            
                            this.opciones_envios_chart.push({
                                chart: {
                                    stacked: true,
                                },
                                xaxis: {
                                    categories: semanas
                                },
                            });
                            
                            this.series_envios_chart.push([
                                {
                                    name: 'Fuera laboratorio',
                                    data: materia.fuera_laboratorio
                                },
                                {
                                    name: 'En laboratorio',
                                    data: materia.en_laboratorio
                                },
                            ]);
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/docente/estadisticas/asistencia')
                    .then((response)=>{
                        var datos = response.data;
                        this.materias_asistencia = datos;
                    
                        this.materias_asistencia.forEach((materia)=>{
                            var semanas = [];
                            
                            for(var semana=1; semana<=materia.semanas; semana++){
                                semanas.push('Semana '+semana);
                            }
                            
                            this.opciones_asistencia_chart.push({
                                chart: {
                                    stacked: true,
                                    stackType: '100%'
                                },
                                xaxis: {
                                    categories: semanas
                                },
                            });
                            
                            this.series_asistencia_chart.push([
                                {
                                    name: 'Sin asistencia',
                                    data: materia.no_asistencia,
                                },
                                {
                                    name: 'Asistencia',
                                    data: materia.asistencia,
                                },
                            ]);
                        });
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
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Informes de asistencia';
        },
    }
</script>