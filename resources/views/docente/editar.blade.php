<!-- Vista de Editar Perfil Docente -->
@extends('layout')
@section('contenido')
<form method="POST" action="/docente/editar">
{!! csrf_field() !!}
<div>
      <div class="container col-md-5 col-md-offset-5 ">
          <div class="row">
              <div class="panel panel-default">
                  <div>
                      <br><br>
                      <h3>Editar perfil</h3>
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
                              <div class="col-md-12 mb-4">
                                  <input type="email" name="correo" id="correo" class="form-control input-lg" placeholder="name@example.com" tabindex="3" value="{{ $usuario->CORREO }}">
                              </div>
                          </div>
                  </div>
                  <div>
                      <div>
                          <div class="form-group row justify-content-center">
                              <div class="column2"><input type="submit" value="Guardar" class="btn btn-primary" tabindex="7" style="margin:10px">
                              </div>
                              <div class="column"><input type="submit" value="Cambiar Contraseña" class="btn btn-primary" disabled="disabled" tabindex="7" style="margin:10px">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>
@endsection