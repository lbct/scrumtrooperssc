<!-- Vista de Lista de Estudiantes de una Clase -->
@extends('layout')
@section('contenido')
<div>
    <br>
    <br>
    <h3 class="pb-1">Practica Asignada</h3>
    <br>
</div>
<div>       
<center>
    <div class="form-group col-md-6">
        <form action="{{route('auxiliar/practicas')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="clase_id" value="{{$clase_id}}" />
            <select class="form-control" id='sesiones_est' name='sesion_id' onchange="parentNode.submit();">
                @for($i=0;$i<sizeof($sesiones);$i++) <option value="{{$sesiones[$i]->ID}}" @if(($sesiones[$i]->ID)==$sesion->ID) selected="selected" @endif>{{'Sesión #'.(sizeof($sesiones) - $i).':'}}</option>
                    @endfor
            </select>
        </form>
        <div>
            <form action="{{route('auxiliar/practicas')}}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="clase_id" value="{{$clase_id}}" />
                <input type="hidden" name="sesion_id" value="{{$sesion->ID}}" />
            </form>
        </div>
    </div>
</center>
<div>
    <form action="{{route('auxiliar/iniciarClase')}}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="sesion_id" value="{{$sesion->ID}}"/>
        <input type="submit" class="btn btn-info" value="Iniciar Clase"/>
    </form>
</div>
</div>
<br>
@if($permiso == 1)
<table>
    <thead>
        <tr>
            <th scope="col">Semana</th>
            <th scope="col">Archivo</th>
        </tr>
    </thead>
    <tbody>
            @foreach($practicas as $practica)
        <tr>
            <td>{{$sesion->SEMANA}}</td>
            <td>
                <a href="/descargar/guia/{{$practica->ARCHIVO}}" class="btn btn-info">{{$practica->ARCHIVO}}</a>
            </td>            
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h3>&nbsp</h3>
    <h3>No tiene permiso para ver la practica</h3>
    <h3>&nbsp</h3>
    @if($permiso == -1)
        <form action="{{route('auxiliar/asignar')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="auxiliar_id" value="{{$auxiliar_id}}" />
            <input type="hidden" name="sesion_id" value="{{$sesion->ID}}" />
            <input type="submit" value="Volverme responsable de la Sesion" class="m-3 btn btn-danger">
        </form>
        <h3>&nbsp</h3>
        <h3>&nbsp</h3>
    @endif
@endif
<br><br>
<div>
    <input type="submit" value="Volver a lista de Clases" onclick="volver({{$id_gestion}});" class="btn btn-primary">
    <script>
        function volver(id_gestion) {
            window.location = "/auxiliar/practicas/" + id_gestion;
        }
    </script>
</div>
@endsection