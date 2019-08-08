<link href="{{asset('/css/login.css')}}" rel="stylesheet" id="bootstrap-css">

@extends('inicio')

@section('main-content')
<form method="POST" action="/login">
  @include('alertas')
  @include('errores')
  {!! csrf_field() !!}
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <br>
      <!-- Icono Usuario -->
      <div class="fadeIn first">
        <img src="{{asset('img/user.svg')}}" id="icon" alt="User Icon" />
      </div>

      <!-- Formulario de Login -->
      <form>
        <input type="text" id="username" name="username" class="fadeIn second" placeholder="Usuario" value="{{ old('username') }}">
        <input type="password" id="password" name="password" class="fadeIn third" placeholder="Contraseña">
        <input type="submit" class="fadeIn fourth btn btn-primary" value="Iniciar">
      </form>

      <!-- Registrar Estudiante -->
      <div id="formFooter">
        <a href="registro">Crear Cuenta?</a>
      </div>

    </div>
  </div>
</form>
@endsection