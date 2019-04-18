<!-- Vista de Registro de Estudiante -->
<!-- Estilos y Scripts -->
<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@extends('inicio')
@section('main-content')
<form method="POST" action="/registro">
    {!! csrf_field() !!}
    @include('alertas')
    <div class="wrapper fadeInDown">
        <div id="formContent">
            @include('errores')
            <div>
                <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <h2 class="text-primary">Crear Cuenta</h2>
                        <div class="row">
                            <div class="form-group column2">
                                <input type="text" name="nombre" id="nombre" class="form-control input-lg" placeholder="Nombre(s)" tabindex="1" value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group column2">
                                <input type="text" name="apellido" id="apellido" class="form-control input-lg" placeholder="Apellidos" tabindex="2" value="{{ old('apellido') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Usuario" tabindex="3" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <input type="email" name="correo" id="email" class="form-control input-lg" placeholder="Email" tabindex="4" value="{{ old('correo') }}">
                        </div>
                        <div class="form-group">
                            <input type="number" name="codigo_sis" id="codigo_sis" class="form-control input-lg" placeholder="CodigoSis" tabindex="4" value="{{ old('codigo_sis') }}">
                        </div>
                        <div class="row">
                            <div class="form-group column2">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="5" value="{{ old('password') }}">
                            </div>
                            <div class="form-group column2">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirma tu Contraseña" tabindex="6" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>

                        <!--div class="row">
                            <div class="col-xs-4 col-sm-3 col-md-3">
                                <span class="button-checkbox">
                                    <button type="button" class="btn" data-color="info" tabindex="7">Acepto</button>
                                    <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
                                </span>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-9">
                                    By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
                            </div>
                        </div-->

                        <div class="form-group row justify-content-center">
                            <div><input type="button" class="btn-primary" value="Volver" onclick="window.location='/'" tabindex="7" /></div>
                            <div><input type="submit" class="btn btn-primary" value="Registrar" tabindex="8"></div>
                            <!--div class="column2"><input type="submit" value="Iniciar Sesion" class="btn btn-primary" onclick="window.location.href = '/'" tabindex="8"></div-->
                            <!--div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Sign In</a></div-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection