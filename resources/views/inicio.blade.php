
<!-- Vista de la Pagina Inicial -->
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SESLAB</title>

    <!-- Bootstrap CSS -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body>

    <!-- Barra de Navegacion Horizontal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
            <a class="navbar-brand" href="/">SESLAB</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            </div>
        </div>
    </nav>

    <!-- Contenido de la Pagina -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @yield('main-content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html> 