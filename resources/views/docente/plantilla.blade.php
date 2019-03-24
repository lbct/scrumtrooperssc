@extends('layout')
@section('titulo', 'Docente')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
<li class="nav-item">
        <a class="nav-link" href="/docente">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>Editar Datos</span></a>
      </li>
<li class="nav-item">
<a class="nav-link" href="/docente/crearAuxiliar">
    <i class="fas fa-fw fa-plus"></i>
    <span>Crear Auxiliar</span></a>
</li>
@endsection