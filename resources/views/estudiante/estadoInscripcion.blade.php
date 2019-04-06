@extends('estudiante.plantilla')
@section('contenido_barra')
  <h2>Estudiante</h2>
@endsection
<!-- AQUI EL CONTENIDO :V-->
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
            <th scope="row">{{ $materia->NOMBRE_MATERIA }}</th>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No tienes Materias Inscritas.</p>
    @endif
@endsection