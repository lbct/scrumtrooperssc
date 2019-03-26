@extends('docente.plantilla')
@section('titulo', 'Editar Docente')
@section('contenido_barra')
<h2>Docente</h2>
@endsection
@section('contenido')
<form method="POST" action="/docente/editar">
{!! csrf_field() !!}
<div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">
      <div class="container col-md-5 col-md-offset-5 ">
          <div class="row">
              <div class="panel panel-default">
                  <div>
                      <br>
                      <br>
                      <form>
                      <h2>Editar perfil</h2>
                      <br>
                          <div class="form-row">
                              <div class="col-md-6 mb-10">
                                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nuevo Nombre" tabindex="1" value="{{ $usuario->NOMBRE }}">
                              </div>
                              <div class="col-md-6 mb-4">
                                  <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Nuevos Apellidos" tabindex="2" value="{{ $usuario->APELLIDO }}">
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-md-8 mb-4">
                                  <input type="email" name="correo" id="correo" class="form-control input-lg" placeholder="name@example.com" tabindex="3" value="{{ $usuario->CORREO }}">
                              </div>
                              <div class="form-group column2 row justify-content-end col-md-4 mb-4">
                                  <select name="sexo">
                                  <option value="M" @if($usuario->SEXO == 'M') selected @endif>Masculino</option>
                                    <option value="F" @if($usuario->SEXO == 'F') selected @endif>Femenino</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-md-4 mb-4">
                                  <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Telefono" value="{{ $usuario->TELEFONO }}">
                              </div>
                              <div class="col-md-4 mb-3">
                                  <input type="text" name="ci" class="form-control" id="ci" placeholder="Carnet de Identidad" value="{{ $usuario->CI }}">
                              </div>
                              <div class="col-md-4 mb-3">
                                  <input type="number" name="codigo_sis" class="form-control" id="codigo_sis" placeholder="Codigo Sis" value="{{ $usuario->CODIGO_SIS }}">
                              </div>
                          </div>
                  </div>
                  <div>
                      <div class="form-row">
                          <div>
                              <label for="validationServer01">&nbsp&nbspFecha nacimiento:</label>
                          </div>
                          <div class="col-md-6 mb-4">
                              <input id="datepicker" readonly="readonly" name="fecha_nacimiento" width="156" placeholder="DD/MM/AAAA"/ value="{{$usuario->FECHA_NACIMIENTO}}">
                              <script>
                                  $('#datepicker').datepicker({
                                      showOtherMonths: true,
                                      format: 'yyyy-mm-dd'
                                  });
                              </script>
                          </div>
                      </div>
                      <div class=" form-row">
                          <div class="col-md-6 mb-3">
                              <input type="password" name="contrasena" id="contrasena" class="form-control input-lg" placeholder="Contraseña">
                          </div>
                          <div class="col-md-6 mb-5">
                              <input type="password" name="confirmacion_contrasena" id="confirmacion_contrasena" class="form-control input-lg" placeholder="Confirme contraseña">
                          </div>
                      </div>
                      <div>
                          <div class="form-group row justify-content-center">
                              <div class="column2"><input type="submit" value="Guardar" class="btn btn-primary" tabindex="7">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </form>
  </div>
</form>
@endsection