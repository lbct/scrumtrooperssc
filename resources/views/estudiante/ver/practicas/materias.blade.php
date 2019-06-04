@extends('layout')
@section('contenido')
<!-- Vista de Selecion de Materia para verPracticas de Estudiante -->

<div class="py-5 d-flex justify-content-center">
  <form method="POST" id="form_clase" action="/estudiante/verPracticas">
    {!! csrf_field() !!}
    <div class="col-md-12 col-md-offset-2">
      <h3>Seleccione una Materia</h3>
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
      @else
      <p>No tiene Materias Incritas</p>
      @endif
    </div>
  </form>
</div>

@endsection