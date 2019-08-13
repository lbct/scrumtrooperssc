<!--Opciones de Auxiliar Terminal-->
@if($usuario->tieneRol(4))
    <span class="nav_title">Auxiliar de Terminal</span>
    
    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalInicio' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-home menu-icon"></i>
            <span class="menu-title">Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaClases' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-list menu-icon"></i>
            <span class="menu-title">Lista de Clases</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaPracticas' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-briefcase menu-icon"></i>
            <span class="menu-title">Lista de Practicas</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaEstudiantes' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-users menu-icon"></i>
            <span class="menu-title">Lista de Estudiantes</span>
        </router-link>
    </li>
@endif