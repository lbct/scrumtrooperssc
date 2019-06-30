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
                <router-link :to="{ name: 'EstudianteEstadoInscripcion' }" class="collapse-item">
                    Estado Inscripción
                </router-link>
                <router-link :to="{ name: 'EstudianteInscripcion' }" class="collapse-item">
                    Incribirme
                </router-link>
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
                <router-link :to="{ name: 'EstudiantePortafolio' }" class="collapse-item">
                    Portafolio
                </router-link>    
            </div>
        </div>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'EstudianteHorario' }" class="nav-link">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Ver Horario</span>
        </router-link>
    </li>
@endif