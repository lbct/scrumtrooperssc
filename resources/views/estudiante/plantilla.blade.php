@extends('layout')
@section('titulo', 'Estudiante')
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
  <a class="nav-link" href="/estudiante/inscripcion">
    <i class="fas fa-fw fa-pencil-alt"></i>
    <span>Inscripcion</span></a>
</li>
@endsection