@extends('admin.plantilla')
@section('titulo', 'Nueva Gestión')
@section('contenido_barra')
<h2>Nueva Gestión</h2>
@endsection
@section('contenido')
<h3>Nuevo Auxiliar</h3>
<form method="POST" action="/administrador/crearGestion">
    {!! csrf_field() !!}
    <div>
        Fecha Inicio:
        <input name="fecha_inicio" type="date" value="{{ old('fecha_inicio') }}">
    </div>
    <div>
        Fecha Fin:
        <input name="fecha_fin" type="date" value="{{ old('fecha_fin') }}">
    </div>
    <div>
        Número de semestre
        <input type="number" name="numero_semestre" value="{{ old('numero_semestre') }}">
    </div>
    <div>
        <button type="submit">Registrar</button>
    </div>
</form>
@endsection