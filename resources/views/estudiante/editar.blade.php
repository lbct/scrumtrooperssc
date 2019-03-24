<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SESLAB</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container-fluid">
      <a class="navbar-brand" h ref="#">SESLAB</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container col-md-5 col-md-offset-6  ">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
        <br>
          <h2>Editar Perfil</h2>
          <br>
        </div>
       <div>
             <form>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationServer01">Nombre:</label>
                  <input type="text" class="form-control" id="validationServer01" placeholder="Nombre" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">Apellidos:</label>
                  <input type="text" class="form-control" id="validationServer02" placeholder="Apellidos" value="" required>
                </div>
              </div>
                <div class="form-row">
                  <div class="col-md-7 mb-3">
                    <label for="validationServer02">Correo:</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="form-check">
                      <label for="validationServer02">Sexo:</label>
                        <div>
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="" >
                          <label class="form-check-label" for="exampleRadios1"> Femenino                      
                        </div>
                        <div>
                          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="">
                          <label class="form-check-label" for="exampleRadios1"> Masculino                      
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationServer01">Telefono:</label>
                  <input type="number_format" class="form-control" id="validationServer01" placeholder="78451256" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">CI:</label>
                  <input type="text" class="form-control" id="validationServer02" placeholder="8563249" value="" required>
                </div>
                </div>
              </div>
              <div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                <input id="datepicker" width="156" />
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
                  <input type="number_format" class="form-control" id="validationServer01" placeholder="*******" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationServer02">Confirmar&nbspContraseña:</label>
                  <input type="text" class="form-control" id="validationServer02" placeholder="******" value="" required>
                </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                  <button type="button" class="btn btn-primary">Guardar</button>
                </div>
              </div>
            </div>
          </div>
       </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
