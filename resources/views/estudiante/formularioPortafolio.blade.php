<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layout')
@section('contenido')
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">

<div id="alertas"></div>
<div class="py-5 d-flex justify-content-center">
  <form method="POST" action="/estudiante/portafolio/ver">
    {!! csrf_field() !!}
    <div class="col-md-12 col-md-offset-2">
      <h3>Ver Portafolio</h3>

      <label for="Gestion">Seleccione una Gestión</label>
      <select class="form-control" id="gestion" name="gestion" value="{{ old('gestion') }}" required>
        <option disabled selected value>Selecciona una Gestión</option>
        @foreach ($gestiones as $gestion)
        <option value={{$gestion->ANO_GESTION}}>
          {{$gestion->ANO_GESTION}}
        </option>
        @endforeach
      </select>

      <label for="Periodo">Seleccione un Periodo</label>
      <select class="form-control" id="periodos" name="periodos" value="{{ old('periodos') }}" required>
        <option disabled selected value>Selecciona un Periodo</option>
        @foreach ($periodos as $periodos)
        <option value={{$periodos->DESCRIPCION}}>
          {{$periodos->DESCRIPCION}}
        </option>
        @endforeach
      </select>

      <label for="Materia">Seleccione la Materia</label>
      <select class="form-control" id="materias" name="materias" value="{{ old('materias') }}" required>
        <option disabled selected value>Selecciona una Materia</option>
        @foreach ($materias as $materias)
        <option value={{$materias->NOMBRE_MATERIA}}>
          {{$materias->NOMBRE_MATERIA}}
        </option>
        @endforeach
      </select>

      <div class="form-group row justify-content-center">
        <div class="column2">
          <button type="submit" class="m-3 btn btn-primary pull-right" id="enviar">Ver Portafolio</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="http://localhost/vendor/jquery/jquery.min.js"></script>
<script>
  var $gestion = $('#gestion');
  var $periodo = $('#periodo');
  var $materia = $('#materia');

  $gestion.change(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/estudiante/portafolio',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        paso: 2,
        gestion: $gestion.val(),
      },
      dataType: 'JSON',
      success: function(periodos) {
        if (periodos.length > 0) {
          $periodo.html("<option disabled selected value>Selecciona una Gestión</option>");
          periodos.forEach(function(periodo) {
            $periodo.append(new Option(periodo.DESCRIPCION, periodo.PERIODO_ID));
          });
        } else {
          $alertas = document.getElementById('alertas');
          $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-danger'>No se tiene periodos disponibles.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>"
        }
      }
    });
  });

  $periodo.change(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/estudiante/portafolio',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        paso: 3,
        gestion: $gestion.val(),
        periodo: $periodo.val(),
      },
      dataType: 'JSON',
      success: function(materias) {
        if (materias.length > 0) {
          $materia.html("<option disabled selected value>Selecciona una Gestión</option>");
          materias.forEach(function(materia) {
            $materia.append(new Option(materia.NOMBRE_MATERIA, materia.CLASE_ID));
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