<template>
    <div>
        <h5>(Datos de la gestión en curso)</h5>
        <div class="row">
            <tarjeta-reducida 
                titulo = "Grupos Docentes"
                :valor = "grupos_docentes"
                icono  = "grupo">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Estudiantes Inscritos"
                :valor = "estudiantes_inscritos"
                icono  = "usuarios">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Cantidad de Clases"
                :valor = "cantidad_clases"
                icono  = "horario">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Sesiones Cursadas"
                :valor = "clases_cursadas"
                icono  = "cursado">
            </tarjeta-reducida>
        </div>
            
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label>Selecciona una Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="cambiarMateria()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}} - {{materia.detalle_grupo_docente}}
                        </option>
                    </select>
              </div>
            </center>
            
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Envíos de estudiantes del grupo docente</p>
                  <div v-if="materia.maxima_semana">
                      <apexchart width="100%" height="250px" 
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
                  <p class="card-title">Asistencia de estudiantes del grupo docente</p>
                  <div v-if="materia.maxima_semana">
                      <apexchart width="100%" height="250px" 
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
                
                grupos_docentes: 0,
                estudiantes_inscritos: 0,
                cantidad_clases: 0,
                clases_cursadas: 0,
                
                opciones_envios_chart: {},
                series_envios_chart: [],
                
                opciones_asistencia_chart: {},
                series_asistencia_chart: [],
                
                materias: [],
                materia: {id:'', nombre_materia:'', detalle_grupo_docente:'', maxima_semana:0},
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/auxiliarterminal/materias')
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
                    .get('/auxiliarterminal/estadisticas/gruposdocentes')
                    .then((response)=>{
                        var datos = response.data;
                        this.grupos_docentes = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/auxiliarterminal/estadisticas/estudiantesinscritos')
                    .then((response)=>{
                        var datos = response.data;
                        this.estudiantes_inscritos = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/auxiliarterminal/estadisticas/cantidadclases')
                    .then((response)=>{
                        var datos = response.data;
                        this.cantidad_clases = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/auxiliarterminal/estadisticas/clasescursadas')
                    .then((response)=>{
                        var datos = response.data;
                        this.clases_cursadas = datos;
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
                    .get('/auxiliarterminal/estadisticas/enviospracticas/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.series_envios_chart = [
                            {
                                name: 'En laboratorio',
                                data: datos.en_laboratorio
                            },
                            {
                                name: 'Fuera laboratorio',
                                data: datos.fuera_laboratorio
                            },
                        ];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/auxiliarterminal/estadisticas/asistencia/'+this.materia.id)
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
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Auxiliar de Terminal';
        },
    }
</script>