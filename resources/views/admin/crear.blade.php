@extends('layout')
@section('contenido')
<br><br>
<h3>Nuevo Administrador</h3>
<form method="POST" action="/administrador/crearAdmin">
    {!! csrf_field() !!}
    @include('formulario')
</form>

@endsection