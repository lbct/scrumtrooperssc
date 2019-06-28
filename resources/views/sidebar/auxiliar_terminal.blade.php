<!--Opciones de Auxiliar Terminal-->
@if($usuario->tieneRol(4))
    <!-- Division -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Auxiliar de Terminal</div>

    <li class="nav-item">
        <a class="nav-link" href="/auxiliar/clases">
            <i class="fas fa-fw fa-list"></i>
            <span>Lista de clases</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/auxiliar/practicas">
            <i class="fas fa-fw fa-list"></i>
            <span>Lista de Practicas</span>
        </a>
    </li>
@endif