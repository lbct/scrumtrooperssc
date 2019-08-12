<!-- Vista de Recupera Cuenta -->
<!-- Estilos y Scripts -->
<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
@extends('inicio')
@section('main-content')
<form method="POST" action="/recuperarCuenta">
    {!! csrf_field() !!}
    @include('alertas')
    <div class="wrapper fadeInDown">
        <div id="formContent">
            @include('errores')
            <div>
                <div class="col-12">
                    <form role="form">
                        <h2 class="text-primary">Recuperar Cuenta</h2>
                        <div class="row">
                            <Span class="form-group col-12">En caso de que no te acuerdes tu nombre de usuario o contraseña, 
                                ingresa el correo que estaba asociado a tu cuenta y te enviaremos tus datos.<br>
                                <br>
                                <b>Advertencia!</b>
                                Esta opción cambiara tu contraseña actual.
                            </Span>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="email" name="correo" id="email" class="form-control input-lg" placeholder="Email" tabindex="4" value="{{ old('correo') }}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <img src="{{$img}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <input type="text" name="captcha" id="captcha" class="form-control input-lg" placeholder="Escribe el Texto de la Imagen"/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group form-group col-12 col-md-6">
                                <input type="button" class="btn-primary" value="Volver" onclick="window.location='/'" tabindex="7" />
                            </div>
                            <div class="form-group form-group col-12 col-md-6">
                                <input type="submit" class="btn btn-primary" value="Enviar Contraseña" tabindex="8">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection