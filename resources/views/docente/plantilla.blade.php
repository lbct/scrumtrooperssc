@extends('layout')
@section('titulo', 'Docente')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
<li class="nav-item">
    <a class="nav-link" href="/docente/editar">
        <i class="fas fa-fw fa-pencil-alt"></i>
        <span>Editar Datos</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/docente/crearAuxiliar">
        <i class="fas fa-fw fa-plus"></i>
        <span>Crear Auxiliar</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/docente/subirGuiaPractica">
    <i style="font-size:20px" class="fa">&#xf1c1;</i>
        <span>Subir Guia Practica</span></a>
</li>
@endsection 