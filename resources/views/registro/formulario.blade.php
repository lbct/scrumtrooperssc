<!-- Vista de Registro de Estudiante -->
<!-- Estilos y Scripts -->
<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
@extends('inicio')
@section('main-content')
<form method="POST" action="/registro">
    {!! csrf_field() !!}
    @include('alertas')
    <div class="wrapper fadeInDown">
        <div id="formContent">
            @include('errores')
            <div>
                <div class="col-12">
                    <form role="form">
                        <h2 class="text-primary">Crear Cuenta</h2>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <input type="text" name="nombre" id="nombre" class="form-control input-lg" placeholder="Nombre(s)" tabindex="1" value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <input type="text" name="apellido" id="apellido" class="form-control input-lg" placeholder="Apellidos" tabindex="2" value="{{ old('apellido') }}">
                            </div>
                            <div class="form-group col-12">
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Usuario" tabindex="3" value="{{ old('username') }}">
                            </div>
                            <div class="form-group col-12">
                                <input type="email" name="correo" id="email" class="form-control input-lg" placeholder="Email" tabindex="4" value="{{ old('correo') }}">
                            </div>
                            <div class="form-group col-12">
                                <input type="number" name="codigo_sis" id="codigo_sis" class="form-control input-lg" placeholder="Codigo SIS" tabindex="4" value="{{ old('codigo_sis') }}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="5" value="{{ old('password') }}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirma tu Contraseña" tabindex="6" value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <img src="{{$img}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <input type="text" name="captcha" id="captcha" class="form-control input-lg" placeholder="Escribe el Texto de la Imagen"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-group col-12 col-md-6">
                                <input type="button" class="btn-primary" value="Volver" onclick="window.location='/'" tabindex="7" />
                            </div>
                            <div class="form-group form-group col-12 col-md-6">
                                <input type="submit" class="btn btn-primary" value="Registrar" tabindex="8">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection