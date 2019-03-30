@extends('admin.plantilla')
@section('titulo', 'Nuevo Docente')
@section('contenido_barra')
<h2>Administrador</h2>
@endsection
@section('contenido')
<br><br>
<h3>Nuevo Docente</h3>   
<form method="POST" action="/administrador/crearDocente">
    {!! csrf_field() !!}
    @include('formulario')
</form>
@endsection