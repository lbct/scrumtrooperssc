<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SESLAB</title>

    <!-- Custom fonts - images for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/login">
                <i class="fas fa-fw fa-home"></i>
                <div class="sidebar-brand-text mx-3">SESLAB</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fas fa-fw fa-power-off"></i>
                    <span>Cerrar sesión</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Opciones principales
            </div>

            <!--Opciones estudiante-->
            @if(App\Models\Estudiante::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
            <li class="nav-item">
                <a class="nav-link" href="/estudiante/editar">
                    <i class="fas fa-fw fa-pencil-alt"></i>
                    <span>Editar Datos</span>
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/estudiante/inscripcion">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Inscripcion</span>
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/estudiante/estadoInscripcion">
                    <i class="fa fa-fw fa-check-square"></i>
                    <span>Estado de Inscripcion</span>
                </a>
            </li>
            @endif
            <!--Opciones auxiliar-->
            @if(App\Models\Auxiliar::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
            <li class="nav-item">
                <a class="nav-link" href="/auxiliar/clases">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Lista de clases</span>
                </a>
            </li>
            @endif
            <!--Opciones docente-->
            @if(App\Models\Docente::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
            <li class="nav-item">
                <a class="nav-link" href="/docente/editar">
                    <i class="fas fa-fw fa-pencil-alt"></i>
                    <span>Editar Datos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/docente/crearAuxiliar">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Crear Auxiliar</span>
                </a>
            </li>
            @endif
            <!--Opciones Administrador-->
            @if(App\Models\Administrador::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Crear</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/administrador/crearDocente">Crear Docente</a>
                    <a class="collapse-item" href="/administrador/crearAdmin">Crear Administrador</a>
                    <a class="collapse-item" href="/administrador/crearGestion">Crear Gestión</a>
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
                    <a class="collapse-item" href="/administrador/listaDocente">Lista de Docentes</a>
                    <a class="collapse-item" href="/administrador">Lista de Administradores</a>
                    <a class="collapse-item" href="/administrador">Lista de Gestiones</a>
                    </div>
                </div>
            </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h4 class="text-light">
                        <i class="fas fa-fw fa-user"></i>
                        <span>  
                        {{
                            App\Models\Usuario::where('ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first()->NOMBRE.' '.
                            App\Models\Usuario::where('ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first()->APELLIDO
                        }}
                        </span>
                    </h4>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">

                        @include('alertas')
                        @include('errores')
                        @yield('contenido')

                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


</body>

</html> 