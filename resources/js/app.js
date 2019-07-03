import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

import App from './views/App'
import Alertas from './components/Alertas'

Vue.component('Alertas', Alertas)
Vue.component('vueDropzone', vue2Dropzone)

//Usuarios
import UsuarioEditarDatos from './views/Usuario/EditarDatos'

//Estudiantes
import EstudianteInicio from './views/Estudiante/Inicio'
import EstudianteEstadoInscripcion from './views/Estudiante/EstadoInscripcion'
import EstudianteInscripcion from './views/Estudiante/Inscripcion'
import EstudiantePortafolio from './views/Estudiante/Portafolio'
import EstudianteHorario from './views/Estudiante/Horario'
import EstudianteVerPractica from './views/Estudiante/VerPractica'
import EstudianteSubirPractica from './views/Estudiante/SubirPractica'

//Docente
import DocenteInicio from './views/Docente/Inicio'
import DocenteVerClases from './views/Docente/VerClases'
import DocenteVerAuxiliares from './views/Docente/VerAuxiliares'
import DocenteAsignarAuxiliar from './views/Docente/AsignarAuxiliar'

//Auxiliar Terminal
import AuxiliarTerminalInicio from './views/AuxiliarTerminal/Inicio'
import AuxiliarTerminalListaClases from './views/AuxiliarTerminal/ListaClases'
import AuxiliarTerminalListaPracticas from './views/AuxiliarTerminal/ListaPracticas'
import AuxiliarTerminalListaEstudiantes from './views/AuxiliarTerminal/ListaEstudiantes'
import AuxiliarTerminalListaEstudiantesClase from './views/AuxiliarTerminal/ListaEstudiantesClase'

const router = new VueRouter({
    mode: 'history',
    routes: [
        //Cualquier Usuario
        {
            path: '/panel/usuario/EditarDatos',
            name: 'UsuarioEditarDatos',
            component: UsuarioEditarDatos,
        },
        //Estudiante
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
        {
            path: '/panel/estudiante/GuiasPracticas',
            name: 'EstudianteVerPractica',
            component: EstudianteVerPractica,
        },
        {
            path: '/panel/estudiante/SubirPractica',
            name: 'EstudianteSubirPractica',
            component: EstudianteSubirPractica,
        },
        //Docente
        {
            path: '/panel/docente',
            name: 'DocenteInicio',
            component: DocenteInicio,
        },
        {
            path: '/panel/docente/VerClases',
            name: 'DocenteVerClases',
            component: DocenteVerClases,
        },
        {
            path: '/panel/docente/VerAuxiliares',
            name: 'DocenteVerAuxiliares',
            component: DocenteVerAuxiliares,
        },
        {
            path: '/panel/docente/AsignarAuxiliar',
            name: 'DocenteAsignarAuxiliar',
            component: DocenteAsignarAuxiliar,
        },
        //Auxiliar Terminal
        {
            path: '/panel/auxiliarterminal',
            name: 'AuxiliarTerminalInicio',
            component: AuxiliarTerminalInicio,
        },
        {
            path: '/panel/auxiliarterminal/Clases',
            name: 'AuxiliarTerminalListaClases',
            component: AuxiliarTerminalListaClases,
        },
        {
            path: '/panel/auxiliarterminal/Practicas',
            name: 'AuxiliarTerminalListaPracticas',
            component: AuxiliarTerminalListaPracticas,
        },
        {
            path: '/panel/auxiliarterminal/Estudiantes',
            name: 'AuxiliarTerminalListaEstudiantes',
            component: AuxiliarTerminalListaEstudiantes,
        },
        {
            path: '/panel/auxiliarterminal/Estudiantes/:clase_id',
            name: 'AuxiliarTerminalListaEstudiantesClase',
            component: AuxiliarTerminalListaEstudiantesClase,
            props: true,
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