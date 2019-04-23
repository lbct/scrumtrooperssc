@extends('layout')
@section('contenido')
<link href="{{asset('/css/acordeon.min.css')}}" rel="stylesheet" id="bootstrap-css">
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<!--<form method="POST" action="/estudiante/editar">-->
<br>
<h3 align="left">Portafolio</h3>
<br>
<span>
<h5 align="left">{{ $materia->NOMBRE_MATERIA}} / {{ $materia->ANO_GESTION}} - {{ $materia->DESCRIPCION}}</h5></span>
<br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Semana</th>
        </tr>
    <tbody>
        @foreach($sesiones as $sesion)
        <tr>
            <td>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn btn-primary btn-lg btn-block">
                                    Semana: {{ $sesion->SEMANA }} - 
                                    @if ($sesion->ASISTENCIA_SESION)
                                        Asistencia
                                    @else
                                        Sin asistencia
                                    @endif
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <p>
                                Comentario del auxiliar: {{$sesion->COMENTARIO_AUXILIAR}}
                            </p>
                            <p>
                                
                            </p>
                            <div class="panel-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Archivo</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Lugar</th>
                                        </tr>
                                    <tbody>
                                        @foreach ($practicas as $practica)
                                            @if ($practica->SEMANA == $sesion->SEMANA)
                                                <tr>
                                                    <td>{{$practica->ARCHIVO}}</td>
                                                    <td>{{$practica->created_at}}</td>
                                                     @if ($practica->EN_LABORATORIO)
                                                        <td>En Laboratorio</td>
                                                     @else
                                                        <td>Fuera del Laboratorio</td>
                                                     @endif
                                                </tr>
                                             @endif
                                        @endforeach
                                    </tbody>
                                    </thead>
                                </table>
                                <a class="m-3 btn btn-primary pull-right" href="/estudiante/clases/{{$sesion->ID}}">Subir archivo</a>
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
@endsection