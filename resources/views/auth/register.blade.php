<link href="{{asset('/css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

@extends('inicio')

@section('main-content')
  <form>
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Login Form -->
        <form>
            <div>
                <label>CodigoSis</label>
                <input type="text" id="codigo_sis" name="codigo_sis" class="fadeIn second" placeholder="CodigoSis" value="{{ old('codigo_sis') }}">
            </div>
          
          <input type="text" id="nombre" name="nombre" class="fadeIn third" placeholder="Nombre(s)" value="{{ old('nombre') }}">
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