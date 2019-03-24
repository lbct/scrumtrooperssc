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
    <!--Para las graficas -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Gestion 2019', 'Mañana', 'Tarde', 'Noche'],
          ['1', 1000, 400, 200],
          ['2', 1170, 460, 250],
          ['3', 660, 1120, 300],
          ['4', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'SESLAB',
            subtitle: 'trabajos subidos por gestion',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
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

<div class="container">     
<br>
    <div class="row justify-content-end">
        <div class="col-9">
            
        <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        </div>
        <div class="col-2">
        <br>
        <h4>Grupos&nbspActivos</h4>
            <span class="float-left">
                    <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Materia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pend 1</td>
                            <td>Doe</td>
                            <td>Mateira</td>
                        </tr>
                        <tr>
                            <td>pend 2</td>
                            <td>Thomas</td>
                            <td>Mateira</td>
                        </tr>
                        <tr>
                            <td>pend 3</td>
                            <td>Jim</td>
                            <td>Mateira</td>
                        </tr>
                    </tbody>
                </table>
            </span>
            <span class="float-left">
                    <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Materia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pend 1</td>
                            <td>Doe</td>
                            <td>Mateira</td>
                        </tr>
                        <tr>
                            <td>pend 2</td>
                            <td>Thomas</td>
                            <td>Mateira</td>
                        </tr>
                        <tr>
                            <td>pend 3</td>
                            <td>Jim</td>
                            <td>Mateira</td>
                        </tr>
                    </tbody>
                </table>
            </span>
        </div>
        <div class="w-100"></div>
        <div class="col-11">
        <table class="table table-hover">
                <h2>Horario de clases</h2>
                <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>Aula</th>
                                    <th>Docente</th>
                                    <th>Auxiliar</th>
                                    <th>Grupo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>pend 1</td>
                                    <td>Doc 1</td>
                                    <td>Mat 1</td>
                                    <td>Aux 1</td>
                                    <td>Grupo 1</td>
                                </tr>
                                <tr>
                                    <td>pend 2</td>
                                    <td>Doc 2</td>
                                    <td>Mat 2</td>
                                    <td>Aux 2</td>
                                    <td>Grupo 2</td>
                                </tr>
                                <tr>
                                    <td>pend 3</td>
                                    <td>Doc 3</td>
                                    <td>Mat 3</td>
                                    <td>Aux 3</td>
                                    <td>Grupo 3</td>
                                </tr>
                                <tr>
                                    <td>pend 4</td>
                                    <td>Doc 4</td>
                                    <td>Mat 4</td>
                                    <td>Aux 4</td>
                                    <td>Grupo 4</td>
                                </tr>
                                <tr>
                                    <td>pend 5</td>
                                    <td>Doc 5</td>
                                    <td>Mat 5</td>
                                    <td>Aux 5</td>
                                    <td>Grupo 5</td>
                                </tr>
                            </tbody>
         </table>
        </div>
    </div>
</div>
  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('jquery/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
