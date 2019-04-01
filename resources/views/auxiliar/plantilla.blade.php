@extends('layout')
@section('titulo', 'Auxiliar')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
<li class="nav-item">
  <a class="nav-link" href="/estudiante/editar">
    <i class="fas fa-fw fa-pencil-alt"></i>
    <span>Editar Datos</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="/auxiliar/clases">
    <i class="fas fa-fw fa-th-list"></i>
    <span>Lista de clases</span></a>
</li>
@endsection