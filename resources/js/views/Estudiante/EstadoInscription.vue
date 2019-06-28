<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <table v-if="materias.length > 0">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Docente</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="materia in materias">
                    <td>{{materia.codigo_materia}}</td>
                    <td>{{materia.nombre_materia}}</td>
                    <td>{{materia.nombre_docente}} {{materia.apellido_docente}}</td>
                    <td><i class="fas fa-edit"></i> <i class="fas fa-trash-alt"></i></td>
                </tr>
            </tbody>
        </table>
        <p v-else>No tienes Materias Inscritas.</p>
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
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/estudiante/materias/inscritas')
                    .then((response)=>{
                        this.materias = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Materias Inscritas';
        },
        
        
    }
</script>