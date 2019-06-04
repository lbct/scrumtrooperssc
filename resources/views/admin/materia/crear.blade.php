<!-- Vista de Crear Materia -->
@extends('layout')
@section('contenido')
<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
<form method="POST" action="/administrador/crearMateria">
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div>
                <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <br><br>
                        <h3>Nueva Materia</h3>
                        <br>
                        <div class="form-row">
                            <div class="col-md-7 mb-12">
                                <input type="text" name="nombre_materia" id="nombre_materia" class="form-control" placeholder="Nombre de la materia" tabindex="1" value="{{ old('nombre_materia') }}">
                            </div>
                            <div class="col-md-5 mb-4">
                                <input type="text" name="codigo_materia" id="codigo_materia" class="form-control" placeholder="Codigo de Materia" tabindex="2" value="{{ old('codigo_materia') }}">
                            </div>
                        </div>
                        <center>
                            <div class="col-md-11 mb-11">
                                <textarea type="text" name="detalle_materia" id="detalle_materia" class="form-control"  placeholder="Detalle de la Materia" tabindex="3" value="{{ old('detalle_materia') }}"></textarea>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </center>
                        <br>
                        <center>
                            <div class="ex1 form-group col-md-6">
                                <select name="gestion_id" class="form-control" id='año_gestion' onchange="reload()">
                                    @foreach($gestiones as $gestion)
                                    <option value="{{$gestion->ID}}" @if(($gestion->ID)==$id_gestion) selected="selected" @endif>{{'Gestión: '.($gestion->periodo->DESCRIPCION).' - '.$gestion->ANO_GESTION}}</option>
                                    @endforeach
                                    <script>
                                        function reload() {
                                            var id = $("#año_gestion").val();
                                            window.location = "/Admin/Materia/crear" + id;
                                        }
                                    </script>
                                </select>
                            </div>
                        </center>
                        <br>
                        <div>
                            <input type="submit" value="Crear" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection