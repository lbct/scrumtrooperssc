<template>
    <div>
        <h5>(Datos de la gestión en curso)</h5>
        <div class="row">
            <tarjeta-reducida 
                titulo = "Grupos Docentes"
                valor  = "1"
                icono  = "grupo">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Guías Prácticas"
                valor  = "1"
                icono  = "archivo">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Estudiantes Inscritos"
                valor  = "1"
                icono  = "usuarios">
            </tarjeta-reducida>
            
            <tarjeta-reducida 
                titulo = "Envíos de estudiantes"
                valor  = "1"
                icono  = "subir">
            </tarjeta-reducida>
        </div>
        
        <div class ="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Envíos de estudiantes por mes</p>
                  <p class="text-muted font-weight-light">
                      Estos son los envíos realizados en los últimos 6 meses
                  </p>
                </div>
              </div>
            </div>
        </div>
        
        <div class ="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Envíos de estudiantes por mes</p>
                  <p class="text-muted font-weight-light">
                      Estos son los envíos realizados en los últimos 6 meses
                  </p>
                  <apexchart width="100%" type="bar" :options="options" :series="series"></apexchart>
                </div>
              </div>
            </div>
        
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Asistencia a clases por mes</p>
                  <p class="text-muted font-weight-light">
                      Esta es la asistencia de los estudiantes en los últimos 6 meses
                  </p>
                  <apexchart width="100%" type="bar" :options="options" :series="series"></apexchart>
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
                options: {
                    chart: {
                      id: 'vuechart-example'
                    },
                    xaxis: {
                      categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                    }
                },
                series: [{
                    name: 'series-1',
                    data: [30, 40, 45, 50, 49, 60, 70, 151]
                }],
            }
        },
    
        methods:{
            init(){
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Docente';
        },
    }
</script>