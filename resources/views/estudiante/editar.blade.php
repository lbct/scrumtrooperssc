@extends('estudiante.plantilla')
@section('contenido_barra')
<h2 align="center">Estudiante</h2>

@endsection
@section('contenido')
<form method="POST" action="/estudiante/editar">
    {!! csrf_field() !!}
    <link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <br><br>
    <div class="container col-md-5 col-md-offset-4  ">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body col-md-12 ">
                    <div class="col-md-12 ">
                        <center>
                            <h3>Editar&nbspPerfil</h3>
                        </center>
                    </div>
                </div>
                <div>
                    <br><br>
                        <div class="form-row">
                            <div class="col-md-6 mb-10">
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nuevo Nombre" tabindex="1" value="{{ $usuario->NOMBRE }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Nuevos Apellidos" tabindex="2" value="{{ $usuario->APELLIDO }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-4">
                                <input type="email" name="correo" id="correo" class="form-control input-lg" placeholder="name@example.com" tabindex="3" value="{{ $usuario->CORREO }}">
                            </div>
                        </div>
                </div>
                <div>
                    <!-- Passwords
                      <div class=" form-row">
                          
                          <div class="col-md-6 mb-3">
                              <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña">
                          </div>
                          <div class="col-md-6 mb-5">
                              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirme la contraseña">
                          </div>
                      </div>
                    -->
                    <div>
                        <div class="form-group row justify-content-center">
                            <div class="column2"><input type="submit" href="/estudiante/editar" value="Guardar" class="btn btn-primary" tabindex="7" style="margin:10px"></div>
                            <div class="column"><input type="submit" value="Cambiar Contraseña" class="btn btn-primary" disabled="disabled" tabindex="7" style="margin:10px">
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection