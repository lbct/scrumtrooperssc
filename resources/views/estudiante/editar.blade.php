<!--<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SESLAB</title>

  <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>-->

  <!-- Navigation -->

  <!-- Page Content -->
  @extends('estudiante.plantilla')
  @section('contenido_barra')
  <h2 align="center">Estudiante</h2>

  @endsection
  @section('contenido')
  <form method="POST" action="/estudiante/editar">
    {!! csrf_field() !!}
    @if (count($errors)>0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{!!$error!!}</li>
            @endforeach

    </div>
    @endif
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<br><br><br>
  <div class="container col-md-5 col-md-offset-4  ">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body col-md-12 ">
        <div class="col-md-12 ">
          <center><h2>Editar&nbspPerfil</h2></center>
          </div>
        </div>
       <div>
        <br>
        <br>  
             <form method="POST" action="/editar">
              <div class="form-row">
                <div class="col-md-6 mb-10">
                  <input type="text"  name="nombre" id="nombre" class="form-control" placeholder="Nuevo Nombre" tabindex="1" value="{{ $usuario->NOMBRE }}">
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
                                    <select id="sexo" name="sexo" class="form-control input-lg" tabindex="9" style="width:100%;max-width:90%;">
                                            <option value="M"@if($usuario->SEXO == 'M') selected @endif>Masculino</option>
                                            <option value="F"@if($usuario->SEXO == 'F') selected @endif>Femenino</option>
                                    </select>
                                </div>
                </div>
                <div class="form-row">
                <div class="col-md-5 mb-4">
                  <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Telefono" value="{{$usuario->TELEFONO}}">
                </div>
                <div class="col-md-5 mb-3">
                  <input type="text" name="ci" class="form-control" id="ci" placeholder="Carnet de Identidad" value="{{$usuario->CI}}">
                </div>
                </div>
              </div>
              <div>
              <div class="form-row">
              <div>
              <label for="validationServer01">&nbsp&nbspFecha nacimiento:</label>
              </div>
                  <div class="col-md-4 mb-4">
                  <input id="datepicker" name="fecha_nacimiento" width="156" placeholder=" dd/mm/aaaa"/ value="{{ $usuario->FECHA_NACIMIENTO }}"">
                    <script>
                        $('#datepicker').datepicker({
                            showOtherMonths: true
                        });
                    </script>
                  </div>
                </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <input type="password" name="contrasena" id="contrasena" class="form-control input-lg" placeholder="Contraseña">
             </div>
                <div class="col-md-6 mb-5">
                  <input type="password" name="confirmacion_contrasena" id="confirmacion_contrasena" class="formform-control input-lg"  placeholder="Confirme contraseña">
                </div>
                </div>
                <div>
                       <div class="form-group row justify-content-center">
                       <div class="column2"><input type="submit" href="/estudiante/editar" value ="guardar" class="btn btn-primary" tabindex="7"></div>
                </div>
          </form>
       </div>
    </div>
  </div>
@endsection
  <!-- Bootstrap core JavaScript -->
  <!--<script src="{{asset('jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>-->
