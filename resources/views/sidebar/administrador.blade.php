<!--Opciones de Administrador-->
@if($usuario->tieneRol(1))
    <span class="nav_title">Administrador</span>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-fw fa-home menu-icon"></i>
            <span class="menu-title">Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorGestiones' }" class="nav-link">
            <i class="fas fa-tasks menu-icon"></i>
            <span class="menu-title">Gestiones</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorFechasInscripcion' }" class="nav-link">
            <i class="fas fa-calendar-day menu-icon"></i>
            <span class="menu-title">Fechas de Inscripción</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorAulas' }" class="nav-link">
            <i class="fas fa-school menu-icon"></i>
            <span class="menu-title">Aulas</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorMaterias' }" class="nav-link">
            <i class="fas fa-pencil-alt menu-icon"></i>
            <span class="menu-title">Materias</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorGruposDocentes' }" class="nav-link">
            <i class="fas fa-users-cog menu-icon"></i>
            <span class="menu-title">Grupos Docentes</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorClases' }" class="nav-link">
            <i class="fas fa-graduation-cap menu-icon"></i>
            <span class="menu-title">Clases</span>
        </router-link>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#administrador_usuarios" aria-expanded="false" aria-controls="administrador_usuarios">
          <i class="fas fa-users menu-icon"></i>
          <span class="menu-title">Usuarios</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="administrador_usuarios">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <router-link :to="{ name: 'AdministradorAdministradores' }" class="nav-link">
                    Administradores
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'AdministradorDocentes' }" class="nav-link">
                    Docentes
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'AdministradorAuxiliaresTerminal' }" class="nav-link">
                    Auxiliares de Terminal
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'AdministradorAuxiliaresLaboratorio' }" class="nav-link">
                    Auxiliares de Laboratorio
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'AdministradorEstudiantes' }" class="nav-link">
                    Estudiantes
                </router-link>
            </li>
          </ul>
        </div>
    </li>
@endif