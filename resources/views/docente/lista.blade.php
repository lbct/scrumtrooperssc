@extends('admin.plantilla')
@section('titulo', 'Lista de Docentes')
@section('contenido_barra')
<h2>Administrador</h2>
@endsection
@section('contenido')
<h3>Lista de Docentes</h3>
<div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">Lista de Docentes</h1>
        <p>
        </p>
    </div>

    @if ($usuarios)
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Codigo Sis</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $user)
        <tr>
            <th scope="row">{{ $user->CODIGO_SIS }}</th>
            <td>{{ $user->NOMBRE }}</td>
            <td>{{ $user->APELLIDO }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection