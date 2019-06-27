<!-- Vista de Materias Inscritas -->
@extends('layout')
@section('contenido')
<br>
<br>
<div>
    <h3 class="pb-1">Materias Inscritas</h3>
    <br>
</div>

@if (sizeof($materias) > 0)
<center>
    <table class="table form-group col-md-6">
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
</center>
@else
<p>No tienes Materias Inscritas.</p>
@endif
@endsection