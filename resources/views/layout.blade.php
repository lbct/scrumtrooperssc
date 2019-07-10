<?php
    $usuario_id    = session('usuario_id');
    $usuario       = App\Models\Usuario::find($usuario_id);
?>

@if($usuario)
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SESLAB</title>
  <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
  <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
  <link type="text/css" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" >
  <link rel="stylesheet" href="{{asset('css/bs-stepper.min.css')}}" >
  <link rel="stylesheet" href="{{asset('css/custom.css')}}">
</head>
<body>
<div id="app">
  <div class="container-scroller">
    @include('navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        @include('sidebars')
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <app></app>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/hoverable-collapse.js')}}"></script>
<script src="{{asset('js/template.js')}}"></script>
<script src="{{asset('js/todolist.js')}}"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/bs-stepper.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
@else
    <script>window.location = "/login";</script>
@endif