<!-- Vista de Lista de Estudiantes de una Clase -->
@extends('layout')
@section('contenido')
<div>
    <br>
    <br>
    <h3 class="pb-1">Estudiante: {{$estudiante->Usuario->NOMBRE.' '.$estudiante->Usuario->APELLIDO}}</h3>
    <h4 class="pb-1">CodigoSis: {{$estudiante->CODIGO_SIS}}</h4>
</div>
<div>
</div>
@if($sesion_estudiante != null)
<link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">
<form id="form_comentario" method="POST" action="/auxiliar/clases/estudiante/practica">
    {!! csrf_field() !!}
    <div class="container col-md-5 col-md-offset-4">
        <br>
        <p>Comentar práctica 
            @if($practica->EN_LABORATORIO == 1)
                de laboratorio
            @else
                externa
            @endif
        </p>
        <br>
        <center>
            <input class="btn btn-primary" type="button" value="{{'Descargar '.$practica->ARCHIVO}}"/>
        </center>
        <br>
        <center>
            <textarea type="text" rows="5" name="comentario" id="comentario" class="form-control" style="resize: none" tabindex="1">{{ $sesion_estudiante->COMENTARIO_AUXILIAR }}</textarea>
        </center>
        <br>
        <div>
            <div class="form-group row justify-content-center">
                <div class="column2"><input type="button" class="btn btn-primary" onclick="submitComentario();" value="Guardar" tabindex="7" style="margin:10px"></div>
                <div class="column"><input type="button" class="btn btn-danger" onclick="volver();" value="Cancelar" tabindex="7" style="margin:10px">
                    <script>
                            function volver() {
                                window.location = "/auxiliar/clases";
                            }
                            function submitComentario(){
                                var form = document.getElementById("form_comentario");
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", 'sesion_estudiante_id');
                                hiddenField.setAttribute("value", {{$sesion_estudiante->ID}});
                                form.appendChild(hiddenField);
                                form.submit();
                            }
                    </script>
                </div>
            </div>
        </div>
        <br>
    </div>
</form>
@else
<p>No subió ninguna práctica</p>
<br><br>
<div>
    <input type="submit" value="Volver a lista de Clases" onclick="volver();" class="btn btn-primary">
    <script>
        function volver() {
            window.location = "/auxiliar/clases";
        }
    </script>
</div>
@endif
@endsection