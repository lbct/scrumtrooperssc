@extends('admin.plantilla')
@section('titulo', 'Editar Docente')
@section('contenido_barra')
<h2>Administrador</h2>
@endsection
@section('contenido')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <div class="container col-md-5 col-md-offset-6  ">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
        <br>
          <h2>Editar Perfil</h2>
          <br>
        </div>
       <div>
             <form method="POST" action="{{route('administrador/editarDocente', $usuario->ID)}}">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationServer01">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{$usuario->NOMBRE}}" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">Apellidos:</label>
                  <input type="text" class="form-control" id="apellido" placeholder="Apellidos" value="{{$usuario->APELLIDO}}" required>
                </div>
              </div>
                <div class="form-row">
                  <div class="col-md-7 mb-3">
                    <label for="validationServer02">Correo:</label>
                    <input type="email" class="form-control" id="correo" placeholder="name@example.com" value="{{$usuario->CORREO}}">
                  </div>
                </div>
                <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationServer01">Telefono:</label>
                  <input type="number_format" class="form-control" id="telefono" placeholder="78451256" value="{{$usuario->TELEFONO}}" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">CI:</label>
                  <input type="text" class="form-control" id="ci" placeholder="8563249" value="{{$usuario->CI}}" required>
                </div>
                </div>
              </div>
              <div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                <input id="fecha_nacimiento" width="156" value="{{$usuario->FECHA_NACIMIENTO}}" />
                  <script>
                      $('#datepicker').datepicker({
                          showOtherMonths: true
                      });
                  </script>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationServer01">Contraseña:</label>
                  <input type="number_format" class="form-control" id="contrasena" placeholder="*******" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">Confirmar&nbspContraseña:</label>
                  <input type="text" class="form-control" id="confirmar_contrasena" placeholder="******" value="" required>
                </div>
                </div>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Guardar
                </button>
          </form>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Esta seguro de cambiar sus datos? 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
       </div>
    </div>
  </div>
@endsection