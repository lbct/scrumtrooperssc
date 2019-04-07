@extends('layout')
@section('contenido')
<h1>Docente {{ $usuario->CODIGO_SIS }}</h1>
    <p>Nombre: {{ ($usuario->NOMBRE).' '.($usuario->APELLIDO) }}</p>
    <p>Correo electrónico: {{ $usuario->CORREO }}</p>
    <p>Teléfono: {{ $usuario->TELEFONO }}</p>
    <p>CI: {{ $usuario->CI }}</p>
    <p>Fecha de Nacimiento: {{ $usuario->FECHA_NACIMIENTO }}</p>
@endsection