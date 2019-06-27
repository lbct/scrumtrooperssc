<!-- Vista de Lista de Docentes -->
@extends('layout')
@section('contenido')
<br><br>
<div>
    <h3 class="pb-1">Lista de Grupos Docentes</h3>
</div>
<br>
@if (sizeof($lista) > 0)
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Detalle</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lista as $grupo)
        <tr>
            <td>{{ $grupo->ID }}</td>
            <td>{{ $grupo->DETALLE_GRUPO_DOCENTE }}</td>
            <td>
                <a href="/administrador/editarGrupoDocente/{{$grupo->ID}}" class="btn btn-link"><span class="fas fa-pencil-alt"></span></a>
                <a class="btn btn-link"><span class="fas fa-trash"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <a href="crearGrupoDocentes" class="btn btn-link"><span class="fa fa-plus-circle"></span></a>
            </td>
        </tr>
    </tfoot>
</table>
<br>
@else
<p>No hay Grupos de Docnetes registrados.</p>
@endif
@endsection