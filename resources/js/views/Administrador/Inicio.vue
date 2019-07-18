<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div class="row">
           <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title text-md-center text-xl-left">Materias</p>
                  <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{numero_materias}}</h3>
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
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{numero_docentes}}</h3>
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
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{numero_estudiantes}}</h3>
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
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{numero_aulas}}</h3>
                    <i class="fa fa-desktop icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>  
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <p class="card-title">Uso de Laboratorios por Semana</p>
                    <div class="ml-xl-4">
                        <div>
                          <div class="table-responsive mb-3 mb-md-0">
                            <table class="table table-borderless report-table">
                              <tbody>
                                  <div v-for="materia in materias">
                                        <tr>
                                            <td>{{materia.nombre}}</td>
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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body align-items-center">
                        <p class="card-title">Uso de Laboratorios por Semana</p>
                        <div class="ml-xl-4">    
                            <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="north-america-chart" width="350" height="150" class="chartjs-render-monitor" style="display: block; width: 350px; height: 150px;"></canvas>
                            <div id="north-america-legend"><div class="report-chart"><div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center">
                                <div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: #71c016"></div><p class="mb-0">Offline sales</p></div><p class="mb-0">22789</p></div><div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center">
                                <div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: #8caaff"></div><p class="mb-0">Online sales</p></div><p class="mb-0">94678</p></div><div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center">
                                <div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: #248afd"></div><p class="mb-0">Returns</p></div><p class="mb-0">12097</p></div></div></div>
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
                
                numero_materias: 0,
                numero_docentes: 0,
                numero_estudiantes: 0,
                numero_aulas: 0,

                materias: [],
                materia: {nombre: '', grupos: []},
                grupo: {docentes: '', inscritos: 0, porcentaje: 0, style: ''},
            }
        },
    
        methods:{
            init(){
                this.getDatos();
                this.getTablaGrupos();
            },

            getDatos(){
            this.axios
                .get('/administrador/estadisticas/datos')
                .then((response)=>{
                    this.numero_materias = response.data[0];
                    this.numero_docentes = response.data[1];
                    this.numero_estudiantes = response.data[2];
                    this.numero_aulas = response.data[3];
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            getTablaGrupos(){
                this.axios
                    .get('/administrador/estadisticas/tablaGrupos')
                    .then((response)=>{
                        
                        for (var c=0; c < response.data.length; c++){
                            var m ={nombre: '', grupos: []};
                            m.nombre = response.data[c][0];
                            var inscritos_en_materia = 0;
                            if (response.data[c].length > 1)
                                for (var x=1; x<response.data[c].length; x++){

                                    var temp =  {docentes: '', inscritos: 0};
                                    temp.docentes = response.data[c][x][0];
                                    temp.inscritos = response.data[c][x][1];
                                    inscritos_en_materia += temp.inscritos;
                                    m.grupos.push(temp);

                                }
                            for (var x=0; x<m.grupos.length; x++){
                                m.grupos[c].porcentaje = (100*temp.inscritos/inscritos_en_materia).toFixed();
                                m.grupos[c].style = "width: " + temp.porcentaje + "%";
                            }
                             this.materias.push(m);
                             console.log(m.nombre);
                        }

                        console.log(this.materias);
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