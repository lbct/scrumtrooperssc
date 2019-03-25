@extends('admin.plantilla')
@section('titulo', 'Lista de Docentes')
@section('contenido_barra')
<h2>Administrador</h2>
@endsection
@section('contenido')
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
            <td>
                <form action="/administrador" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="/administrador" class="btn btn-link"><span class="fas fa-fw fa-eye"></span></a>
                    <a href="{{ route('administrador/editarDocente', $user->ID) }}" class="btn btn-link"><span class="fas fa-pencil-alt"></span></a>
                    <button type="submit" class="btn btn-link"><span class="fas fa-trash"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif
@endsection