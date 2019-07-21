<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SESLAB</title>
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
            <a class="navbar-brand" href="/">SESLAB</a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @yield('main-content')
            </div>
        </div>
    </div>
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>