@extends('layout')
@section('contenido')
<link href="{{asset('/css/acordeon.min.css')}}" rel="stylesheet" id="bootstrap-css">
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<!--<form method="POST" action="/estudiante/editar">-->
<br>
<br>
<h3 align="center">Portafolio</h3>
<br>
<h4 align="center">{{ $materia->NOMBRE_MATERIA}}</h4>
<h5>Gestion: {{ $materia->DESCRIPCION}} - {{ $materia->ANO_GESTION}}</h5>
<br>
@foreach($sesiones as $sesion)
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn btn-primary btn-lg btn-block">
                        Semana: {{ $sesion->SEMANA }} - 
                        @if ($sesion->ASISTENCIA_SESION)
                            Asistida
                        @else
                            No Asistida
                        @endif
                    </a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse @if ($sesion == $sesiones->last()) show @else in @endif">
                <p>
                   @if ($sesion->COMENTARIO_AUXILIAR != "") 
                    Comentario del auxiliar: {{$sesion->COMENTARIO_AUXILIAR}}
                   @endif
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
<br>
@endforeach
@endsection