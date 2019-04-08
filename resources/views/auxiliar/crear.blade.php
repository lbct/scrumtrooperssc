@extends('docente.plantilla')
@section('titulo', 'Nuevo Auxiliar')
@section('contenido_barra')
<h2>Docente</h2>
@endsection
@section('contenido')
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
<form method="POST" action="/docente/crearAuxiliar">
{!! csrf_field() !!}
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div>
                <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <br>
                        <br>
                        <h3>Nuevo Auxiliar</h3>
                        <div>
                            <div class="ex1">
                                <input type="number" name="codigo_sis" id="codigo_sis" class="form-control input-lg" placeholder="CodigoSis Estudiante" tabindex="4" value="{{ old('codigo_sis') }}">
                            </div>
                            <div>
                                <input type="submit" value="Registrar" class="btn btn-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection