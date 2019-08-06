<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SESLAB</title>
    
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.modal.min.css')}}" rel="stylesheet">
    
</head>
<body>
    <div id="ytmodal" class="modal" style="width:100%; height:100%; padding:0; max-width:none;">
        <iframe src="https://www.youtube.com/embed/zrTjkYicw-0?autoplay=1" style="width:100%; height:100%;">
        </iframe>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
        <div class="container">
            <a class="navbar-brand" href="/">SESLAB</a>
            <a href="#ytmodal" rel="modal:open" style="color: #fff; font-style: italic;">Video Tutorial</a>
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
    <script src="{{asset('vendor/jquery/jquery.modal.min.js')}}"></script>
</body>
</html>