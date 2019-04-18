<!-- Vista de Datos de Docente -->
@extends('layout')
@section('contenido')
<h1>Docente {{ $usuario->CODIGO_SIS }}</h1>
<p>Nombre: {{ ($usuario->NOMBRE).' '.($usuario->APELLIDO) }}</p>
<p>Correo electrónico: {{ $usuario->CORREO }}</p>
@endsection