<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label for="materia">Selecciona la Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="obetnerPortafolio()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}}
                        </option>
                    </select>
              </div>
            </center>
            
            <div v-if="sesiones.length > 0" class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Asistencia</th>
                            <th scope="col">Semana</th>
                            <th scope="col">Comentario Del Auxiliar</th>
                            <th scope="col">Archivos Subidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sesion in sesiones" v-bind:class="tipoSesion(sesion)">
                            <td v-if="sesion.asistencia_sesion"><i class="fas fa-check"></i></td>
                            <td v-else><i class="fas fa-times"></i></td>
                            <td>{{sesion.semana}}</td>
                            <td>{{sesion.comentario_auxiliar}}</td>
                            <td v-if="sesion.archivos.length">
                                <div v-for="archivo in sesion.archivos">
                                    <a :href="'/estudiante/archivos/practicas/' + archivo.id">{{archivo.archivo}} <i v-if="archivo.en_laboratorio" class="fas fa-vial"></i></a>
                                </div>
                            </td>
                            <td v-else>Sin Archivos</td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="text-left">Porcentaje de asistencia: {{pocentaje_asistencia}}% ({{asistido}}/{{total_sesiones}})</h4>
                <p class="text-left">Arhivos subidos: {{total_arhivos_subidos}} (En laboratorio: {{archivos_laboratorio}})</p>
            </div>
            <h3 v-else>No se ha avanzado ninguna práctica</h3>
        </div>
        <p v-else>No tienes materias inscritas</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                materias: [],
                materia: {'id':'','nombre_materia':''},
                sesiones: [],
                pocentaje_asistencia: 0,
                asistido: 0,
                total_sesiones: 0,
                total_arhivos_subidos: 0,
                archivos_laboratorio: 0,
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/estudiante/materias/inscritas')
                    .then((response)=>{
                        var datos = response.data;
                        this.materias = datos;
                        
                        if(this.materias.length){
                            this.materia = this.materias[0];
                            this.obetnerPortafolio();
                        }                            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            tipoSesion(sesion) {
                if(sesion.asistencia_sesion)
                    return 'table-default';
                else if(sesion.archivos.length)
                    return 'table-warning';
                else
                    return 'table-danger';
            },
            
            obetnerPortafolio(){
                this.pocentaje_asistencia = 0;
                this.asistido = 0;
                this.total_sesiones = 0;
                this.total_arhivos_subidos = 0;
                this.archivos_laboratorio = 0;
                
                this.axios
                    .get('/estudiante/sesiones/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.sesiones = datos;
                    
                        this.total_sesiones = this.sesiones.length;
                    
                        this.sesiones.forEach((sesion)=>{
                            if(sesion.asistencia_sesion)
                                this.asistido++;

                            this.total_arhivos_subidos += sesion.archivos.length;

                            sesion.archivos.forEach((archivo)=>{
                                if(archivo.en_laboratorio)
                                    this.archivos_laboratorio++;
                            });
                        });

                        this.pocentaje_asistencia = Math.round(this.asistido*100/this.total_sesiones);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Portafolio';
        },
    }
</script>