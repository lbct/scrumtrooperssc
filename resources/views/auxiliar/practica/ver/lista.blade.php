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
                @for($i=0;$i<sizeof($sesiones);$i++) <option value="{{$sesiones[$i]->ID}}" @if(($sesiones[$i]->ID)==$sesion_id) selected="selected" @endif>{{'Sesión #'.(sizeof($sesiones) - $i).':'}}</option>
                    @endfor
            </select>
        </form>
    </div>
</center>
    
</div>
<br>
@if($practica != null)
<table>
    <thead>
        <tr>
            <th scope="col">Semana</th>
            <th scope="col">Archivo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$practica->ID}}</td>
            <td>
                <a href="/download/{{$practica->ARCHIVO}}" class="btn btn-lg">{{$practica->ARCHIVO}}</a>
            </td>
            <div>
                <form action="{{route('auxiliar/practicas')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="clase_id" value="{{$clase_id}}" />
                    <input type="hidden" name="sesion_id" value="{{$sesion_id}}" />
                </form>
            </div>
        </tr>
    </tbody>
</table>
@else
<p>No tiene practicas para la sesion</p>
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