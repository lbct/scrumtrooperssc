@extends('auxiliar.plantilla')
@section('titulo', 'Nuevo Auxiliar')
@section('contenido_barra')
<h2>Docente</h2>
@endsection
@section('contenido')
<br><br>
<h3>Nuevo Auxiliar</h3>   
    <form method="POST" action="/docente/crearAuxiliar">
        {!! csrf_field() !!}
        @include('formulario')
@endsection