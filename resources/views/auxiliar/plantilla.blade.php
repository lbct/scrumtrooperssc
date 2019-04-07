@extends('layout')
@section('titulo', 'Auxiliar')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
@if(App\Models\Estudiante::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
@include('estudiante.opcionesMenu')
@endif
<li class="nav-item">
  <a class="nav-link" href="/auxiliar/clases">
    <i class="fas fa-fw fa-th-list"></i>
    <span>Lista de clases</span></a>
</li>
@endsection