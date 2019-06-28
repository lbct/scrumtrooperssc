<!-- Navegación superior -->
<nav class="navbar navbar-expand bg-primary topbar mb-4 static-top">
  <a id="toggler" type="button" class="boton_menu">
    <i class="fas fa-bars text-white"></i>
  </a>
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <!-- Nav Item - Información de Usuario -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-user text-white"></i>
        <span class="text-white small">&nbsp{{$usuario->nombre}} {{$usuario->apellido}}</span>
      </a>

      <!-- Dropdown - Información de Usuario -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <router-link :to="{ name: 'UsuarioEditarDatos' }"  class="dropdown-item">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Editar Perfil
        </router-link>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/logout">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Cerrar Sesión
        </a>
      </div>
    </li>
  </ul>
</nav>