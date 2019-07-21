<!--Opciones de Auxiliar Laboratorio-->
@if($usuario->tieneRol(3))
    <span class="nav_title">Auxiliar de Laboratorio</span>

    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarLaboratorioListaEstudiantes' }" class="nav-link">
            <i class="fas fa-fw fa-list menu-icon"></i>
            <span class="menu-title">Lista de clases</span>
        </router-link>
    </li>
@endif