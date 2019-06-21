<!-- Vista de Lista de Docentes -->
@extends('layout')
@section('contenido')
<br><br>
<div>
    <h3 class="pb-1">Lista de Docentes en el Grupo</h3>
</div>
<br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col" colspan="3">Materia: {{$materia->CODIGO_MATERIA}} - {{$materia->NOMBRE_MATERIA}}</th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lista as $docente)
        <tr>
            <td>{{ $docente->NOMBRE }}</td>
            <td>{{ $docente->APELLIDO }}</td>
            <td>
                <a href="{{route('administrador/verDocente', $docente->USUARIO_ID)}}" class="btn btn-link"><span class="fas fa-fw fa-eye"></span></a>
                <a class="btn btn-link"><span class="fas fa-trash"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <form method="POST" action="/administrador/editarGrupoDocente">
        {!! csrf_field() !!}
        <tr>
            <td colspan="2">
                 <select class="form-control input-lg" name="docente">
                    @foreach($docentes as $docente)
                    <option value="{{$docente->ID}}">{{$docente->NOMBRE.' '.$docente->APELLIDO}}</option>
                    @endforeach
                </select>
            <input type="hidden" name="grupo_id" value="{{$grupo_id}}">
            </td>
            <td>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus-circle"></i> Añadir Docente
                </button>
            </td>
        </tr>
        </form>
    </tfoot>
</table>
@endsection