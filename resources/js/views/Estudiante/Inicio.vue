<template>
    <div>
        <h5>(Datos de la gestión en curso)</h5>
        <div class="row">
            <tarjeta-reducida 
                titulo = "Materias Inscritas"
                :valor = "datos.numero_materias"
                icono  = "materia"
                ruta   = "EstudianteEstadoInscripcion">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Envíos Totales"
                :valor = "datos.cantidad_envios"
                icono  = "archivo"
                ruta   = "EstudiantePortafolio">
            </tarjeta-reducida>
            
            <tarjeta-reducida
                titulo = "En Laboratorio"
                :valor = "datos.en_laboratorio"
                icono =  'laboratorio'
                ruta   = "EstudiantePortafolio">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Fuera de Laboratorio"
                :valor = "datos.fuera_laboratorio"
                icono  = "afuera"
                ruta   = "EstudiantePortafolio">
            </tarjeta-reducida>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Horario para hoy ({{datos.fecha}})</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Hora</th>
                                    <th scope="col" >Materia</th>
                                    <th scope="col" >Aula</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="datos in tabla_clases">
                                    <td v-for="dato in datos">{{dato}}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
            <div v-if="asistencia.total" class="col-md-6 grid-margin stretch-card align-self-start">
                <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Porcentaje de Asistencia</p>
                        <div class="chart-wrap" >
                            <apexchart id="chartAsistencia" width="100%" type="radialBar" 
                                       :options="options" :series="series">
                            </apexchart>
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

                datos: {numero_materias: 0, fecha: '', cantidad_envios: 0, en_laboratorio: 0, fuera_laboratorio: 0},

                tabla_clases: [],
                
                asistencia: {en_laboratorio:0, fuera_laboratorio:0, total:0},

                options: {
                    labels: ['Asistencia'],
                },

                series: [],

                hours: '',
                minutes: '',
                seconds: '',
                hourtime: ''
            }
        },

        ready: function ready() {
            this.updateDateTime();
        },

        methods:{
            init(){
                this.getDatos();
                this.getTablaClases();
                this.getAsistencia();
            },

            getDatos(){
            this.axios
                .get('/estudiante/estadisticas/datos')
                .then((response)=>{
                    this.datos = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getTablaClases(){
            this.axios
                .get('/estudiante/estadisticas/tabla_clases')
                .then((response)=>{
                    this.tabla_clases = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getAsistencia(){
            this.axios
                .get('/estudiante/estadisticas/asistencia')
                .then((response)=>{
                    var datos = response.data;
                    this.asistencia = datos;
                    this.series = [100*datos.asistencia/datos.total];
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            updateDateTime: function updateDateTime() {
                var self = this;
                var now = new Date();

                self.hours = now.getHours();
                self.minutes = self.getZeroPad(now.getMinutes());
                self.seconds = self.getZeroPad(now.getSeconds());
                self.hourtime = self.getHourTime(self.hours);
                self.hours = self.hours % 12 || 12;

                setTimeout(self.updateDateTime, 1000);
            },

            getHourTime: function getHourTime(h) {
                return h >= 12 ? 'PM' : 'AM';
            },
            
            getZeroPad: function getZeroPad(n) {
                return (parseInt(n, 10) >= 10 ? '' : '0') + n;
            }

        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Estudiante';
        },
    }
</script>