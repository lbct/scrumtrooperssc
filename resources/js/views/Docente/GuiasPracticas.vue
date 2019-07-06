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
            <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
            <p>
                <button v-on:click="verAgregarSesion()" class="btn btn-primary">
                    Añadir Semana
                </button>
            </p>
            <div v-if="sesiones.length > 0" class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Semana</th>
                            <th scope="col">Archivo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sesion in sesiones">
                            <td>{{sesion.semana}}</td>
                            <td>
                                <a :href="'/docente/archivos/guia_practica/' + sesion.guia_practica_id" 
                                   target="_blank" class="btn btn-primary">
                                   {{sesion.archivo}}
                                </a>
                            </td>
                            <td>
                                <i v-on:click="mostrarEditar(sesion)"
                                   class="fas fa-edit clickleable">
                                </i>
                                <i v-if="sesion.borrable" 
                                   v-on:click="mostrarBorrar(sesion)" class="fas fa-trash-alt clickleable">
                                </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-else>No se ha subido ninguna semana</p>
            
            <div class="modal fade" id="modal-agregar-sesion">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Añadir Semana</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                        <p>Añade una nueva semana con su guía práctica de laboratorio</p>
                        <vue-dropzone ref="subirGuiaPractica"
                                      id="subirGuiaPractica"
                                      :options="dropzoneOptionsAgregar"
                                      v-on:vdropzone-sending="enviarDatosExtraAgregar" 
                                      v-on:vdropzone-success="subidaExitosaAgregar" 
                                      v-on:vdropzone-error="subidaErrorAgregar" 
                                      class="text-center">
                        </vue-dropzone>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="confirmarSubida()" 
                                type="button" class="btn btn-primary">
                            Guardar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="modal-editar-sesion">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Semana {{sesion.semana}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
                        <p>Esta acción reemplazará el archivo de la semana {{sesion.semana}}</p>
                        <vue-dropzone ref="editarGuiaPractica"
                                      id="editarGuiaPractica"
                                      :options="dropzoneOptionsEditar"
                                      v-on:vdropzone-sending="enviarDatosExtraEditar" 
                                      v-on:vdropzone-success="subidaExitosaEditar" 
                                      v-on:vdropzone-error="subidaErrorEditar" 
                                      class="text-center">
                        </vue-dropzone>
                      </div>

                      <div class="modal-footer">
                        <button v-on:click="confirmarEdicion()" 
                                type="button" class="btn btn-primary">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      </div>
                </div>
              </div>
            </div>
            
            <div class="modal fade" id="modal-confirmar-borrar-sesion">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Semana {{sesion.semana}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <div class="modal-body">
                        ¿Estás seguro de borrar la semana {{sesion.semana}}?
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
                sesion: {'sesion_estudiante_id':'', semana:'', archivo: ''},
                practicas: [],
                
                dropzoneOptionsAgregar: {
                    url: '/docente/sesion',
                    headers: { "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content },
                    parallelUploads: 1,
                    maxFiles: 1,
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    uploadMultiple: false,
                    acceptedFiles: "",
                    dictDefaultMessage: "Sube el archivo acá",
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
                },
                
                dropzoneOptionsEditar: {
                    url: '/docente/sesion',
                    headers: { "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content },
                    parallelUploads: 1,
                    maxFiles: 1,
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    uploadMultiple: false,
                    acceptedFiles: "",
                    dictDefaultMessage: "Sube el archivo acá",
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
                },
            }
        },
    
        methods:{
            init(){
                this.axios
                    .get('/docente/materias')
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
                    .get('/docente/sesiones/'+this.materia.id)
                    .then((response)=>{
                        var datos = response.data;
                        this.sesiones = datos;                         
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            verAgregarSesion(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                $('#modal-agregar-sesion').modal('show');
            },
            
            confirmarSubida(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.$refs.subirGuiaPractica.processQueue();
            },
            
            enviarDatosExtraAgregar(file, xhr, formData) {
                formData.append('grupo_docente_id', this.materia.id);
            },
            
            subidaExitosaAgregar(file, response){
                this.mensajes = response.exito;
                this.tipo_mensaje = 'success';
                this.key_mensajes++;
                this.$refs.subirGuiaPractica.removeAllFiles();
                this.obtenerSesiones();                
                $('#modal-agregar-sesion').modal('hide');
            },
            
            subidaErrorAgregar(file, response){
                this.mensajes = response.error;
                this.tipo_mensaje = 'danger';
                this.key_mensajes++;
                this.$refs.subirGuiaPractica.removeAllFiles();
            },
            
            mostrarBorrar(sesion){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.sesion = sesion;
                $('#modal-confirmar-borrar-sesion').modal('show');
            },
            
            confirmarBorrar(){
                const params = {
                    'sesion_id': this.sesion.id,
                };
                this.axios
                    .delete('/docente/sesion', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            this.obtenerSesiones();
                            $('#modal-confirmar-borrar-sesion').modal('hide');
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                            this.obtenerSesiones();
                            $('#modal-confirmar-borrar-sesion').modal('hide');
                        }
                    });
            },
            
            mostrarEditar(sesion){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                this.sesion = sesion;
                var file = { size: 5500000, name: this.sesion.archivo, type: "zip" };
                var url = "";
                this.$refs.editarGuiaPractica.manuallyAddFile(file, url);
                $('#modal-editar-sesion').modal('show');
            },
            
            confirmarEdicion(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.$refs.editarGuiaPractica.processQueue();
            },
            
            enviarDatosExtraEditar(file, xhr, formData) {
                formData.append('sesion_id', this.sesion.id);
                formData.append('_method', 'PUT');
            },
            
            subidaExitosaEditar(file, response){
                this.mensajes = response.exito;
                this.tipo_mensaje = 'success';
                this.key_mensajes++;
                this.$refs.editarGuiaPractica.removeAllFiles();
                this.obtenerSesiones();                
                $('#modal-editar-sesion').modal('hide');
            },
            
            subidaErrorEditar(file, response){
                this.mensajes = response.error;
                this.tipo_mensaje = 'danger';
                this.key_mensajes++;
                this.$refs.editarGuiaPractica.removeAllFiles();
            },
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Guias Prácticas';
        },
    }
</script>