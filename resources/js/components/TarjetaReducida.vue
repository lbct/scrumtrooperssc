<template>
    <router-link :to="{ name: ruta }"
                 class="col-md-3 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-md-center text-xl-left">{{titulo}}</p>
          <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
            <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0 color text-dark">{{valor}}</h3>
            <i :class="icono_a_clase()+' icon-md text-muted mb-0 mb-md-3 mb-xl-0'"></i>
          </div>
        </div>
      </div>
    </router-link>
</template>

<script>
    export default {
        props: ['titulo', 'valor', 'icono', 'ruta'],
        data() {
            return {
                clase_icono: '',
            }
        },
        
        methods:{
            icono_a_clase(){
                if(this.icono == "grupo")
                    return "fas fa-users-cog";
                else if(this.icono == "archivo")
                    return "fas fa-file-alt";
                else if(this.icono == "usuarios")
                    return  "fas fa-users";
                else if(this.icono == "subir")
                    return "fas fa-upload";
                else if(this.icono == "materia")
                    return "fas fa-pencil-alt";
                else if(this.icono == "horario")
                    return "fas fa-clock";
                else if(this.icono == "cursado")
                    return "fas fa-history";
                else if(this.icono == "aula")
                    return "fa fa-university";
                else if(this.icono == "fecha")
                    return "fa fa-calendar";
                else if(this.icono == "laboratorio")
                    return "fas fa-vial";
                else if(this.icono == "afuera")
                    return "fas fa-share";
            },
        },
    }
</script>