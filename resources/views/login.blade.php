<link href="{{asset('/css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

@extends('inicio')

@section('main-content')
  <form method="POST" action="/login">
    @include('alertas')
    @include('errores')
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
          <img src="{{asset('img/user.png')}}" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form>
          <input type="text" id="username" name="username" class="fadeIn second" placeholder="Usuario" value="{{ old('username') }}">
          <input type="password" id="password" name="password" class="fadeIn third" placeholder="Contraseña">
          <input type="submit" class="fadeIn fourth btn-primary" value="Iniciar Sesion">
        </form>

        <!-- Crear User -->
        <div id="formFooter">
          <a href="registro">Crear Cuenta?</a>
        </div>

      </div>
    </div>
  </form>
@endsection