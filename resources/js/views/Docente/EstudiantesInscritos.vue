<template>
    <div>
        <div v-if="gestiones.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label>Selecciona una Gestión</label>
                    <select v-model="gestion" 
                            v-on:change="cambiarGestion()" class="form-control" >
                        <option v-for="(gestion, index) in gestiones"
                                :value="gestion">
                            Gestion: {{gestion.anho_gestion}} - {{gestion.periodo}}
                        </option>
                    </select> 
              </div>
            </center>
            
            <div v-if="materias.length > 0">
                <center>
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona una Materia</label>
                        <select v-model="materia" class="form-control" v-on:change="cambiarMateria()">
                            <option v-for="(materia, index) in materias" 
                                    v-bind:value="materia">
                                {{materia.nombre_materia}}
                            </option>
                        </select>
                  </div>
                </center>
                
                <div v-if="carga_estudiantes">
                    <div v-if="estudiantes.length > 0">
                        <div class="text-right">
                            <h4>Total de estudiantes: {{estudiantes.length}}</h4>
                            <a :href="'/docente/portafolios/'+materia.id"
                               target="_blank" class="mb-3 btn btn-primary">
                                Descargar Portafolios
                            </a>
                        </div>
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
                                        <th scope="col">Código SIS</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Semanas Asistidas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(estudiante, index) in estudiantes_filtrados"
                                        v-on:click="irAPortafolio(estudiante)">
                                        <td class = "clickleable">{{estudiante.codigo_sis}}</td>
                                        <td class = "clickleable">{{estudiante.nombre}}</td>
                                        <td class = "clickleable">{{estudiante.apellido}}</td> 
                                        <td class = "clickleable">{{estudiante.correo}}</td>
                                        <td class = "clickleable">{{estudiante.semanas_asistidas}}/{{estudiante.semanas_totales}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p v-else>No tienes estudiantes inscritos a esta materia</p>
                </div>
                <div v-else class="m-5"><circle-spin></circle-spin></div>
            </div>
            <p v-else>No tienes materias disponibles</p>
        </div>
        <p v-else>No tienes gestiones disponibles</p>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                gestiones: [],
                gestion: {id:'', activa:false},
                materias: [],
                materia: {id: '', nombre_materia: ''},
                busqueda: '',
                estudiantes: [],
                estudiantes_filtrados: [],
                estudiante: {id:'', codigo_sis:'', nombre:'', apellido:'', correo:'', semanas_asistidas:0},
                
                carga_estudiantes: false,
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.axios
                    .get('/docente/gestiones')
                    .then((response)=>{
                        this.gestiones = response.data;
                        if(this.gestiones.length > 0){
                            const gestion = this.gestiones.find(gestion => gestion.activa == true);
                            
                            if(gestion)
                                this.gestion = gestion;
                            else
                                this.gestion = this.gestiones[0];
                                    
                            this.cambiarGestion();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarGestion(){
                 this.axios
                    .get('/docente/materias/'+this.gestion.id)
                    .then((response)=>{
                        this.materias = response.data;
                        if(this.materias.length){
                            this.materia = this.materias[0];
                            this.cambiarMateria();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            cambiarMateria(){
                this.carga_estudiantes = false;
                
                this.axios
                    .get('/docente/estudiantes/'+this.materia.id)
                    .then((response)=>{
                        this.estudiantes = response.data;
                        this.estudiantes_filtrados = response.data;
                        
                        this.carga_estudiantes = true;
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
            
            irAPortafolio(estudiante){
                this.$router.push({ name: 'DocentePortafolios', params: { estudiante_clase_id: estudiante.id } });
            }
        },              
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Estudiantes Inscritos';
        },
    }
</script>