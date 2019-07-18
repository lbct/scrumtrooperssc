<!--Opciones de Docente-->
@if($usuario->tieneRol(2))
    <span class="nav_title">Docente</span>
    <li class="nav-item">
        <router-link :to="{ name: 'DocenteInicio' }" class="nav-link">
            <i class="fas fa-fw fa-home menu-icon"></i>
            <span class="menu-title">Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteVerClases' }" class="nav-link">
            <i class="fas fa-fw fa-briefcase menu-icon"></i>
            <span class="menu-title">Clases</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteGuiasPracticas' }" class="nav-link">
            <i class="fas fa-fw fa-upload menu-icon"></i>
            <span class="menu-title">Guías Prácticas</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'DocenteEstudiantesInscritos' }" class="nav-link">
            <i class="fas fa-fw fa-pen-square menu-icon"></i>
            <span class="menu-title">Estudiantes</span>
        </router-link>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#docente_auxiliares" aria-expanded="false" aria-controls="docente_auxiliares">
          <i class="fas fa-users menu-icon"></i>
          <span class="menu-title">Auxiliares</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="docente_auxiliares">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <router-link :to="{ name: 'DocenteVerAuxiliares' }" class="nav-link">
                    Ver Auxiliares
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'DocenteAsignarAuxiliar' }" class="nav-link">
                    Asignar Auxiliar
                </router-link>
            </li>
          </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#docente_reportes" aria-expanded="false" aria-controls="docente_reportes">
          <i class="fas fa-fw fa-book menu-icon"></i>
          <span class="menu-title">Reportes</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="docente_reportes">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <router-link :to="{ name: 'DocenteInformesAsistencia' }" class="nav-link">
                    Informes de Asistencia
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'DocenteAsignarAuxiliar' }" class="nav-link">
                    Estadísticas de Prácticas
                </router-link>
            </li>
          </ul>
        </div>
    </li>
@endif