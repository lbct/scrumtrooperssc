<!-- Vista de Crear Auxiliar -->
@extends('layout')
@section('contenido')
<form method="POST" action="/docente/crearAuxiliar">
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                <form role="form">
                    <br>
                    <br>
                    <h3>Nuevo Auxiliar</h3>
                    <br>
                    <div>
                        <center>
                            <div class="ex1 form-group col-md-10">     
                                <select name="grupo_docente_id" class="form-control" required>
                                    @foreach($grupos_docentes as $grupo_docente)
                                        <option value="{{$grupo_docente->ID}}">
                                            {{$grupo_docente->NOMBRE_MATERIA}}
                                        </option>
                                    @endforeach
                                </select>      
                            </div>
                            <div class="ex1 form-group col-md-10">
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Usuario del auxiliar" required>
                            </div>
                        </center>
                        <br>
                        <div>
                            <input type="submit" value="Registrar" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>
@endsection