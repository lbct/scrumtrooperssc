<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('titulo')</title>

    <!-- Custom fonts - images for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-secondary sidebar sidebar-dark " id="Sidebar">

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
                    <i class="fas fa-fw fa-user"></i>
                    <span>Cerrar sesión</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Opciones principales
            </div>

            @yield('opciones')

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
                    @yield('contenido_barra')
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