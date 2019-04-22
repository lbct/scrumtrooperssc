@extends('layout')
@section('contenido')
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<form method="POST" action="/estudiante/ver/portafolio">
    <form>
        {!! csrf_field() !!}
        <link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">
        <br><br>
        <div class="container col-md-5 col-md-offset-4  ">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body col-md-12 ">
                        <div class="col-md-12 ">
                            <center>
                                <h3>Ver Portafolio</h3>
                            </center>
                        </div>
                    </div>
                    <div>
                        <br>
                        <div class="form-row">
                            <div>
                                <center>
                                    <div class="col-md-8 mb-4">
                                        <label for="Gestion">Seleccione Una Gestion</label>
                                        <select class="form-control" id="gestion" name="gestion" value="{{ old('gestion') }}" required>
                                            @foreach ($gestion as $gestion)
                                            <option value={{$gestion->ID}}>{{$gestion->ANO_GESTION}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </center>
                                <center>
                                    <div class="col-md-8 mb-4">
                                        <label for="Periodo">Seleccione Un Periodo</label>
                                        <select class="form-control" id="periodo" name="periodo" value="{{ old('periodo') }}" required>
                                            @foreach ($periodo as $periodo)
                                            <option value={{$periodo->ID}}>{{$periodo->DESCRIPCION}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </center>
                                <center>
                                    <div class="col-md-12 mb-4">
                                        <label for="Materia">Seleccione la Materia</label>
                                        <select class="form-control" id="materia" name="materia" value="{{ old('materia') }}" required>
                                            @foreach ($materias as $materia)
                                            <option value={{$materia->ID}}>{{$materia->NOMBRE_MATERIA}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </center>
                                <div class="form-group row justify-content-center">
                                    <div class="column2"><input type="submit" href="/estudiante/formularioPortafolio" value="Ver" class="btn btn-primary" tabindex="7" style="margin:10px"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    @endsection