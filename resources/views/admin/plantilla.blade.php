@extends('layout')
@section('titulo', 'Administrador')
@section('contenido')
@yield('contenido')
@endsection
@section('opciones')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-plus"></i>
        <span>Crear</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="/administrador/crearDocente">Crear Docente</a>
        <a class="collapse-item" href="/administrador/crearAdmin">Crear Administrador</a>
        <a class="collapse-item" href="/administrador/crearGestion">Crear Gestión</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-table"></i>
        <span>Listas</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="/administrador/listaDocente">Lista de Docentes</a>
        <a class="collapse-item" href="/administrador">Lista de Administradores</a>
        <a class="collapse-item" href="/administrador">Lista de Gestiones</a>
        </div>
    </div>
</li>
@endsection