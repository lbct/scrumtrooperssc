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
             <form>
              <div class="form-row">
                <div class="col-md-6 mb-10">
                  <input type="text" class="form-control" id="validationServer01" placeholder="Nombre" value="" required>
                </div>
                <div class="col-md-6 mb-4">
                  <input type="text" class="form-control" id="validationServer02" placeholder="Apellidos" value="" required>
                </div>
              </div>
                <div class="form-row">
                  <div class="col-md-8 mb-4">
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                  </div>
                  <div class="dropdown col-md-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sexo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="sexo">
                      <a class="dropdown-item" href="#">Femenino</a>
                      <a class="dropdown-item" href="#">Masculino</a>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                <div class="col-md-5 mb-4">
                  <input type="number_format" class="form-control" id="validationServer01" placeholder="Telefono" value="" required>
                </div>
                <div class="col-md-5 mb-3">
                  <input type="text" class="form-control" id="validationServer02" placeholder="Carnet de Identidad" value="" required>
                </div>
                </div>
              </div>
              <div>
              <div class="form-row">
              <div>
              <label for="validationServer01">&nbsp&nbspFecha nacimiento:</label>
              </div>
                  <div class="col-md-4 mb-4">
                  <input id="datepicker" width="156" placeholder=" dd/mm/aaaa"/>
                    <script>
                        $('#datepicker').datepicker({
                            showOtherMonths: true
                        });
                    </script>
                  </div>
                </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <input type="number_format" class="form-control" id="validationServer01" placeholder="Contraseña" value="" required>
                </div>
                <div class="col-md-6 mb-5">
                  <input type="text" class="form-control" id="validationServer02" placeholder="Confirme contraseña" value="" required>
                </div>
                </div>
                <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Guardar
                </button>
                </div>
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
                  <button type="button" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
       </div>
    </div>
  </div>
@endsection
  <!-- Bootstrap core JavaScript -->
  <!--<script src="{{asset('jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>-->
