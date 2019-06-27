@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
            <form id="form_clase" action="/docente/clases/crear/horario" method="POST">
                {!! csrf_field() !!}
                <h3>Seleccione una Materia</h3>
                <br>
                <br>
                @if(sizeof($materias) > 0)
                <table id="tabla_click">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Grupo Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($materias as $materia)
                        <tr href="javascript:;" onclick="submit({{$materia->ID}});">
                            <td>{{$materia->CODIGO_MATERIA}}</td>
                            <td>{{$materia->NOMBRE_MATERIA}}</td>
                            <td>{{$materia->DETALLE_GRUPO_DOCENTE}}</td>
                        </tr>
                        <script>
                            function submit(materia_id) {
                                var form = document.getElementById("form_clase");
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", 'grupo_docente_id');
                                hiddenField.setAttribute("value", materia_id);
                                form.appendChild(hiddenField);
                                form.submit();
                            }
                        </script>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No tiene materias registradas para la gestión seleccionada</p>
                @endif
        </form>
    </div>
</div>
@endsection