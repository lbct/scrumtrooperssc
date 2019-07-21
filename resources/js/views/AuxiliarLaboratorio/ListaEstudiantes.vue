<template>
    <div>        
        <div v-if="horarios.length > 0" class="table-responsive">
            <table :key="key_clases" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miercoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sabado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(clase, index) in clases">
                        <td>{{horas[index]}}</td>
                        <td v-for="horario in clase">
                            <div v-for="materia in horario"
                                 v-on:click="verSesion(materia)"
                                 v-bind:class="'clickleable custom-td '+colorGrupoDocente(materia.grupo_docente_id)">
                                {{materia.nombre_materia}}<br>
                                ({{materia.detalle_grupo_docente}})<br>
                                {{materia.nombre_aula}}<br>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-else>No se tiene ninguna clase disponible</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                materias: [],
                materia: {id:'', nombre_materia:''},
                horarios: [],
                clases: [[[]]],
                key_clases: 0,
                
                horas: [
                    "06:45/08:15",
                    "08:15/09:45",
                    "09:45/11:15",
                    "11:15/12:45",
                    "12:45/14:15",
                    "14:15/15:45",
                    "15:45/17:15",
                    "17:15/18:45",
                    "18:45/20:15",
                    "20:15/21:45",
                ],
            }
        },
    
        methods:{
            init(){
                for(var i=0; i<10; i++) {
                    this.clases[i] = [[],[],[],[],[],[]];
                }
                
                this.axios
                    .get('/auxiliarlaboratorio/clases')
                    .then((response)=>{
                        var datos = response.data;
                        this.horarios = datos;
                        datos.forEach((materia)=>{
                            var horario = materia.horario_id-1;
                            var dia     = materia.dia-1;
                            if(this.clases[horario][dia].lenght)
                                this.clases[horario][dia] = [materia];
                            else
                                this.clases[horario][dia].push(materia);
                        });
                        this.key_clases++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            verSesion(sesion){
                this.$router.push({ name: 'AuxiliarLaboratorioListaEstudiantesClase', params: { sesion_id: sesion.id } });
            },
            
            colorGrupoDocente(grupo_docente_id) {
                var grupo_docente = grupo_docente_id%8;
                
                if(grupo_docente == 1)
                    return 'table-primary';
                else if(grupo_docente == 2)
                    return 'table-secondary';
                else if(grupo_docente == 3)
                    return 'table-success';
                else if(grupo_docente == 4)
                    return 'table-danger';
                else if(grupo_docente == 5)
                    return 'table-warning';
                else if(grupo_docente == 6)
                    return 'table-info';
                else if(grupo_docente == 7)
                    return 'table-light';
                else if(grupo_docente == 8)
                    return 'table-dark';
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Lista de Clases';
        },
    }
</script>