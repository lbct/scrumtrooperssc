<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div v-if="inscripcion_activa" id="formulario_inscripcion" class="bs-stepper">
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
                <span class="bs-stepper-label">Docente</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#test-l-3">
              <button type="button" class="step-trigger" role="tab" id="steppertrigger3" aria-controls="test-l-3">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Horario</span>
              </button>
            </div>
            <div class="bs-stepper-line"></div>
            <div class="step" data-target="#test-l-4">
              <button type="button" class="step-trigger" role="tab" id="steppertrigger4" aria-controls="test-l-4">
                <span class="bs-stepper-circle">4</span>
                <span class="bs-stepper-label">Verificacion</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content">
            <form>
              <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger1">
                <center v-if="materias.length > 0">
                  <div class="form-group form-group col-md-6">
                        <label>Selecciona la Materia</label>
                        <select v-model="materia" class="form-control" required>
                            <option v-for="materia in materias" :value="materia">
                                {{materia.nombre_materia}}
                            </option>
                        </select>
                  </div>
                </center>
                <p v-else>No tienes materias disponibles</p>
                <button v-if="materias.length > 0" 
                        v-on:click="verDocentes()" class="btn btn-primary" type="button">
                    Siguiente
                </button>
              </div>
                
              <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger2">
                <center v-if="docentes.length > 0">
                  <div class="form-group form-group col-md-6">
                    <label>Selecciona tu Docente</label>
                    <select v-model="docente" class="form-control" required>
                        <option v-for="docente in docentes" :value="docente">
                            {{docente.nombre_docente}} {{docente.apellido_docente}}
                        </option>
                    </select>
                  </div>
                </center>
                <p v-else>No se tienen docentes disponibles</p>
                <button v-on:click="anteriorPaso()" class="btn btn-primary" type="button">Anterior</button>
                <button v-if="docentes.length > 0"
                        v-on:click="verClases()" class="btn btn-primary" type="button">
                    Siguiente
                </button>
              </div>
                
              <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="steppertrigger3">
                <center v-if="clases.length > 0">
                  <div class="form-group form-group col-md-6">
                    <label>Selecciona un Horario</label>
                    <select v-model="clase" class="form-control" required>
                        <option v-for="clase in clases" :value="clase">
                            {{clase.descripcion}}
                        </option>
                    </select>
                  </div>
                </center>
                <p v-else>No se tienen clases disponibles</p>
                <button v-on:click="anteriorPaso()" class="btn btn-primary" onclick="" type="button">Anterior</button>
                <button v-if="clases.length > 0"
                        v-on:click="comprobar()" class="btn btn-primary" onclick="" type="button">
                    Siguiente
                </button>
              </div>
                
              <div id="test-l-4" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="steppertrigger4">
                <center>
                  <div class="form-group form-group col-md-6">
                    <label for="verficar_materia">Materia</label>
                    <input v-bind:value="materia.nombre_materia" type="text" class="form-control" disabled>
                    <label for="verficar_docente">Docente</label>
                    <input v-bind:value="docente.nombre_docente+' '+docente.apellido_docente" type="text" class="form-control" disabled>
                    <label for="verficar_horario">Horario</label>
                    <input v-bind:value="clase.descripcion" type="text" class="form-control" disabled>
                  </div>
                </center>
                <button v-if="!inscrito"
                        v-on:click="anteriorPaso()" class="btn btn-primary" type="button">
                    Anterior
                </button>
                <button v-if="!inscrito" 
                        v-on:click="inscribirse()" class="btn btn-primary" type="button">
                    Inscribirse
                </button>
                <button v-if="inscrito" 
                        v-on:click="otraMateria()" class="btn btn-primary" type="button">
                    Añadir otra materia
                </button>
              </div>
            </form>
          </div>
        </div>
        <p v-else>La fecha para inscripciones de materias ha finalizado</p>
    </div>
</template>

<script>
    export default {        
        data() {
            return {
                mensajes: [],
                tipo_mensaje: '',
                key_mensajes: 0,
                
                materias: [], docentes: [], clases:   [],
                materia: {id:'', nombre_materia:''}, 
                docente: {id:'', nombre_docente:'', apellido_docente:''}, 
                clase: {id:'', descripcion:''},
                
                formulario_inscripcion: '',
                inscripcion_activa: true,
                inscrito: false,
            }
        },
    
        methods:{
            init(){
                this.mensajes = [];
                this.tipo_mensaje = '';
                this.key_mensajes = 0;
                this.inscrito = false;
                
                this.axios
                    .get('/inscripcion/activa')
                    .then((response)=>{
                        this.inscripcion_activa = response.data.activa;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
                this.axios
                    .get('/estudiante/materias/disponibles')
                    .then((response)=>{
                        var datos = response.data;
                        if(datos.exito){
                            this.materias = datos.exito;
                            if(this.materias.length)
                                this.materia = this.materias[0];
                        }
                        else{
                            this.inscripcion_activa = false;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            anteriorPaso(){
                this.formulario_inscripcion.previous();
            },
            
            verDocentes(){
                if(this.materia){
                    this.mensajes = [];
                    this.tipo_mensaje = '';
                    this.key_mensajes++;
                    
                    this.axios
                        .get('/estudiante/materia/'+this.materia.id+'/docentes')
                        .then((response)=>{
                            var datos = response.data;
                            if(datos.exito){
                                this.docentes = datos.exito;
                                if(this.docentes.length)
                                    this.docente  = this.docentes[0];
                                this.formulario_inscripcion.next();
                            }                     
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                else{
                    this.mensajes = ['Por favor elige una materia'];
                    this.tipo_mensaje = 'danger';
                    this.key_mensajes++;
                }
            },
            
            verClases(){
                if(this.docente){
                    this.mensajes = [];
                    this.tipo_mensaje = '';
                    this.key_mensajes++;
                    
                    this.axios
                        .get('/estudiante/materia/'+this.docente.id+'/clases')
                        .then((response)=>{
                            var datos = response.data;
                            if(datos.exito){
                                this.clases = datos.exito;
                                if(this.clases.length)
                                    this.clase  = this.clases[0];
                                this.formulario_inscripcion.next();
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
                else{
                    this.mensajes = ['Por favor elige un docente'];
                    this.tipo_mensaje = 'danger';
                    this.key_mensajes++;
                }
            },
            
            comprobar(){
                if(this.clase){
                    this.formulario_inscripcion.next();
                }
                else{
                    this.mensajes = ['Por favor elige un horario'];
                    this.tipo_mensaje = 'danger';
                    this.key_mensajes++;
                }
            },
            
            inscribirse(){
                const params = {
                    'grupo_a_docente_id': this.docente.id,
                    'clase_id':           this.clase.id,
                };
                this.axios
                    .post('/estudiante/materia', params)
                    .then((response)=>{
                        var datos = response.data;
                        
                        if(datos.exito){
                            this.mensajes = datos.exito;
                            this.tipo_mensaje = 'success';
                            this.key_mensajes++;
                            this.inscrito = true;
                        }else if(datos.error){
                            this.inscripcion_activa = false;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            otraMateria(){
                this.init();
                this.formulario_inscripcion.to(1);
            }
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Formulario de Inscripción';
            
            this.formulario_inscripcion = new Stepper(document.querySelector('#formulario_inscripcion'), {
                linear: true
            });
        },
        
        
    }
</script>