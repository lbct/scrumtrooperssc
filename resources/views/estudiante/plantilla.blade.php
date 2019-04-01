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
@if(App\Models\Auxiliar::where('USUARIO_ID', '=', \Illuminate\Support\Facades\Cookie::get('USUARIO_ID'))->first() != null)
<li class="nav-item">
  <a class="nav-link" href="/auxiliar/clases">
    <i class="fas fa-fw fa-th-list"></i>
    <span>Lista de clases</span></a>
</li>
@endif
</li>
<li class="nav-item">
  <a class="nav-link" href="/estudiante/inscripcion">
    <i class="fas fa-fw fa-pencil-alt"></i>
    <span>Inscripcion</span></a>
</li>
@endsection