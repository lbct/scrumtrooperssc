import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

import App from './views/App'
import Alertas from './components/Alertas'

Vue.component('Alertas', Alertas)

//Usuarios
import UsuarioEditarDatos from './views/Usuario/EditarDatos'

//Estudiantes
import EstudianteInicio from './views/Estudiante/Inicio'
import EstudianteEstadoInscription from './views/Estudiante/EstadoInscription'

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
            name: 'EstudianteEstadoInscription',
            component: EstudianteEstadoInscription,
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