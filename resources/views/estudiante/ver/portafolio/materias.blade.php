<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layout')
@section('contenido')
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">

<div id="alertas"></div>
<div class="py-5 d-flex justify-content-center">
  <form method="POST" id="form_clase" action="/estudiante/portafolio/ver">
    {!! csrf_field() !!}
    <div class="col-md-12 col-md-offset-2">
      <h3>Seleccione una Materia</h3>
      <br>
      <center>
        @if(sizeof($clases) > 0)
            <div class="ex1 form-group col-md-6">
              <select class="form-control" id="gestion" name="gestion" value="{{ old('gestion') }}" required>
                @foreach ($gestiones as $gestion)
                    <option value="{{$gestion->ID}}">
                      Gestion: {{$gestion->DESCRIPCION}} - {{$gestion->ANO_GESTION}}
                    </option>
                @endforeach
              </select>
            </div>
        @else
            <p>No tienes Materias Inscritas</p>
        @endif
      </center>
      <br>
      @if(sizeof($clases) > 0)
        <table id="tabla_click">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Materia</th>
                </tr>
            </thead>
            <tbody id="materia">
                @foreach($clases as $clase)
                <tr href="javascript:;" onclick="submit({{$clase->CLASE_ID}});">
                    <td>{{$clase->NOMBRE_MATERIA}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            function submit(clase_id) {
                var form = document.getElementById("form_clase");
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", 'clase_id');
                hiddenField.setAttribute("value", clase_id);
                form.appendChild(hiddenField);
                form.submit();
            }
        </script>
      @elseif (sizeof($clases) > 0)
      <p>No tiene materias registradas para la gestión seleccionada</p>
      @endif
    </div>
  </form>
</div>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>
  var $gestion = $('#gestion');
  var $materia = $('#materia');

  $gestion.change(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/estudiante/portafolio/materias',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        gestion: $gestion.val(),
      },
      dataType: 'JSON',
      success: function(materias) {
        if (materias.length > 0) {
          $materia.html("");
          materias.forEach(function(materia) {
            $fila = '<tr onclick="submit('+materia.CLASE_ID+');"><td>'+materia.NOMBRE_MATERIA+'</td></tr>';
            $materia.append($fila);
          });
        } else {
          $alertas = document.getElementById('alertas');
          $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-danger'>No se tiene materias disponibles.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>"
        }
      }
    });
  });
</script>

@endsection