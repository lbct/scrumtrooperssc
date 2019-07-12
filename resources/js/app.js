import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(Datetime)

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
import DocenteGuiasPracticas from './views/Docente/GuiasPracticas'
import DocenteEstudiantesInscritos from './views/Docente/EstudiantesInscritos'
import DocentePortafolios from './views/Docente/Portafolios'

//Auxiliar Terminal
import AuxiliarTerminalInicio from './views/AuxiliarTerminal/Inicio'
import AuxiliarTerminalListaClases from './views/AuxiliarTerminal/ListaClases'
import AuxiliarTerminalListaPracticas from './views/AuxiliarTerminal/ListaPracticas'
import AuxiliarTerminalListaEstudiantes from './views/AuxiliarTerminal/ListaEstudiantes'
import AuxiliarTerminalListaEstudiantesClase from './views/AuxiliarTerminal/ListaEstudiantesClase'

//Auxiliar Laboratorio
import AuxiliarLaboratorioListaEstudiantes from './views/AuxiliarLaboratorio/ListaEstudiantes'
import AuxiliarLaboratorioListaEstudiantesClase from './views/AuxiliarLaboratorio/ListaEstudiantesClase'

//Administrador
import AdministradorInicio from './views/Administrador/Inicio'
import AdministradorGestiones from './views/Administrador/Gestiones'
import AdministradorFechasInscripcion from './views/Administrador/FechasInscripcion'
import AdministradorAulas from './views/Administrador/Aulas'
import AdministradorMaterias from './views/Administrador/Materias'
import AdministradorGruposDocentes from './views/Administrador/GruposDocentes'
import AdministradorClases from './views/Administrador/Clases'

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
        {
            path: '/panel/docente/GuiasPracticas',
            name: 'DocenteGuiasPracticas',
            component: DocenteGuiasPracticas,
        },
        {
            path: '/panel/docente/EstudiantesInscritos',
            name: 'DocenteEstudiantesInscritos',
            component: DocenteEstudiantesInscritos,
        },
        {
            path: '/panel/docente/EstudiantesInscritos/:estudiante_clase_id',
            name: 'DocentePortafolios',
            component: DocentePortafolios,
            props: true,
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
        //Auxiliar Laboratorio
        {
            path: '/panel/auxiliarlaboratorio',
            name: 'AuxiliarLaboratorioListaEstudiantes',
            component: AuxiliarLaboratorioListaEstudiantes,
        },
        {
            path: '/panel/auxiliarlaboratorio/Estudiantes/:sesion_id',
            name: 'AuxiliarLaboratorioListaEstudiantesClase',
            component: AuxiliarLaboratorioListaEstudiantesClase,
            props: true,
        },
        //Administrador
        {
            path: '/panel/administrador',
            name: 'AdministradorInicio',
            component: AdministradorInicio,
        },
        {
            path: '/panel/administrador/Gestiones',
            name: 'AdministradorGestiones',
            component: AdministradorGestiones,
        },
        {
            path: '/panel/administrador/FechasInscripcion',
            name: 'AdministradorFechasInscripcion',
            component: AdministradorFechasInscripcion,
        },
        {
            path: '/panel/administrador/Aulas',
            name: 'AdministradorAulas',
            component: AdministradorAulas,
        },
        {
            path: '/panel/administrador/Materias',
            name: 'AdministradorMaterias',
            component: AdministradorMaterias,
        },
        {
            path: '/panel/administrador/GruposDocentes',
            name: 'AdministradorGruposDocentes',
            component: AdministradorGruposDocentes,
        },
        {
            path: '/panel/administrador/Clases/:grupo_docente_id',
            name: 'AdministradorClases',
            component: AdministradorClases,
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