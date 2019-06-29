<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <table v-if="materias.length > 0">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Docente</th>
                    <th v-if="inscripcion_activa" scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(materia, index) in materias">
                    <td>{{materia.codigo_materia}}</td>
                    <td>{{materia.nombre_materia}}</td>
                    <td>{{materia.nombre_docente}} {{materia.apellido_docente}}</td>
                    <td v-if="inscripcion_activa">
                        <i class="fas fa-trash-alt clickleable" 
                           v-on:click="mostrarRetirarMateria(index)"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else>No tienes Materias Inscritas.</p>
        
        <router-link :to="{ name: 'EstudianteInscripcion' }" v-if="inscripcion_activa"
                class="m-3 btn btn-primary pull-left">
            Inscribirme
        </router-link>
        
        <div v-if="inscripcion_activa" class="modal fade" id="modal-retiro-incripcion">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Retiro de Materia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                    <p>¿Estás seguro de retirar la Materia?</p>
                    <p>Nombre Materia: {{materia.nombre_materia}}</p>
                    <p>Docente: {{materia.nombre_docente}} {{materia.apellido_docente}}</p>
                    <p>Aula: {{materia.nombre_aula}}</p>
                    <p>Horario: {{materia.hora_inicio}} - {{materia.hora_fin}}</p>
                  </div>

                  <div class="modal-footer">
                    <button v-on:click="retirarMateria(materia.index)" type="button" class="m-3 btn btn-primary pull-left">Confirmar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
                
                materias: [],
                inscripcion_activa: false,
                
                materia: {},
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
                
                this.axios
                    .get('/inscripcion/activa')
                    .then((response)=>{
                        this.inscripcion_activa = response.data.activa;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarRetirarMateria(index){
                this.materia = this.materias[index];
                this.materia.index = index;
                $('#modal-retiro-incripcion').modal('show');
            },
            
            retirarMateria(index){
                const params = {
                    'estudiante_clase_id': this.materia.id,
                };
                this.axios
                    .delete('/estudiante/materias/inscritas', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito!=null){
                            this.materias.splice(index,1);
                            $('#modal-retiro-incripcion').modal('hide');
                        }
                        else if(datos.error!=null){
                            this.inscripcion_activa = false;
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            $('#modal-retiro-incripcion').modal('hide');
                        }
                    })
            }
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Materias Inscritas';
        },
        
        
    }
</script>