<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="clase.id">
            <h4>{{clase.nombre_materia}}</h4>
            <h5>({{clase.detalle_grupo_docente}})</h5>
            <p>Aula: {{clase.nombre_aula}} - Horario: {{numeroDia(clase.dia)}} ({{clase.hora_inicio}} - {{clase.hora_fin}})</p>
            <div v-if="sesiones.length > 0">
                <center>
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona la Semana</label>
                        <select v-model="sesion" v-on:change="obtenerEstudiantes()" class="form-control" >
                            <option v-for="(sesion, index) in sesiones" 
                                    v-bind:value="sesion">
                                Semana: {{sesion.semana}}
                            </option>
                        </select>
                  </div>
                </center>
            </div>
            <p v-else>No se tiene semanas para esta clase</p>
        </div>
        <p v-else>No tienes acceso a esta clase</p>
    </div>
</template>

<script>    
    export default {
        props: ['clase_id'],
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                sesion: {id:'', semana:''},
                sesiones: [{id:1, semana:1}],
                clase: {},
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/auxiliarterminal/clase/'+this.clase_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clase = datos;
                        this.obtenerSesiones();
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
            
            obtenerSesiones(){
                if(this.sesiones.length){
                    this.sesion = this.sesiones[0];
                    this.obtenerEstudiantes();
                } 
            },
            
            obtenerEstudiantes(){
                
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Estudiantes';
        },
    }
</script>