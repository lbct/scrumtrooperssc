<template>
    <div>
        <h5>(Datos de la gestión en curso)</h5>
        <div class="row">
            <tarjeta-reducida 
                titulo = "Materias"
                :valor = "datos.numero_materias"
                icono  = "materia"
                ruta   = "AdministradorMaterias">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Docentes"
                :valor = "datos.numero_docentes"
                icono  = "grupo"
                ruta   = "AdministradorDocentes">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Estudiantes"
                :valor = "datos.numero_estudiantes"
                icono  = "usuarios"
                ruta   = "AdministradorEstudiantes">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Aulas"
                :valor = "datos.numero_aulas"
                icono  = "aula"
                ruta   = "AdministradorAulas">
            </tarjeta-reducida>
        </div>
        
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Horarios por laboratorio para hoy ({{tabla_aulas.fecha}})</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Hora</th>
                                    <th v-for="nombre in tabla_aulas.aulas" scope="col" >{{nombre}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="datos in tabla_aulas.horas">
                                    <td v-for="dato in datos">{{dato}}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card align-self-start">
                <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Uso de Laboratorios por Semana</p>
                        <div class="chart-wrap" >    
                            <apexchart id="chartAulas" width="100%" type="donut" 
                                       :options="options" :series="series">
                            </apexchart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <p class="card-title">Distribución de Alumnos en Grupos Docentes</p>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                            <tbody>
                                <div v-for="materia in materias">
                                    <tr v-if="materia.grupos.length > 0" class="table-secondary d-flex">
                                        <td>{{materia.nombre_materia}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr v-for="grupo in materia.grupos" class="d-flex">
                                        <td class="text-muted col-5 overflow-auto">{{grupo.docentes}}</td>
                                        <td class="w-100 px-0 col-6">
                                            <div class="progress progress-md mx-4">
                                                <div class="progress-bar bg-primary" role="progressbar" 
                                                     :style="grupo.style" 
                                                     :aria-valuenow="grupo.porcentaje"
                                                     aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-1">
                                            <h5 class="font-weight-bold mb-0">{{grupo.inscritos}}</h5>
                                        </td>
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

                tabla_aulas: {aulas: [], horas: [], fecha: ''},

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
                this.getTablaAulas();
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

            getTablaAulas(){
            this.axios
                .get('/administrador/estadisticas/tablaAulas')
                .then((response)=>{
                    this.tabla_aulas = response.data;
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
            this.$parent.$parent.section = 'Administrador';
        },
    }
</script>