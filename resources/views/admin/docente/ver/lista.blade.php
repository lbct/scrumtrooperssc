<!-- Vista de Lista de Docentes -->
@extends('layout')
@section('contenido')
<br><br>
<div>
        <h3 class="pb-1">Lista de Docentes</h3>
    </div>
    <br>
    @if (sizeof($usuarios) > 0)
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Username</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $user)
        <tr>
            <td>{{ $user->USERNAME }}</td>
            <td>{{ $user->NOMBRE }}</td>
            <td>{{ $user->APELLIDO }}</td>
            <td>
                <form action="/administrador" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a href="{{route('administrador/verDocente', $user->ID)}}" class="btn btn-link"><span class="fas fa-fw fa-eye"></span></a>
                    <a href="{{ route('administrador/editarDocente', $user->ID) }}" class="btn btn-link"><span class="fas fa-pencil-alt"></span></a>
                    <a class="btn btn-link"><span class="fas fa-trash"></span></a>
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