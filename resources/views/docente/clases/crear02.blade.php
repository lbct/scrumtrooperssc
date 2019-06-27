@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <form id="form_clase" action="/docente/clases/crear" method="POST">
                {!! csrf_field() !!}
                <h3>Confirme la Clase</h3>
                <br>
                <br>
                @if(sizeof($aulas_disponibles) > 0)
                        <select name="aula_id" class="form-control" id='aula_id'>
                            @foreach ($aulas_disponibles as $aula)
                                <option value="{{$aula->AULA_ID}}">
                                    {{$aula->NOMBRE_AULA}}
                                </option>
                            @endforeach
                        </select>
                @else
                    <p>No hay aulas disponibles/p>
                @endif
            <input type="hidden" id="horario_id" name="horario_id" value="{{$horario->ID}}">
            <input type="hidden" id="dia" name="dia" value="{{$dia}}">
            <input type="hidden" id="grupo_docente_id" name="grupo_docente_id" value="{{$grupo_docente}}">
                        
            <input type="text" name="materia" class="form-control" value="{{$materia}}" disabled>
            <input type="text" name="dia" class="form-control" value="{{$dia_literal}}" disabled>
            <input type="text" name="horario" class="form-control" value="{{$horario->HORA_INICIO}} - {{$horario->HORA_FIN}}" disabled>
            
            <input type="submit" value="Confirmar" class="btn btn-primary" tabindex="7" style="margin:10px">
            <input type="button" class="m-3 btn btn-danger" value="Cancelar" onclick="window.location='/docente/clases/crear'">
        </form>
    </div>
</div>
@endsection