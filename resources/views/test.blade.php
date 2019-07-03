<?php
    $usuario_id    = session('usuario_id');
    $usuario       = App\Models\Usuario::find($usuario_id);
?>

@if($usuario!=null)
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SESLAB</title>

    <!-- Fuentes e Iconos-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Estilos -->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('css/bs-stepper.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    
    <!-- Pagina -->
    <div id="app">
    <div id="wrapper">
        
            <!-- Barra de Navegacion Izquierda -->
            <ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Logo -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/login">
                    <i class="fas fa-fw fa-home"></i>
                    <div class="sidebar-brand-text mx-3">SESLAB</div>
                </a>

                @include('sidebars')

                <!-- Division -->
                <hr class="sidebar-divider d-none d-md-block">

            </ul>
            <!-- Fin de la Barra de Navegacion Izquierda -->

            <!-- Contenedor -->
            <div id="content-wrapper" class="d-flex flex-column">
                @include('navbar')
                
                <!-- Contenido Variable -->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <app></app>
                        </div>
                    </div>
                </div>
                <!-- Fin del Contenido Variable -->
            </div>
            <!-- Fin del Contenedor -->

    </div>
    </div>
    <!-- Fin de la Pagina -->
    
    <!-- Boton de Scroll -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/bs-stepper.min.js')}}"></script>
    
    <!-- VueJS JavaScript-->
    <script src="{{asset('js/app.js')}}"></script>
    
    <!-- Custom JavaScript-->
    <script>
        $('#toggler').click(function() {
            $('#accordionSidebar').toggle();
        });
    </script>
    
    <script>
        if($(window).width() <= 768){
            $('#accordionSidebar').toggle();
        }
        
        $(window).resize(function() {
            if( $(this).width() <= 768 ) {
                $('#accordionSidebar').toggle();
            }
        });
    </script>
    
</body>
</html>
@else
    <script>window.location = "/login";</script>
@endif