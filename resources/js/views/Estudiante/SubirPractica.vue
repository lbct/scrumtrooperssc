<template>
    <div>
        <div v-if="materias.length > 0">
            <center>
              <div class="form-group form-group col-md-6">
                    <label>Selecciona la Materia</label>
                    <select v-model="materia" class="form-control" v-on:change="obtenerSesiones()">
                        <option v-for="(materia, index) in materias" 
                                v-bind:value="materia">
                            {{materia.nombre_materia}}
                        </option>
                    </select>
              </div>
            </center>
            
            <div v-if="sesiones.length > 0">
                <center>
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona una Semana</label>
                        <select v-model="sesion" class="form-control">
                            <option v-for="(sesion, index) in sesiones" 
                                    v-bind:value="sesion">
                                Semana: {{sesion.semana}}
                            </option>
                        </select>
                  </div>
                </center>
                <p>
                    <a :href="'/estudiante/archivos/guia_practica/'+sesion.guia_practica_id"
                       target="_blank" class="btn btn-primary">
                        Descargar Guía Práctica
                    </a>
                </p>
                <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                <h4>Archivos Subidos</h4>
                <div v-if="sesion.archivos.length">
                    <div v-for="(archivo, index) in sesion.archivos">
                        <i v-if="archivo.en_laboratorio" class="fas fa-vial"></i> 
                        <a :href="'/estudiante/archivos/practicas/' + archivo.id"
                           target="_blank">
                            {{archivo.archivo}}
                        </a> 
                        <i v-on:click="mostrarBorrar(archivo, index)" 
                           class="fas fa-trash-alt clickleable">
                        </i> 
                    </div>
                    <br>
                </div>
                <p v-else>No se ha subido ningún archivo</p>
                <vue-dropzone ref="subirPracticaEstudiante"
                              id="subirPracticaEstudiante"
                              :options="dropzoneOptions"
                              v-on:vdropzone-sending="enviarDatosExtra" 
                              v-on:vdropzone-success="subidaExitosa" 
                              v-on:vdropzone-error="subidaError" 
                              class="text-center">
                </vue-dropzone>
                <div class="form-group mt-4">
                    <button v-on:click="confirmarSubida()"
                            type="button" class="btn btn-primary pull-right">
                        Subir Archivo
                    </button>
                    <button v-on:click="limpiar()" type="submit" class="btn btn-danger">
                        Limpiar
                    </button>
                </div>
                
                <div class="modal fade" id="modal-borrar-envio-practica">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Borrar Práctica</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                          <div class="modal-body">
                            ¿Estás seguro de borrar el archivo {{archivo.archivo}}?
                          </div>

                          <div class="modal-footer">
                            <button v-on:click="confirmarBorrar()" 
                                    type="button" class="btn btn-primary">
                                Borrar
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
            <p v-else>No se ha avanzado ninguna clase</p>
        </div>
        <p v-else>No tienes materias inscritas</p>
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
                materia: {'id':'','nombre_materia':''},
                sesiones: [],
                sesion: {'sesion_estudiante_id':'', semana:'', archivos: []},
                practicas: [],
                archivo: {id:'', archivo:''},
                
                dropzoneOptions: {
                    url: '/estudiante/practica',
                    headers: { "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content },
                    parallelUploads: 1,
                    maxFiles: 1,
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    uploadMultiple: false,
                    acceptedFiles: "",
                    dictDefaultMessage: "Sube el .zip desde acá",
                    dictInvalidFileType: "No puedes subir archivos de ese tipo",
                    dictRemoveFile: "Retirar",
                    maxFilesize: 5,
                    init: function() {
                        var prevFile;
                        this.on('addedfile', function(file) {
                            if (typeof prevFile !== "undefined")
                                this.removeFile(prevFile);

                            prevFile = file;
                        });
                    }
                }
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
                            this.obtenerSesiones();
                        }                            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            obtenerSesiones(){
                this.axios
                    .get('/estudiante/sesiones/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.sesiones = datos;
                        
                        if(this.sesiones.length){
                            this.sesion = this.sesiones[0];
                        }                            
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            confirmarSubida(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.$refs.subirPracticaEstudiante.processQueue();
            },
            
            enviarDatosExtra(file, xhr, formData) {
                formData.append('sesion_estudiante_id', this.sesion.sesion_estudiante_id);
            },
            
            subidaExitosa(file, response){
                var archivo = response.archivo;
                this.sesion.archivos.push(archivo);
                
                this.mensajes = response.exito;
                this.tipo_mensaje = 'success';
                this.key_mensajes++;
                
                this.$refs.subirPracticaEstudiante.removeAllFiles();
            },
            
            subidaError(file, response){
                this.mensajes = response.error;
                this.tipo_mensaje = 'danger';
                this.key_mensajes++;
                
                this.$refs.subirPracticaEstudiante.removeAllFiles();
            },
            
            mostrarBorrar(archivo, index){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.archivo = archivo;
                this.archivo.index = index;
                $('#modal-borrar-envio-practica').modal('show');
            },
            
            confirmarBorrar(){
                const params = {
                    'envio_practica_id': this.archivo.id,
                };
                this.axios
                    .delete('/estudiante/practica', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.sesion.archivos.splice(this.archivo.index, 1);
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            
                            $('#modal-borrar-envio-practica').modal('hide');
                        }
                        else if(datos.error){
                            this.sesion.archivos.splice(this.archivo.index, 1);
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                            
                            $('#modal-borrar-envio-practica').modal('hide');
                        }
                    });
            },
            
            limpiar(){
                this.$refs.subirPracticaEstudiante.removeAllFiles();
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Subir Prácticas';
        },
    }
</script>