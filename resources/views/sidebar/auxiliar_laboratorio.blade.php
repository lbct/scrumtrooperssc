<!--Opciones de Auxiliar Laboratorio-->
@if($usuario->tieneRol(3))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Auxiliar de Laboratorio</div>

    <li class="nav-item">
        <router-link :to="{ name: 'AuxiliarLaboratorioListaEstudiantes' }" class="nav-link">
            <i class="fas fa-fw fa-list"></i>
            <span>Lista de clases</span>
        </router-link>
    </li>
@endif