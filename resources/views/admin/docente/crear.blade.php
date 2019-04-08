<!-- Vista de Crear Docente -->
@extends('layout')
@section('contenido')
<br><br>
<h3>Nuevo Docente</h3>
<form method="POST" action="/administrador/crearDocente">
    {!! csrf_field() !!}
    @include('formulario')
</form>
@endsection