<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div id="formulario_asignar_auxiliar" class="bs-stepper">
          <div class="bs-stepper-header" role="tablist">
            <div class="step" data-target="#test-l-1">
              <button type="button" class="step-trigger" role="tab" id="steppertrigger1" aria-controls="test-l-1">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">Materia</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#test-l-2">
              <button type="button" class="step-trigger" role="tab" id="steppertrigger2" aria-controls="test-l-2">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Auxiliar</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content">
            <form>
              <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger1">
                <center v-if="grupos_docente.length > 0">
                  <div class="form-group form-group col-md-6">
                        <label for="materia">Selecciona una Materia</label>
                        <select v-model="grupo_docente_id" class="form-control">
                            <option v-for="(grupo_docente, index) in grupos_docente"
                                    :value="grupo_docente.id">
                                {{grupo_docente.nombre_materia}}
                            </option>
                        </select> 
                  </div>
                </center>
                <p v-else>No tienes materias disponibles para la gestión activa</p>
                <button v-if="grupos_docente.length > 0" 
                        v-on:click="auxiliares()" class="btn btn-primary" type="button">
                    Siguiente
                </button>
              </div>
                
              <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger2">
                <center v-if="auxiliares_terminal.length > 0">
                  <div class="form-group form-group col-md-6">
                    <label>Selecciona un Auxiliar</label>
                    <select v-model="auxiliar_terminal_id" class="form-control" required>
                        <option v-for="auxiliar_terminal in auxiliares_terminal"
                                :value="auxiliar_terminal.id">
                            {{auxiliar_terminal.nombre}} {{auxiliar_terminal.apellido}} ({{auxiliar_terminal.username}})
                        </option>
                    </select> 
                  </div>
                </center>
                <p v-else>No se tienen auxiliares disponibles</p>
                <button v-if="!asignado"
                        v-on:click="anteriorPaso()" class="btn btn-primary" type="button">
                    Anterior
                </button>
                <button v-if="auxiliares_terminal.length > 0 && !asignado"
                        v-on:click="asignar()" class="btn btn-primary" type="button">
                    Asignar
                </button>
                <button v-if="asignado"
                        v-on:click="otroAuxiliar()" class="btn btn-primary" type="button">
                    Asignar otro Auxiliar
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>
</template>

<script>    
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                grupos_docente: [],
                auxiliares_terminal: [],
                
                grupo_docente_id: '',
                auxiliar_terminal_id: '',
                formulario_asignar_auxiliar: '',
                asignado: false,
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.asignado = false;
                
                this.axios
                    .get('/docente/materias')
                    .then((response)=>{
                        var datos = response.data;
                        this.grupos_docente = datos;
                        if(this.grupos_docente.length)
                            this.grupo_docente_id =  this.grupos_docente[0].id;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            anteriorPaso(){
                this.formulario_asignar_auxiliar.previous();
            },
            
            auxiliares(){
                this.axios
                    .get('/docente/auxiliares/disponibles/'+this.grupo_docente_id)
                    .then((response)=>{
                        var datos = response.data;
                        this.auxiliares_terminal = datos;
                        if(this.auxiliares_terminal.length)
                            this.auxiliar_terminal_id = this.auxiliares_terminal[0].id;
                            
                        this.formulario_asignar_auxiliar.next(); 
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            asignar(){
                const params = {
                    'grupo_docente_id':     this.grupo_docente_id,
                    'auxiliar_terminal_id': this.auxiliar_terminal_id,
                };
                this.axios
                    .post('/docente/auxiliares', params)
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            this.asignado = true;
                        }else if(datos.error){
                            this.inscripcion_activa = false;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            otroAuxiliar(){
                this.init();
                this.formulario_asignar_auxiliar.to(1);
            }
        },            
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Asignar Auxiliar';
            
            this.formulario_asignar_auxiliar = new Stepper(document.querySelector('#formulario_asignar_auxiliar'), {
                linear: true
            });
        },
    }
</script>