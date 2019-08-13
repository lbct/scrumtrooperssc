<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="/">SESLAB</a>
    <a class="navbar-brand brand-logo-mini" href="/">SL</a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button id="toggler_menu_lg" class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <i class="fas fa-fw fa-user text-white"></i> {{$usuario->nombre}} {{$usuario->apellido}}
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <router-link :to="{ name: 'UsuarioEditarDatos' }" class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            Editar Perfil
          </router-link>
          <a class="dropdown-item" href="/logout">
            <i class="ti-power-off text-primary"></i>
            Cerrar Sesión
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      &nbsp;&nbsp;&nbsp;<i class="fas fa-bars"></i>&nbsp;&nbsp;
    </button>
  </div>
</nav>