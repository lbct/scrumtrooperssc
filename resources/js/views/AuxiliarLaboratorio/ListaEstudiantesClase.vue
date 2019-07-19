<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="clase">
            <h4>{{clase.nombre_materia}}</h4>
            <h5>({{clase.detalle_grupo_docente}})</h5>
            <p>Aula: {{clase.nombre_aula}} - Horario: {{numeroDia(clase.dia)}} ({{clase.hora_inicio}} - {{clase.hora_fin}})</p>
            <div v-if="estudiantes.length > 0">
                <div class="text-left">
                    <div class="col-xs-12 col-lg-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                  <i class="fas fa-search"></i>
                              </div>
                            </div>
                            <input v-model="busqueda" v-on:keyup="filtrar()"
                                   type="text" class="form-control" placeholder="Nombre del estudiante">
                        </div>
                    </div>
                    <br>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Asistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(estudiante, index) in estudiantes_filtrados">
                                <td>{{index+1}}</td>
                                <td>{{estudiante.nombre}}</td>
                                <td>{{estudiante.apellido}}</td>
                                <td>
                                    <button v-on:click="asistencia(estudiante)" class="btn" type="button">
                                        <i v-if="estudiante.asistencia_sesion" 
                                           class="fas fa-toggle-on fa-2x">
                                        </i>
                                        <i v-else 
                                           class="fas fa-toggle-off fa-2x">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <p v-else>No se tiene estudiantes en esta clase</p>
        </div>
        <p v-else>No tienes acceso a esta clase</p>
    </div>
</template>

<script>    
    export default {
        props: ['sesion_id'],
        data() {
            return {
                busqueda: '',
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                clase: {},
                estudiantes_filtrados: [],
                estudiantes: [],
                estudiante: {id:'', comentario_auxiliar:'', index:''}
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/auxiliarlaboratorio/clase/'+this.sesion_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clase = datos;
                        this.obtenerEstudiantes();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            numeroDia(dia){
                var dia_literal = '';
        
                if (dia == 1) {
                    dia_literal = 'Lunes';
                } else if (dia == 2) {
                    dia_literal = 'Martes';
                } else if (dia == 3) {
                    dia_literal = 'Miercoles';
                } else if (dia == 4) {
                    dia_literal = 'Jueves';
                } else if (dia == 5) {
                    dia_literal = 'Viernes';
                } else if (dia == 6) {
                    dia_literal = 'Sabado';
                } else if (dia == 7) {
                    dia_literal = 'Domingo';
                }
                
                return dia_literal;
            },
            
            obtenerEstudiantes(){
                this.axios
                    .get('/auxiliarlaboratorio/sesion/estudiantes/'+this.sesion_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.estudiantes = datos;
                        this.estudiantes_filtrados = datos;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            filtrar(){
                this.estudiantes_filtrados = this.estudiantes.filter(estudiante => {
                                                    var nombre = estudiante.nombre + ' ' + estudiante.apellido;
                                                    return nombre.toLowerCase().includes(this.busqueda.toLowerCase())
                                             });
            },
            
            asistencia(estudiante){
                var asistencia_sesion = true;
                
                if(estudiante.asistencia_sesion)
                    asistencia_sesion = false;
                
                const params = {
                    'sesion_estudiante_id': estudiante.id,
                    'asistencia_sesion': asistencia_sesion
                };
                this.axios
                    .put('/auxiliarlaboratorio/sesion/estudiante/asistencia', params)
                    .then((response)=>{
                        var datos = response.data;
                        estudiante.asistencia_sesion = asistencia_sesion;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Estudiantes';
        },
    }
</script>