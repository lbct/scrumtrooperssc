<!--Opciones de Estudiante-->
@if($usuario->tieneRol(5))
    <span class="nav_title">Estudiante</span>

    <li class="nav-item">
        <router-link :to="{ name: 'EstudianteInicio' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-home menu-icon"></i>
            <span class="menu-title">Inicio</span>
        </router-link>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#estudiante_inscripcion" aria-expanded="false" aria-controls="estudiante_inscripcion">
          <i class="fa fa-fw fa-check-square menu-icon"></i>
          <span class="menu-title">Inscripción</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="estudiante_inscripcion">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <router-link :to="{ name: 'EstudianteEstadoInscripcion' }" class="nav-link" data-toggle="offcanvas">
                    Estado Inscripción
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'EstudianteInscripcion' }" class="nav-link" data-toggle="offcanvas">
                    Incribirme
                </router-link>
            </li>
          </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#estudiante_practicas" aria-expanded="false" aria-controls="estudiante_practicas">
          <i class="fas fa-fw fa-book menu-icon"></i>
          <span class="menu-title">Practicas</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="estudiante_practicas">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
                <router-link :to="{ name: 'EstudianteVerPractica' }" class="nav-link" data-toggle="offcanvas">
                    Ver Guías Prácticas
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'EstudianteSubirPractica' }" class="nav-link" data-toggle="offcanvas">
                    Subir Prácticas
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'EstudiantePortafolio' }" class="nav-link" data-toggle="offcanvas">
                    Portafolio
                </router-link>
            </li>
          </ul>
        </div>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'EstudianteHorario' }" class="nav-link" data-toggle="offcanvas">
            <i class="fas fa-fw fa-calendar menu-icon"></i>
            <span class="menu-title">Ver Horario</span>
        </router-link>
    </li>
@endif