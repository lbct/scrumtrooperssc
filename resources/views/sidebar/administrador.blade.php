<!--Opciones de Administrador-->
@if($usuario->tieneRol(1))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Administrador</div>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-tasks"></i>
            <span>Gestiones</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-calendar-day"></i>
            <span>Fechas de Inscripción</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-school"></i>
            <span>Aulas</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-pencil-alt"></i>
            <span>Materias</span>
        </router-link>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'AdministradorInicio' }" class="nav-link">
            <i class="fas fa-users-cog"></i>
            <span>Grupos Docentes</span>
        </router-link>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usuarios" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Usuarios</span>
        </a>
        <div id="usuarios" class="collapse" aria-labelledby="usuarios" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/administrador/crearAdmin">Crear Usuario</a>
                <a class="collapse-item" href="/administrador">Todos los Usuarios</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-table"></i>
            <span>Listas</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/administrador">Administradores</a>
                <a class="collapse-item" href="/administrador/listaDocente">Docentes</a>
                <a class="collapse-item" href="/administrador/listaDocente">Auxiliares de Terminal</a>
                <a class="collapse-item" href="/administrador/listaDocente">Auxiliares de Laboratorio</a>
            </div>
        </div>
    </li>
@endif