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
                                <i class="fas fa-edit"></i>
                                <i v-if="sesion.borrable" class="fas fa-trash-alt"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else>No se ha subido ninguna semana</h3>
            
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
                        <vue-dropzone ref="subirGuiaPractica"
                                      id="subirGuiaPractica"
                                      :options="dropzoneOptions"
                                      v-on:vdropzone-sending="enviarDatosExtra" 
                                      v-on:vdropzone-success="subidaExitosa" 
                                      v-on:vdropzone-error="subidaError" 
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
        </div>
        <h3 v-else>No tienes materias inscritas</h3>
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
                
                dropzoneOptions: {
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
                }
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
            
            confirmarSubida(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.$refs.subirGuiaPractica.processQueue();
            },
            
            enviarDatosExtra(file, xhr, formData) {
                formData.append('grupo_docente_id', this.materia.id);
            },
            
            subidaExitosa(file, response){
                this.mensajes = response.exito;
                this.tipo_mensaje = 'success';
                this.key_mensajes++;
                this.$refs.subirGuiaPractica.removeAllFiles();
                this.obtenerSesiones();                
                $('#modal-agregar-sesion').modal('hide');
            },
            
            subidaError(file, response){
                console.log(response);
                this.mensajes = response.error;
                this.tipo_mensaje = 'danger';
                this.key_mensajes++;
                this.$refs.subirGuiaPractica.removeAllFiles();
            },
            
            borrarArchivo(index){
                var envio_practica = this.sesion.archivos[index];
                const params = {
                    'envio_practica_id': envio_practica.id,
                };
                this.axios
                    .delete('/estudiante/practica', { data: params })
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.sesion.archivos.splice(index, 1);
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                        }
                        else if(datos.error){
                            this.mensajes = datos.error;
                            this.tipo_mensaje = 'danger';
                            this.key_mensajes++;
                        }
                    });
            },
            
            verAgregarSesion(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                
                $('#modal-agregar-sesion').modal('show');
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Guias Prácticas';
        },
    }
</script>