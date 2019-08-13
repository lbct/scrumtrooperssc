import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import VueApexCharts from 'vue-apexcharts'
import CircleSpin from 'vue-loading-spinner/src/components/Circle'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueApexCharts)
Vue.use(Datetime)

import App from './views/App'
import Alertas from './components/Alertas'
import AdministradorUsuarios from './components/AdministradorUsuarios'
import TarjetaReducida from './components/TarjetaReducida'

Vue.component('Alertas', Alertas)
Vue.component('AdministradorUsuarios', AdministradorUsuarios)
Vue.component('TarjetaReducida', TarjetaReducida)
Vue.component('vueDropzone', vue2Dropzone)
Vue.component('apexchart', VueApexCharts)
Vue.component('CircleSpin', CircleSpin)

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
import DocenteInformesAsistencia from './views/Docente/InformesAsistencia'
import DocenteInformesEnvios from './views/Docente/InformesEnvios'

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
import AdministradorClasesGrupoDocente from './views/Administrador/ClasesGrupoDocente'
import AdministradorClases from './views/Administrador/Clases'
import AdministradorTodosUsuarios from './views/Administrador/Usuarios/Todos'
import AdministradorAdministradores from './views/Administrador/Usuarios/Administradores'
import AdministradorDocentes from './views/Administrador/Usuarios/Docentes'
import AdministradorAuxiliaresTerminal from './views/Administrador/Usuarios/AuxiliaresTerminal'
import AdministradorAuxiliaresLaboratorio from './views/Administrador/Usuarios/AuxiliaresLaboratorio'
import AdministradorEstudiantes from './views/Administrador/Usuarios/Estudiantes'
import AdministradorUsuario from './views/Administrador/Usuarios/Usuario'
import AdministradorAgregarUsuario from './views/Administrador/Usuarios/AgregarUsuario'

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
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/EstadoInscripcion',
            name: 'EstudianteEstadoInscripcion',
            component: EstudianteEstadoInscripcion,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/Inscripcion',
            name: 'EstudianteInscripcion',
            component: EstudianteInscripcion,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/Portafolio',
            name: 'EstudiantePortafolio',
            component: EstudiantePortafolio,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/Horario',
            name: 'EstudianteHorario',
            component: EstudianteHorario,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/GuiasPracticas',
            name: 'EstudianteVerPractica',
            component: EstudianteVerPractica,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        {
            path: '/panel/estudiante/SubirPractica',
            name: 'EstudianteSubirPractica',
            component: EstudianteSubirPractica,
            beforeEnter: requireAuth,
            meta: {permission: 5,},
        },
        //Docente
        {
            path: '/panel/docente',
            name: 'DocenteInicio',
            component: DocenteInicio,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/VerClases',
            name: 'DocenteVerClases',
            component: DocenteVerClases,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/VerAuxiliares',
            name: 'DocenteVerAuxiliares',
            component: DocenteVerAuxiliares,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/AsignarAuxiliar',
            name: 'DocenteAsignarAuxiliar',
            component: DocenteAsignarAuxiliar,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/GuiasPracticas',
            name: 'DocenteGuiasPracticas',
            component: DocenteGuiasPracticas,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/EstudiantesInscritos',
            name: 'DocenteEstudiantesInscritos',
            component: DocenteEstudiantesInscritos,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/EstudiantesInscritos/:estudiante_clase_id',
            name: 'DocentePortafolios',
            component: DocentePortafolios,
            props: true,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/InformesAsistencia',
            name: 'DocenteInformesAsistencia',
            component: DocenteInformesAsistencia,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        {
            path: '/panel/docente/InformesEnvios',
            name: 'DocenteInformesEnvios',
            component: DocenteInformesEnvios,
            beforeEnter: requireAuth,
            meta: {permission: 2,},
        },
        //Auxiliar Terminal
        {
            path: '/panel/auxiliarterminal',
            name: 'AuxiliarTerminalInicio',
            component: AuxiliarTerminalInicio,
            beforeEnter: requireAuth,
            meta: {permission: 4,},
        },
        {
            path: '/panel/auxiliarterminal/Clases',
            name: 'AuxiliarTerminalListaClases',
            component: AuxiliarTerminalListaClases,
            beforeEnter: requireAuth,
            meta: {permission: 4,},
        },
        {
            path: '/panel/auxiliarterminal/Practicas',
            name: 'AuxiliarTerminalListaPracticas',
            component: AuxiliarTerminalListaPracticas,
            beforeEnter: requireAuth,
            meta: {permission: 4,},
        },
        {
            path: '/panel/auxiliarterminal/Estudiantes',
            name: 'AuxiliarTerminalListaEstudiantes',
            component: AuxiliarTerminalListaEstudiantes,
            beforeEnter: requireAuth,
            meta: {permission: 4,},
        },
        {
            path: '/panel/auxiliarterminal/Estudiantes/:clase_id',
            name: 'AuxiliarTerminalListaEstudiantesClase',
            component: AuxiliarTerminalListaEstudiantesClase,
            props: true,
            beforeEnter: requireAuth,
            meta: {permission: 4,},
        },
        //Auxiliar Laboratorio
        {
            path: '/panel/auxiliarlaboratorio',
            name: 'AuxiliarLaboratorioListaEstudiantes',
            component: AuxiliarLaboratorioListaEstudiantes,
            beforeEnter: requireAuth,
            meta: {permission: 3,},
        },
        {
            path: '/panel/auxiliarlaboratorio/Estudiantes/:sesion_id',
            name: 'AuxiliarLaboratorioListaEstudiantesClase',
            component: AuxiliarLaboratorioListaEstudiantesClase,
            props: true,
            beforeEnter: requireAuth,
            meta: {permission: 3,},
        },
        //Administrador
        {
            path: '/panel/administrador',
            name: 'AdministradorInicio',
            component: AdministradorInicio,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Gestiones',
            name: 'AdministradorGestiones',
            component: AdministradorGestiones,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/FechasInscripcion',
            name: 'AdministradorFechasInscripcion',
            component: AdministradorFechasInscripcion,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Aulas',
            name: 'AdministradorAulas',
            component: AdministradorAulas,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Materias',
            name: 'AdministradorMaterias',
            component: AdministradorMaterias,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/GruposDocentes',
            name: 'AdministradorGruposDocentes',
            component: AdministradorGruposDocentes,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Clases',
            name: 'AdministradorClases',
            component: AdministradorClases,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Clases/:grupo_docente_id',
            name: 'AdministradorClasesGrupoDocente',
            component: AdministradorClasesGrupoDocente,
            props: true,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Todos',
            name: 'AdministradorTodosUsuarios',
            component: AdministradorTodosUsuarios,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Administradores',
            name: 'AdministradorAdministradores',
            component: AdministradorAdministradores,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Docentes',
            name: 'AdministradorDocentes',
            component: AdministradorDocentes,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/AuxiliaresTerminal',
            name: 'AdministradorAuxiliaresTerminal',
            component: AdministradorAuxiliaresTerminal,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/AuxiliaresLaboratorio',
            name: 'AdministradorAuxiliaresLaboratorio',
            component: AdministradorAuxiliaresLaboratorio,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Estudiantes',
            name: 'AdministradorEstudiantes',
            component: AdministradorEstudiantes,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/Usuario/:usuario_id',
            name: 'AdministradorUsuario',
            component: AdministradorUsuario,
            props: true,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
        },
        {
            path: '/panel/administrador/AgregarUsuario',
            name: 'AdministradorAgregarUsuario',
            component: AdministradorAgregarUsuario,
            beforeEnter: requireAuth,
            meta: {permission: 1,},
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
        .get('/usuario/tienerol/'+to.meta.permission)
        .then(function (response) {
            var acceso = response.data.acceso;
            if(acceso)
                next();
            else
                window.location.href = '/login';
        })
        .catch(function (error) {
            console.log(error);
        });
}