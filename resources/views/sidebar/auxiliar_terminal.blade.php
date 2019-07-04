<!--Opciones de Auxiliar Terminal-->
@if($usuario->tieneRol(4))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Auxiliar de Terminal</div>
    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalInicio' }" class="nav-link">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span>
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaClases' }" class="nav-link">
            <i class="fas fa-fw fa-list"></i>
            <span>Lista de Clases</span>
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaPracticas' }" class="nav-link">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Lista de Practicas</span>
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarTerminalListaEstudiantes' }" class="nav-link">
            <i class="fas fa-fw fa-users"></i>
            <span>Lista de Estudiantes</span>
        </router-link>
    </li>
@endif