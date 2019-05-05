<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layout')
@section('contenido')
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">

<div id="alertas"></div>
<div class="py-5 d-flex justify-content-center">
  <form method="POST" id="form_clase" action="/docente/portafolio">
    {!! csrf_field() !!}
    <div class="col-md-12 col-md-offset-2">
      <h3>Seleccione un Estudiante</h3><br>
      <h4>{{$materia->NOMBRE_MATERIA}}</h4>
      <br>
      @if(sizeof($estudiantes) > 0)
        <table id="tabla_click">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Código SIS</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody id="materia">
                @foreach($estudiantes as $estudiante)
                <tr href="javascript:;" onclick="submit({{$estudiante->CLASE_ID}}, {{$estudiante->ESTUDIANTE_ID}});">
                    <td>{{$estudiante->CODIGO_SIS}}</td>
                    <td>{{$estudiante->USERNAME}}</td>
                    <td>{{$estudiante->NOMBRE}} {{$estudiante->APELLIDO}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            function submit(clase_id, estudiante_id) {
                var form = document.getElementById("form_clase");
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", 'clase_id');
                hiddenField.setAttribute("value", clase_id);
                form.appendChild(hiddenField);
                
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", 'estudiante_id');
                hiddenField.setAttribute("value", estudiante_id);
                form.appendChild(hiddenField);
                
                form.submit();
            }
        </script>
      @else
        <p>No tiene estudiantes registrados para la materia</p>
      @endif
    </div>
  </form>
</div>

@endsection