@extends('layout')
@section('contenido')
<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Lista de Sesiones</h3>
        <br>
        <br>
        @if(sizeof($asistencias) > 0)
        <form id="form_clase" action="{{route('docente/informes/sesion')}}" method="POST">
            {!! csrf_field() !!}
            <table id="tabla_click">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Día</th>
                        <th scope="col">Hora</th>
                        <th scope="col">N° Semana</th>
                        <th scope="col">Auxiliar</th>
                        <th scope='col'>N° de Estudiantes</th>
                        <th scope="col">% Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asistencias as $asistencia)
                        <td>{{$asistencia['Dia']}}</td>
                        <td>{{$asistencia['Hora']}}</td>
                        <td>{{$asistencia['NSemana']}}</td>
                        <td>{{$asistencia['Auxiliar']}}</td>
                        <td>{{$asistencia['NEstudiantes']}}</td>
                        <td>{{$asistencia['Porcentaje']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        @else
            <p>No tiene sesiones para la materia seleccionada</p>
        @endif
    <div>
<div>
@endsection