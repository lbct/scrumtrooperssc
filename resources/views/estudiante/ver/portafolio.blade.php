@extends('layout')
@section('contenido')
<link href="{{asset('/css/acordeon.min.css')}}" rel="stylesheet" id="bootstrap-css">
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<!--<form method="POST" action="/estudiante/editar">-->
<br>
<h3 align="left">Portafolio</h3>
<br>
<span>
<h5 align="left">{{ $materia->NOMBRE_MATERIA}}/ Año {{ $materia->ANO_GESTION}} / {{ $materia->DESCRIPCION}}</h5></span>
<br>
<form>
    {!! csrf_field() !!}
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Semana</th>
            </tr>
        <tbody>
            @foreach($practicas as $practicas)
            <tr>
                <td>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <!--esta paerte no estoy seguro que pasara <a data-toggle="collapse" data-parent="#accordion" href="#$practica" class="btn btn-primary btn-lg btn-block">-->
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn btn-primary btn-lg btn-block">
                                    Practica {{ $practicas->SEMANA }}</a>
                                </h4>
                            </div>
                            <!--<div id="$practica" class="panel-collapse collapse in">-->
                            <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Archivo</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Lugar</th>
                                            </tr>
                                        <tbody>
                                            <tr>

                                                <td>ARCHIVO 1</td>
                                                <td>FECHA 1</td>
                                                <td>LUGAR 1</td>
                                            </tr>
                                        </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <br>
            @endforeach
        </tbody>
        </thead>
    </table>
</form>
@endsection