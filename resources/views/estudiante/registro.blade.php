<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@extends('inicio')

@section('main-content')
  <form method="POST" action="/registro">
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
        <div id="formContent">


            <div>
                <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <h2>Crear Cuenta</h2>
                        <div class="row">
                                <div class="form-group column2">
                                    <input type="text" name="nombre" id="nombre" class="form-control input-lg" placeholder="Nombre(s)" tabindex="1" value="{{ old('nombre') }}">
                                </div>
                                <div class="form-group column2">
                                    <input type="text" name="apellido" id="apellido" class="form-control input-lg" placeholder="Apellidos" tabindex="2" value="{{ old('apellido') }}">
                                </div>
                                
                        </div>
                        <div class="form-group">
                            <input type="text" name="codigo_sis" id="codigo_sis" class="form-control input-lg" placeholder="CodigoSis" tabindex="3"  value="{{ old('codigo_sis') }}">
                        </div>
                        <div class="form-group">
                            <input type="email" name="correo" id="email" class="form-control input-lg" placeholder="Email" tabindex="4" value="{{ old('correo') }}">
                        </div>
                        <div class="row">
                                <div class="form-group column2">
                                    <input type="password" name="contrasena" id="contrasena" class="form-control input-lg" placeholder="Contraseña" tabindex="5">
                                </div>
                                <div class="form-group column2">
                                    <input type="password" name="confirmacion_contrasena" id="confirmacion_contrasena" class="form-control input-lg" placeholder="Confirma tu Contraseña" tabindex="6">
                                </div>
                        </div>

                        <div class="row">
                                <div class="form-group column2">
                                    <input type="number" name="telefono" id="telefono" class="form-control input-lg" placeholder="Telefono" tabindex="7" value="{{ old('telefono') }}">
                                </div>
                                <div class="form-group column2">
                                    <input type="number" name="ci" id="ci" class="form-control input-lg" placeholder="C.I." tabindex="8" value="{{ old('ci') }}">
                                </div>
                        </div>

                        <div class="row">
                                <div class="form-group column2 row justify-content-end">
                                    <select id="sexo" name="sexo" class="form-control input-lg" tabindex="9" style="width:100%;max-width:90%;">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group column2 row justify-content-center">
                                
                                    <input id="datepicker" name="fecha_nacimiento" placeholder="Fecha de Nacimiento"/>
                                    <script>
                                        $('#datepicker').datepicker({
                                            showOtherMonths: true
                                        });
                                    </script>
                                
                                
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
                            <div class="column2"><input type="submit" value="Registrar" class="btn btn-primary" tabindex="7"></div>
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