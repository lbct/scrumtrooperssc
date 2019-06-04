@extends('layout')
@section('contenido')
<!-- Vista de Materias a Retirar -->
<br>
<br>
<div>
    <h3 class="pb-1">Seleccione la Materia que va a Retirar</h3>
    <br>
</div>

@if (sizeof($materias) > 0)
<center>
    <table>
    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Retirar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($materias as $materia)
        <tr>
            <td>{{ $materia->CODIGO_MATERIA}}</th>
            <td>{{ $materia->NOMBRE_MATERIA}}</td>
            <td>
                <form id="form_check" action="{{route('auxiliar/clases')}}" method="POST">
                <input type="checkbox" name='retirar' value="1">    
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
    <div class="column2"><input type="SUBMIT"  value="Confirmar" class="btn btn-primary" tabindex="7" style="margin:10px"></div>
    </div>
</center>
@else
<p>No tienes Materias Inscritas.</p>
@endif
@endsection