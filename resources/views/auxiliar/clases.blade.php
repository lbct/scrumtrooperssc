@extends('auxiliar.plantilla')
@section('contenido_barra')
  <h2>Auxiliar</h2>
@endsection
@section('contenido')
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
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
    <table class="table">
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
        <tr>
            <th scope="row">{{$clase->aula->NOMBRE_AULA}}</th>
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
            <td>
                <form action="{{route('auxiliar/clases')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="clase_id" value="{{$clase->ID}}"/>
                    <a href="javascript:;" onclick="parentNode.submit();"><span class="fas fa-fw fa-eye"></a>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <h4>No tiene clases registradas para la gestión seleccionada</h4>
    @endif
@endsection