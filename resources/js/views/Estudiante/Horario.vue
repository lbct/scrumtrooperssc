<template>
    <div>
        <table :key="key_horario" class="table">
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
                <tr v-for="(horario, index) in horarios">
                    <td>{{horas[index]}}</td>
                    <td v-for="materia in horarios[index]">
                        <div v-if="materia">
                            {{materia.nombre_materia}}
                            {{materia.nombre_aula}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
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
                horarios: [[]],
                key_horario: 0,
            }
        },
    
        methods:{
            init(){
                var $this = this;
                for(var i=0; i<10; i++) {
                    this.horarios[i] = new Array(6);
                }
                
                this.axios
                    .get('/estudiante/materias/inscritas')
                    .then((response)=>{
                        var datos = response.data;
                        datos.forEach(function(materia) {
                            $this.horarios[materia.horario_id-1][materia.dia-1] = materia;
                        });
                        this.key_horario++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Horario';
        },
    }
</script>