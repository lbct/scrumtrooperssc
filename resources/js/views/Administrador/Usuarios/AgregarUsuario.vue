<template>
    <div>
        <Alertas :key=key_mensajes :mensajes=mensajes :tipo=tipo_mensaje></Alertas>
        <div class="container">
            <div>
                <div class="form-row">
                    <div class="col-lg-6 col-12">
                        <label>Usuario</label>
                        <input v-model="usuario.username"
                               type="text" class="form-control" placeholder="Usuario" tabindex="1">
                    </div>

                    <div class="col-lg-3 col-12">
                        <label>Nombres</label>
                        <input v-model="usuario.nombre"
                               type="text" class="form-control" placeholder="Nombres" tabindex="2" >
                    </div>

                    <div class="col-lg-3 col-12">
                        <label>Apellidos</label>
                        <input v-model="usuario.apellido" 
                               type="text" class="form-control" placeholder="Apellidos" tabindex="3">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-6 col-12">
                        <label>Correo</label>
                        <input v-model="usuario.correo" 
                               type="email" class="form-control" placeholder="nombre@ejemplo.com" tabindex="4">
                    </div>
                    <div class="col-lg-3 col-12">
                        <label>Contraseña</label>
                        <input v-model="usuario.password" 
                               type="password" class="form-control" tabindex="5" placeholder="Contraseña">
                    </div>
                    <div class="col-lg-3 col-12">
                        <label>Confirmar Contraseña</label>
                        <input v-model="repetir_password" 
                               type="password" class="form-control" tabindex="6" placeholder="Confirmar Contraseña">
                    </div>
                </div>

                <div v-if="es_estudiante"
                     class="form-row">
                    <div class="col-lg-6 col-12">
                        <label>Codigo SIS de Estudiante</label>
                        <input v-model="usuario.codigo_sis" 
                               type="text" class="form-control input-lg" placeholder="201000000" tabindex="7">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-6 col-12">
                        <label>Roles</label>
                        <div v-if="usuario.roles.length > 0" class="row">
                            <p v-for="(rol, index) in usuario.roles"
                               class="col-lg-6 col-12">
                                {{rol.descripcion}} 
                                <i v-on:click="borrarRol(index)" 
                                   class="fas fa-trash-alt clickleable">
                                </i>&nbsp;&nbsp;
                            </p>
                        </div>
                        <p v-else>No se han añadido roles para el usuario</p>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div v-if="roles_disponibles.length > 0">
                            <label>Agregar Rol</label>
                            <select v-model="rol" 
                                    class="form-control" >
                                <option v-for="(rol, index) in roles_disponibles"
                                        :value="rol">
                                    {{rol.descripcion}}
                                </option>
                            </select> 
                            <button v-on:click="agregarRol()" 
                                    type="button" class="mt-3 btn btn-success">
                                Agregar
                            </button>
                        </div>
                        <p v-else>No hay más roles disponibles para este usuario</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="form-group row justify-content-center">
                    <button v-on:click="guardar()"
                            type="button" class="m-2 btn btn-primary">
                        Guardar
                    </button>
                    <button v-on:click="limpiar()"
                            type="button" class="m-2 btn btn-danger">
                        Limpiar
                    </button>
                </div>
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
                
                usuario: {id:'', nombre: '', apellido:'', correo:'', password:'', username:'', roles:[], codigo_sis:''},
                repetir_password: '',
                
                roles_disponibles: [],
                rol: {},
                es_estudiante: false,
            }
        },
    
        methods:{
            init(){
                this.usuario = {id:'', nombre: '', apellido:'', correo:'', password:'', username:'', roles:[]};
                
                this.axios
                    .get('/administrador/roles')
                    .then((response)=>{
                        this.roles_disponibles = response.data;
                        if(this.roles_disponibles.length)
                            this.rol = this.roles_disponibles[0];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            
            guardar(){
                this.key_mensajes++;
                this.mensajes = [];
                this.tipo_mensaje = 'danger';
                
                if(!this.usuario.password || !this.repetir_password || !this.usuario.nombre || !this.usuario.apellido || !this.usuario.correo || !this.usuario.username)
                    this.mensajes.push('Todos los campos deben ser llenados');
                
                if(this.usuario.roles.length == 0)
                    this.mensajes.push('Es necesario al menos un Rol de usuario');
                
                if(this.usuario.password != this.repetir_password)
                    this.mensajes.push('Las contraseñas no coinciden');
                
                if(this.mensajes.length == 0){
                    const params = {'usuario': this.usuario};
                    this.axios
                        .post('/administrador/usuario', params)
                        .then((respuesta)=>{
                            var datos = respuesta.data;

                            if(datos.exito){
                                this.mensajes     = datos.exito;
                                this.tipo_mensaje = 'success';
                            }
                            else if(datos.error){
                                this.mensajes     = datos.error;
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            
            limpiar(){
                this.key_mensajes = 0;
                this.mensajes = [];
                this.tipo_mensaje = '';
                
                this.init();
            },
            
            agregarRol(){
                if(this.rol.id == 5){
                    this.usuario.codigo_sis = '';
                    this.es_estudiante = true; 
                }   
                
                this.usuario.roles.push(this.rol);
                var index = this.roles_disponibles.findIndex((rol)=>{
                                    return this.rol == rol;
                            });
                this.roles_disponibles.splice(index,1);
                
                if(this.roles_disponibles.length)
                    this.rol = this.roles_disponibles[0];
            },
            
            borrarRol(index){
                var rol = this.usuario.roles[index];
                
                if(rol.id == 5)
                    this.es_estudiante = false;         
                
                this.usuario.roles.splice(index,1);
                this.roles_disponibles.push(rol);
                this.rol = this.roles_disponibles[0];
            },
        },
        
        mounted(){
            this.init();
            this.$parent.$parent.section = 'Añadir Usuario';
        },
        
        
    }
</script>