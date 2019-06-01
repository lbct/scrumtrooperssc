@extends('layout')
@section('contenido')


<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Lista de Estudiantes<h3>
        <br>
        <br>
        @if(sizeof($nombres) > 0)
            <table>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">CodigoSis</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nombres as $nombre)
                        <td>{{$nombre->CODIGO_SIS}}</td>
                        <td>{{$nombre->NOMBRE}}</td>
                        <td>{{$nombre->APELLIDO}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tiene estudiantes registrados para la materia seleccionada</p>
        @endif
    <div>
<div>

@endsection