<!-- Vista de Clases de Auxiliar -->
@extends('layout')
@section('contenido')
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
<link href="{{asset('/css/table_test.css')}}" rel="stylesheet" id="bootstrap-css">
<div>
    <br>
    <br>
    <h2 class="pb-1">Lista de Clases</h2>
</div>
<div class="ex1">
    <select class="form-control" id='anio_gestion' onchange="reload()">
        @foreach($gestiones as $gestion)
            <option value="{{$gestion->ID}}" @if(($gestion->ID)==$id_gestion) selected="selected" @endif>{{'Gestión: '.($gestion->periodo->DESCRIPCION).' - '.$gestion->ANO_GESTION}}</option>
        @endforeach
        <script>
            function reload()
            {
                var id = $("#anio_gestion").val();
                window.location = "/auxiliar/clases/"+id;
            }
        </script>
    </select>
</div>
    @if(sizeof($clases) > 0)
    <table id="tabla_click">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Aula</th>    
            <th scope="col">Materia</th>
            <th scope="col">Hora</th>
            <th scope="col">Día</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clases as $clase)
        <form id="form_clase" action="{{route('auxiliar/clases')}}" method="POST">
            {!! csrf_field() !!}
            <tr href="javascript:;" onclick="submit({{$clase->ID}});">
                <td>{{$clase->aula->NOMBRE_AULA}}</td>
                <td>{{$clase->grupoADocente->grupoDocente->materia->NOMBRE_MATERIA}}</td>
                <td>{{$clase->horario->HORA_INICIO}}</td>
                <td>
                @if($clase->DIA == 1) Lunes     @endif
                @if($clase->DIA == 2) Martes    @endif
                @if($clase->DIA == 3) Miércoles @endif
                @if($clase->DIA == 4) Jueves    @endif
                @if($clase->DIA == 5) Viernes   @endif
                @if($clase->DIA == 6) Sábado    @endif
                @if($clase->DIA == 7) Domingo   @endif
                </td>
            </tr>
            <script>
                function submit(clase_id)
                {
                    var form = document.getElementById("form_clase");
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", 'clase_id');
                    hiddenField.setAttribute("value", clase_id);
                    form.appendChild(hiddenField);
                    form.submit();
                }
            </script>
        </form>
        @endforeach
        </tbody>
    </table>
    @else
    <h4>No tiene clases registradas para la gestión seleccionada</h4>
    @endif
@endsection