@extends('admin.plantilla')
@section('titulo', 'Nuevo Administrador')
@section('contenido_barra')
<h2>Administrador</h2>
@endsection
@section('contenido')
<br><br>
<h3>Nuevo Administrador</h3>
<form method="POST" action="/administrador/crearAdmin">
    {!! csrf_field() !!}
    @include('formulario')
</form>

@endsection