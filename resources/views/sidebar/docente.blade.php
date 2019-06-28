<!--Opciones de Docente-->
@if($usuario->tieneRol(2))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Docente</div>

    <li class="nav-item">
        <a class="nav-link" href="/docente/crearAuxiliar">
            <i class="fas fa-fw fa-plus"></i>
            <span>Asignar Auxiliar</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/docente/subirPractica">
            <i class="fas fa-fw fa-upload"></i>
            <span>Subir Prácticas</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clases_docente" aria-expanded="true" aria-controls="clases_docente">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Clases</span>
        </a>
        <div id="clases_docente" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Ver Clases</a>
                <a class="collapse-item" href="">Crear Clase</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#estudiantes" aria-expanded="true" aria-controls="estudiantes">
            <i class="fa fa-fw fa-check-square"></i>
            <span>Estudiantes</span>
        </a>
        <div id="estudiantes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Inscritos</a>
                <a class="collapse-item" href="">Portafolios</a>
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