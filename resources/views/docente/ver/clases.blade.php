@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
            <form id="form_clase" action="{{route('docente/subirPractica')}}" method="POST">
                {!! csrf_field() !!}
                <h3>Seleccione una Materia</h3>
                <br>
                <center>
                    <div class="ex1 form-group col-md-6">
                        <select name="gestion_id" class="form-control" id='año_gestion' onchange="reload()">
                            @foreach($gestiones as $gestion)
                            <option value="{{$gestion->ID}}" @if(($gestion->ID)==$id_gestion) selected="selected" @endif>{{'Gestión: '.($gestion->periodo->DESCRIPCION).' - '.$gestion->ANO_GESTION}}</option>
                            @endforeach
                            <script>
                                function reload() {
                                    var id = $("#año_gestion").val();
                                    window.location = "/docente/subirPractica/" + id;
                                }
                            </script>
                        </select>
                    </div>
                </center>
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