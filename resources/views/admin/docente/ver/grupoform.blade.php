<!-- Vista de Crear Grupo de Docentes -->
@extends('layout')
@section('contenido')
<br><br>
<div>
    <h3 class="pb-1">Crear Grupo Docente</h3>
</div>
<br>
<form method="POST" action="/administrador/crearGrupoDocentes">
    {!! csrf_field() !!}
    <br>
    <center>
        <div class="form-group col-md-8">
            <select class="form-control input-lg" name="materia">
                @foreach($materias as $materia)
                <option value="{{$materia->ID}}">{{$materia->CODIGO_MATERIA.': '.$materia->NOMBRE_MATERIA}}</option>
                @endforeach
            </select>
        </div>
    </center>
    <br>
    <center>
        <div class="form-group col-md-8">
                <select class="form-control input-lg" name="docente">
                    @foreach($docentes as $docente)
                    <option value="{{$docente->ID}}">{{$docente->NOMBRE.' '.$docente->APELLIDO}}</option>
                    @endforeach
                </select>
        </div>
    </center>
    <br>
    <div>
        <input type="submit" value="Crear" class="btn btn-primary" />
    </div>
    
</form>
@endsection