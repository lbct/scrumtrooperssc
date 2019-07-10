<!--Opciones de Docente-->
@if($usuario->tieneRol(2))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Docente</div>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteInicio' }" class="nav-link">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteVerClases' }" class="nav-link">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Clases</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteGuiasPracticas' }" class="nav-link">
            <i class="fas fa-fw fa-upload"></i>
            <span>Guías Prácticas</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteEstudiantesInscritos' }" class="nav-link">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Estudiantes</span>
        </router-link>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clases_docente" aria-expanded="true" aria-controls="clases_docente">
            <i class="fas fa-users"></i>
            <span>Auxiliares</span>
        </a>
        <div id="clases_docente" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link :to="{ name: 'DocenteVerAuxiliares' }" class="collapse-item">
                    Ver Auxiliares
                </router-link>
                <router-link :to="{ name: 'DocenteAsignarAuxiliar' }" class="collapse-item">
                    Asignar Auxiliar
                </router-link>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportes_docente" aria-expanded="true" aria-controls="reportes_docente">
            <i class="fas fa-fw fa-book"></i>
            <span>Reportes</span>
        </a>
        <div id="reportes_docente" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Informes de Asistencia</a>
                <a class="collapse-item" href="">Estadísticas de Prácticas</a>
            </div>
        </div>
    </li>
@endif