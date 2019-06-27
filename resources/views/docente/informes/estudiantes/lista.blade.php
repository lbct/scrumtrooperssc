@extends('layout')
@section('contenido')
<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Lista de Estudiantes</h3>
        <br>
        <br>
        @if(sizeof($estudiantes) > 0)
            <table>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CódigoSis</th>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Asistencia</th>
                        <th scope="col">Comentario Auxiliar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes as $estudiante)
                    <tr>
                        <td>{{($estudiante->CODIGO_SIS)}}</td>
                        <td>{{($estudiante->NOMBRE).' '.($estudiante->APELLIDO)}}</td>
                        <td>{{$asistencia[$estudiante->ID]}}</td>
                        <td>{{$comentario[$estudiante->ID]}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tiene estudiantes para la sesión seleccionada</p>
        @endif
    <div>
<div>
@endsection