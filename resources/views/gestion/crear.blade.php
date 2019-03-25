@extends('admin.plantilla')
@section('titulo', 'Nueva Gestión')
@section('contenido_barra')
<h2>Nueva Gestión</h2>
@endsection
@section('contenido')
<br><br>
<h3>Nuevo Gestion</h3>
<form method="POST" action="/administrador/crearGestion">
    {!! csrf_field() !!}
    <div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <div class="container col-md-5 col-md-offset-5 ">
            <div class="row">
                <div class="panel panel-default">
                    <div>
                        <br>
                        <br>
                        <form>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    Fecha&nbspInicio:<input id="startDate" name="fecha_inicio" width="376" value="{{ old('fecha_inicio') }}" />
                                    <br>
                                    Fecha Fin:<input id="endDate" name="fecha_fin" width="376" value="{{ old('fecha_inicio') }}" />
                                </div>
                            </div>
                            <div class="form-row">
                                <script>
                                    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                                    $('#startDate').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibrary: 'fontawesome',
                                        minDate: today,
                                        maxDate: function() {
                                            return $('#endDate').val();
                                        }
                                    });
                                    $('#endDate').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibrary: 'fontawesome',
                                        minDate: function() {
                                            return $('#startDate').val();
                                        }
                                    });
                                </script>
                            </div>
                            <div class="col-md-3 mb-3">
                                Semestre:
                                <div class="form-group column2 row justify-content-end">
                                    <select id="sexo" name="sexo" class="form-control input-lg" width="000" tabindex="9" value="{{ old('numero_semestre') }}">
                                        <option value=" 1">PS</option>
                                        <option value="2">Ver</option>
                                        <option value="3">SS</option>
                                        <option value="4">Inv</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>


<!--
        <div>
            Fecha Inicio:
            <input name="fecha_inicio" type="date" value="{{ old('fecha_inicio') }}">
        </div>
        <br>
        <div>
            Fecha Fin:
            <input name="fecha_fin" type="date" value="{{ old('fecha_fin') }}">
        </div>
        <br>
        <div>
            Número de semestre
            <input type="number" name="numero_semestre" value="{{ old('numero_semestre') }}">
        </div>
        <br>
        <div>
            <button type="submit">Registrar</button>
        </div>
    </div>-->
</form>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> 