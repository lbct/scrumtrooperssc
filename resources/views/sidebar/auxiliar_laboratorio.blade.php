<!--Opciones de Auxiliar Laboratorio-->
@if($usuario->tieneRol(3))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Auxiliar de Laboratorio</div>

    <li class="nav-item">
        <a class="nav-link" href="/auxiliar/clases">
            <i class="fas fa-fw fa-list"></i>
            <span>Lista de clases</span>
        </a>
    </li>
@endif