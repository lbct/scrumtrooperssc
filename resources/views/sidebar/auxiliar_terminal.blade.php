<!--Opciones de Auxiliar Terminal-->
@if($usuario->tieneRol(4))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Auxiliar de Terminal</div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#listas_auxiliar_terminal" aria-expanded="true" aria-controls="listas_auxiliar_terminal">
            <i class="fas fa-fw fa-list"></i>
            <span>Listas</span>
        </a>
        <div id="listas_auxiliar_terminal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <router-link :to="{ name: 'AuxiliarTerminalListaClases' }" class="collapse-item">
                    Lista de Clases
                </router-link>
                <router-link :to="{ name: 'AuxiliarTerminalListaPracticas' }" class="collapse-item">
                    Lista de Practicas
                </router-link>
                <router-link :to="{ name: 'AuxiliarTerminalListaEstudiantes' }" class="collapse-item">
                    Lista de Estudiantes
                </router-link>
            </div>
        </div>
    </li>
@endif