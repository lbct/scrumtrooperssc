<link href="{{asset('/css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

@extends('inicio')

@section('main-content')
  <form method="POST" action="/login">
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
          <input type="text" id="codigo_sis" name="codigo_sis" class="fadeIn second" placeholder="CodigoSis" value="{{ old('codigo_sis') }}">
          <input type="password" id="contrasena" name="contrasena" class="fadeIn third" placeholder="Contraseña">
          <input type="submit" class="fadeIn fourth" value="Iniciar Sesion">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a href="registro">Crear Cuenta?</a>
        </div>

      </div>
    </div>
  </form>
@endsection