@extends('layout')
@section('titulo', 'Estudiante')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
@include('estudiante.opcionesMenu')
@if(App\Models\Auxiliar::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
<li class="nav-item">
  <a class="nav-link" href="/auxiliar/clases">
    <i class="fas fa-fw fa-th-list"></i>
    <span>Lista de clases</span></a>
</li>
@endif
@endsection