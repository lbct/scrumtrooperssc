@extends('layout')
@section('contenido')

<link href="{{asset('/css/acordeon.min.css')}}" rel="stylesheet" id="bootstrap-css">
<!-- Vista de Formulario para verPortafolio de Estudiante -->
<!--<form method="POST" action="/estudiante/editar">-->
<br>
<h3 align="left">Portafolio</h3>
<br>
<h4 align="left">Gestion/Semestre/Materia</h4>
<br>
<form>
    {!! csrf_field() !!}
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Semana</th>
            </tr>
        <tbody>
            <tr>
                <td>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="btn btn-primary btn-lg btn-block">
                                        Practica 1</a>
                                </h4>
                            </div>
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
                                                <td>
                                                    <option value="0">practica asddfaswda.png</option>
                                                    <option value="1">practica final de finales.mp3</option>
                                                </td>
                                                <td>
                                                    <option value="0">dd/mm/aaaa</option>
                                                    <option value="1">aaaa/mm/dd</option>
                                                </td>
                                                <td>
                                                    <option value="0">en mi casa</option>
                                                    <option value="1">en tu casa</option>
                                                </td>
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
            <td>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="btn btn-primary btn-lg btn-block">
                                    Practica 2</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse in">
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
                                            <td>
                                                <option value="0">practicawea fomeculeao.png</option>
                                                <option value="1">practica final de finales 2 v 7.1.mp3</option>
                                            </td>
                                            <td>
                                                <option value="0">dd/mm/aaaa</option>
                                                <option value="1">aaaa/mm/dd</option>
                                            </td>
                                            <td>
                                                <option value="0">en su casa</option>
                                                <option value="1">en la casa</option>
                                            </td>
                                        </tr>
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tbody>
        </thead>
    </table>
</form>
@endsection
