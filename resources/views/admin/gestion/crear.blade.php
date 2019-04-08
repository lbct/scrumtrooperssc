<!-- Vista de Crear Gestion -->
@extends('layout')
@section('contenido')
<link href="{{asset('/css/form.css')}}" rel="stylesheet" id="bootstrap-css">
<form method="POST" action="/administrador/crearGestion">
    {!! csrf_field() !!}
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div>
                <div class="col-xs-12 col-sm-offset-2 col-md-offset-3">
                    <form role="form">
                        <br><br>
                        <h3>Nueva Gestión</h3>
                        <br>
                        <center>
                            <div class="form-group col-md-11">
                                <select class="form-control input-lg" name="periodo">
                                    @foreach($items as $item)
                                    <option value="{{$item->ID}}">{{'Periodo: '.$item->DESCRIPCION}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </center>
                        <br>
                        <center>
                            <div class="form-group col-md-11">
                                <select class="form-control input-lg" name='año_gestion'>
                                    @for($año=date("Y");$año>=(date("Y")-4);$año--)
                                    <option value="{{$año}}">{{'Año: '.$año}}</option>
                                    @endfor
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
