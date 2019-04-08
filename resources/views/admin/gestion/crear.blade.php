<!-- Vista de Crear Gestion -->
@extends('layout')
@section('contenido')
<br><br>
<h3>Nueva Gestión</h3>
<form method="POST" action="/administrador/crearGestion">
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
{!! csrf_field() !!}
    <div>
        <div class="ex1">
            <select class="form-control" name="periodo">
                @foreach($items as $item)
                <option value="{{$item->ID}}">{{'Periodo: '.$item->DESCRIPCION}}</option>
                @endforeach
            </select>
        </div>
        <div class="ex2">
            <select class="form-control" name='año_gestion'>
                @for($año=date("Y");$año>=(date("Y")-4);$año--)
                <option value="{{$año}}">{{'Año: '.$año}}</option>
                @endfor
            </select>
        </div>
        <div>
            <input type="submit" value="Crear" class="btn btn-primary" />
        </div>
    </div>
</form>
@endsection