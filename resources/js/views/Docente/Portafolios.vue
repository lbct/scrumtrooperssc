<template>
    <div>
        <div v-if="clase">
            <h4>{{clase.nombre_materia}}</h4>
            <p>Aula: {{clase.nombre_aula}} - Horario: {{numeroDia(clase.dia)}} ({{clase.hora_inicio}} - {{clase.hora_fin}})</p>
            
            <h4>{{estudiante.nombre}} {{estudiante.apellido}}</h4>
            <p>Código SIS: {{estudiante.codigo_sis}} - Correo: {{estudiante.correo}}</p>
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
        <h3 v-else>No tienes acceso a este estudiante</h3>
    </div>
</template>

<script>    
    export default {
        props: ['estudiante_clase_id'],
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                clase: {id:0, nombre_materia:'', nombre_aula:'', hora_inicio:'', hora_fin:'', dia:0, semana_actual_sesion:0},
                estudiante: {nombre:'', apellido:'', correo:'', codigo_sis:''},
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
                    .get('/docente/estudiante/'+this.estudiante_clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.sesiones   = datos.sesiones;
                        this.clase      = datos.clase;
                        this.estudiante = datos.estudiante; 
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
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Portafolio';
        },
    }
</script>