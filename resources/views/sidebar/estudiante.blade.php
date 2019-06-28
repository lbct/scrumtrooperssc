<!--Opciones de Estudiante-->
@if($usuario->tieneRol(5))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Estudiante</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inscripcion" aria-expanded="true" aria-controls="inscripcion">
            <i class="fa fa-fw fa-check-square"></i>
            <span>Inscripción</span>
        </a>
        <div id="inscripcion" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link :to="{ name: 'EstudianteEstadoInscription' }"  class="collapse-item">
                    Estado Inscripción
                </router-link>
                <a class="collapse-item" href="">Incribirme</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#practicas" aria-expanded="true" aria-controls="practicas">
            <i class="fas fa-fw fa-book"></i>
            <span>Practicas</span>
        </a>
        <div id="practicas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Ver Prácticas</a>
                <a class="collapse-item" href="">Subir Prácticas</a>
                <a class="collapse-item" href="">Portafolio</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/estudiante/horario">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Ver Horario</span>
        </a>
    </li>
@endif