<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div class="row">
           <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Materias</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{datos.numero_materias}}</h3>
                    <i class="fa fa-university icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                </div>
              </div>
            </div>
             <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Docentes</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{datos.numero_docentes}}</h3>
                    <i class="fa fa-users icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                </div>
              </div>
            </div>
             <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Estudiantes</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{datos.numero_estudiantes}}</h3>
                    <i class="fa fa-users icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                </div>
              </div>
            </div>
             <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Aulas</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{datos.numero_aulas}}</h3>
                    <i class="fa fa-desktop icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card position-relative">
                
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Uso de Laboratorios por Semana</p>
                        <div class="chart-wrap">    
                            <apexchart id="chartAulas" width="500" type="donut" :options="options" :series="series"></apexchart>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <p class="card-title">Distribución de Alumnos en Grupos Docentes</p>
                            <div class="ml-xl-4">
                                <div>
                                <div class="table-responsive mb-3 mb-md-0">
                                    <table class="table table-borderless report-table">
                                    <tbody>
                                        <div v-for="materia in materias">
                                                <tr>
                                                    <td>{{materia.nombre_materia}}</td>
                                                </tr>
                                                <tr v-for="grupo in materia.grupos">
                                                    <td class="text-muted">{{grupo.docentes}}</td>
                                                    <td class="w-100 px-0">
                                                    <div class="progress progress-md mx-4">
                                                        <div class="progress-bar bg-primary" role="progressbar" :style="grupo.style" :aria-valuenow="grupo.porcentaje" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    </td>
                                                    <td><h5 class="font-weight-bold mb-0">{{grupo.inscritos}}</h5></td>
                                                </tr>
                                        </div>
                                    </tbody>
                                    </table>
                                </div>
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
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                datos: {
                    numero_materias: 0,
                    numero_docentes: 0,
                    numero_estudiantes: 0,
                    numero_aulas: 0,
                },

                materias: [],
                materia: {nombre_materia: '', grupos: []},
                grupo: {docentes: '', inscritos: 0, porcentaje: 0, style: ''},

                options: {
                    labels: [],
                },
                series: [],

            }
        },
    
        methods:{
            init(){
                this.getDatos();
                this.getTablaGrupos();
                this.getChartAulas();
            },

            getDatos(){
            this.axios
                .get('/administrador/estadisticas/datos')
                .then((response)=>{
                    this.datos = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getTablaGrupos(){
            this.axios
                .get('/administrador/estadisticas/tablaGrupos')
                .then((response)=>{
                    this.materias = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getChartAulas(){
            this.axios
                .get('/administrador/estadisticas/chartAulas')
                .then((response)=>{
                    this.options = {
                        labels: response.data[0]
                    };
                    this.series = response.data[1];
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

        },   
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Inicio';
        },
    }
</script>