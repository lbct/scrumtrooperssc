import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Schedule from 'vue-schedule'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Schedule)

import App from './views/App'
import Alertas from './components/Alertas'

Vue.component('Alertas', Alertas)

//Usuarios
import UsuarioEditarDatos from './views/Usuario/EditarDatos'

//Estudiantes
import EstudianteInicio from './views/Estudiante/Inicio'
import EstudianteEstadoInscripcion from './views/Estudiante/EstadoInscripcion'
import EstudianteInscripcion from './views/Estudiante/Inscripcion'
import EstudiantePortafolio from './views/Estudiante/Portafolio'
import EstudianteHorario from './views/Estudiante/Horario'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/panel/usuario/EditarDatos',
            name: 'UsuarioEditarDatos',
            component: UsuarioEditarDatos,
        },
        {
            path: '/panel/estudiante',
            name: 'EstudianteInicio',
            component: EstudianteInicio,
        },
        {
            path: '/panel/estudiante/EstadoInscripcion',
            name: 'EstudianteEstadoInscripcion',
            component: EstudianteEstadoInscripcion,
        },
        {
            path: '/panel/estudiante/Inscripcion',
            name: 'EstudianteInscripcion',
            component: EstudianteInscripcion,
        },
        {
            path: '/panel/estudiante/Portafolio',
            name: 'EstudiantePortafolio',
            component: EstudiantePortafolio,
        },
        {
            path: '/panel/estudiante/Horario',
            name: 'EstudianteHorario',
            component: EstudianteHorario,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    data: {
        section: '',
    },
});

function requireAuth (to, from, next) {
    axios
        .get('/user/roles')
        .then(function (response) {
            var roles = response.data;
            var role  = roles.filter(role => role.role_id === to.meta.permission);
            if( role.length > 0 )
                next();
            else
                window.location.href = '/login';
        })
        .catch(function (error) {
            console.log(error);
        });
}