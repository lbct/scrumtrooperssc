<!-- Vista de Materias Inscritas -->
@extends('layout')
@section('contenido')
<div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">Materias Inscritas</h1>
        <p>
        </p>
    </div>

    @if (sizeof($materias) > 0)
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
           
        </tr>
        </thead>
        <tbody>
        @foreach($materias as $materia)
        <tr>
            <td>{{ $materia->NOMBRE_MATERIA }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No tienes Materias Inscritas.</p>
    @endif
@endsection