@extends('layout')
@section('contenido')
<div class="container">     
<br>
    <div class="row">
        <div class="col-9">
            
        <div id="columnchart_material" style="width: 800px; height: 500px;">
         <p>"hola hola"</p>
        </div>
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
@endsection