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
            
            <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
            
            <div v-if="cantidad_aulas > 0" class="table-responsive">
                <table :key="key_clases" class="table table-hover">
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
                        <tr v-for="(horario, hora) in horarios">
                            <td>{{horas[hora]}}</td>
                            <td v-for="(clase, dia) in horario">
                                <div v-for="aula in clase">
                                     <div v-on:click="verMas(aula)"
                                          v-bind:class="'clickleable custom-td '+colorGrupoDocente(aula.grupo_docente_id)">
                                          {{aula.nombre_aula}}<br>
                                          {{aula.nombre_materia}}<br>
                                          ({{aula.detalle_grupo_docente}})
                                     </div>
                                </div>
                                <button v-if="clase.length < cantidad_aulas"
                                        v-on:click="mostrarAgregar(hora, dia)"
                                        class="btn">
                                    <i class="fas fa-plus clickleable"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else>Se necesita al menos una aula creada.</p>
            
            <div class="modal fade" id="modal-agregar-clase">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Añadir Clase</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        <div v-if="aulas_disponibles.length > 0">
                            <label>Aulas disponibles</label>
                            <select v-model="aula" 
                                    class="form-control" >
                                <option v-for="(aula, index) in aulas_disponibles"
                                        :value="aula">
                                    Aula: {{aula.nombre_aula}}
                                </option>
                            </select>
                            
                            <div v-if="materias.length > 0">
                                <label>Selecciona una Materia</label>
                                <select v-model="materia" 
                                        v-on:change="cambiarMateria()" class="form-control" >
                                    <option v-for="(materia, index) in materias"
                                            :value="materia">
                                        {{materia.nombre_materia}}
                                    </option>
                                </select> 
                                <div v-if="grupos_docentes.length > 0">
                                    <label>Selecciona un Grupo Docente</label>
                                    <select v-model="grupo_docente" 
                                            class="form-control" >
                                        <option v-for="(grupo_docente, index) in grupos_docentes"
                                                :value="grupo_docente">
                                            {{grupo_docente.detalle_grupo_docente}}
                                        </option>
                                    </select> 
                                </div>
                                <p v-else><br>No se tiene ningún grupo docente disponible</p>
                            </div> 
                            <p v-else><br>No se tiene ninguna materia disponible</p>
                        </div>
                        <p v-else>No se cuenta con aulas disponibles para este horario</p>
                      </div>

                      <div class="modal-footer">
                        <button v-if="grupo_docente.id && aula.id"
                                v-on:click="agregar()" 
                                type="button" class="m-3 btn btn-primary pull-left">
                            Añadir
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="modal-editar-clase">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Clase</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                          <div>
                              <h5>Materia: {{aula.nombre_materia}}</h5>
                              <h6>Grupo Docente: {{aula.detalle_grupo_docente}}</h6>
                              <h6>Aula: {{aula.nombre_aula}}</h6>
                              <p v-if="aula.semana_actual_sesion">Semana: {{aula.semana_actual_sesion}}</p>
                              <div v-else>
                                  <p>Clase sin iniciar</p>
                                  <button v-on:click="borrar()" 
                                          type="button" class="m-2 btn btn-danger">
                                        Eliminar Clase
                                  </button>
                              </div>
                          </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                      </div>
                </div>
              </div>
            </div>
        </div>
        <p v-else>No existen gestiones disponibles</p>
    </div>
</template>

<script>    
    export default {
        data() {
            return {
                mensajes: '',
                tipo_mensaje: '',
                key_mensajes: 0,
                
                gestiones: [],
                gestion: {id:'', activa:false},
                materias: [],
                materia: {},
                grupos_docentes: [],
                grupo_docente: {},
                
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
                key_clases: 0,
                horarios: [[[]]],
                clases: [],
                aulas_disponibles: [],
                aula: {},
                horario_id: -1,
                dia: -1,
                
                cantidad_aulas: 0,
            }
        },
    
        methods:{
            initMensajes(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
            },
            
            init(){
                this.axios
                    .get('/administrador/gestiones')
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
                    .get('/administrador/aulas/cantidad')
                    .then((response)=>{
                        var datos = response.data;
                        this.cantidad_aulas = datos;                        
                        this.obtenerHorarios();                   
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerHorarios(){
                for(var i=0; i<10; i++) {
                    this.horarios[i] = [[],[],[],[],[],[]];
                }
                
                this.axios
                    .get('/administrador/clases/'+this.gestion.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.clases = datos;
                        this.clases.forEach((clase)=>{
                            var horario = clase.horario_id-1;
                            var dia     = clase.dia-1;
                            if(this.horarios[horario][dia].lenght)
                                this.horarios[horario][dia] = [clase];
                            else
                                this.horarios[horario][dia].push(clase);
                        });
                        this.key_clases++;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            mostrarAgregar(hora, dia){
                this.horario_id = hora+1;
                this.dia  = dia+1;
                this.aula = {};
                
                this.axios
                    .get('/administrador/clases/disponibles/'+
                         this.gestion.id+'/'+
                         this.horario_id+'/'+
                         this.dia)
                    .then((response)=>{
                        this.aulas_disponibles = response.data;
                        if(this.aulas_disponibles.length > 0)
                            this.aula = this.aulas_disponibles[0];
                        this.obtenerMaterias();
                        $('#modal-agregar-clase').modal('show');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerMaterias(){
                this.axios
                    .get('/administrador/materias/'+this.gestion.id)
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
                this.grupos_docentes = [];
                this.grupo_docente = {};
                
                this.axios
                    .get('/administrador/gruposdocentes/'+this.materia.id)
                    .then((response)=>{
                        this.grupos_docentes = response.data;
                        if(this.grupos_docentes.length)
                            this.grupo_docente = this.grupos_docentes[0];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            agregar(){
                const params = {
                    'horario_id': this.horario_id,
                    'dia': this.dia,
                    'aula_id': this.aula.id,
                    'grupo_docente_id': this.grupo_docente.id,
                };
                this.axios
                    .post('/administrador/clase', params)
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.obtenerHorarios();
                        $('#modal-agregar-clase').modal('hide');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            verMas(aula){
                this.aula = aula;
                $('#modal-editar-clase').modal('show');
            },
            
            borrar(){
                const params = {
                    'clase_id': this.aula.id,
                };
                this.axios
                    .delete('/administrador/clase', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                    
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.advertencia){
                            this.mensajes = datos.advertencia;
                            this.tipo_mensaje = 'warning';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    
                        this.obtenerHorarios();
                        $('#modal-editar-clase').modal('hide');
                    });
            },
            
            colorGrupoDocente(grupo_docente_id) {
                var grupo_docente = grupo_docente_id%9;
                
                if(grupo_docente == 0)
                    return 'td-gris-3';
                else if(grupo_docente == 1)
                    return 'td-verde-1';
                else if(grupo_docente == 2)
                    return 'td-gris-1';
                else if(grupo_docente == 3)
                    return 'td-azul';
                else if(grupo_docente == 4)
                    return 'td-naranja-1';
                else if(grupo_docente == 5)
                    return 'td-verde-2';
                else if(grupo_docente == 6)
                    return 'td-rojo';
                else if(grupo_docente == 7)
                    return 'td-violeta';
                else if(grupo_docente == 8)
                    return 'td-gris-2';
            },
        },           
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Clases';
        },
    }
</script>