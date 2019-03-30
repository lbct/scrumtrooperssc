@extends('layout')
@section('titulo', 'Auxiliar')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
<li class="nav-item">
        <a class="nav-link" href="/auxliar/editar">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>Editar Datos</span></a>
      </li>
@endsection