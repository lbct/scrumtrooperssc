<!-- Vista de Lista de Estudiantes de una Clase -->
@extends('layout')
@section('contenido')
<div>
    <br>
    <br>
    <h3 class="pb-1">Lista de Estudiantes</h3>
    <br>
</div>
<div>       
<center>
    <div class="form-group col-md-6">
        <form action="{{route('auxiliar/clases')}}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="clase_id" value="{{$clase_id}}" />
            <select class="form-control" id='sesiones_est' name='sesion_id' onchange="parentNode.submit();">
                @for($i=0;$i<sizeof($sesiones);$i++) <option value="{{$sesiones[$i]->ID}}" @if(($sesiones[$i]->ID)==$sesion_id) selected="selected" @endif>{{'Sesión #'.(sizeof($sesiones) - $i).':'}}</option>
                    @endfor
            </select>
        </form>
    </div>
</center>
    
</div>
<br>
@if(sizeof($estudiantes) > 0)
<table>
    <thead>
        <tr>
            <th scope="col">CódigoSis</th>
            <th scope="col">Nombre(s)</th>
            <th scope="col">Apellidos</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Práctica</th>
            <th scope="col">Asiste</th>
        </tr>
    </thead>
    <tbody>
        @foreach($estudiantes as $estudiante)
        <input type="hidden" value="{{$sesion_est = App\Models\SesionEstudiante::whereRaw('SESION_ID='.$sesion_id.' AND ESTUDIANTE_ID='.$estudiante->ID)->first()}}"/>
        <tr>
            <td>{{$estudiante->CODIGO_SIS}}</th>
            <td>{{$estudiante->usuario->NOMBRE}}</td>
            <td>{{$estudiante->usuario->APELLIDO}}</td>
            <td>{{$estudiante->usuario->CORREO}}</td>
            <td>
                    <form id="form_estudiante" action="{{route('auxiliar/clases/estudiante')}}" method="POST">
                        {!! csrf_field() !!}
                        @if($sesion_est != null && App\Models\EnvioPractica::where('SESION_ESTUDIANTE_ID', $sesion_est->ID)->first() != null)
                            <input type="button" class="btn btn-primary" value="Comentar práctica" onclick="submitPractica();">
                            <script>
                                function submitPractica() {
                                    var form = document.getElementById("form_estudiante");
                                    var hiddenField = document.createElement("input");
                                    hiddenField.setAttribute("type", "hidden");
                                    hiddenField.setAttribute("name", 'estudiante_id');
                                    hiddenField.setAttribute("value", {{$estudiante->ID}});
                                    form.appendChild(hiddenField);
                
                                    var hiddenField2 = document.createElement("input");
                                    hiddenField2.setAttribute("type", "hidden");
                                    hiddenField2.setAttribute("name", 'sesion_id');
                                    hiddenField2.setAttribute("value", {{$sesion_id}});
                                    form.appendChild(hiddenField2);
                                    form.submit();
                                }
                            </script>
                        @else
                            Sin práctica
                        @endif
                    </form>
                </td>
            <td>
                <form id="form_check" action="{{route('auxiliar/clases')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="clase_id" value="{{$clase_id}}" />
                    <input type="hidden" name="sesion_id" value="{{$sesion_id}}" />
                    <input type="hidden" name="estudiante_id" value="{{$estudiante->ID}}" />
                    <input type="checkbox" name='asiste' value="1" onchange="submit();" @if($sesion_est !=null && $sesion_est->ASISTENCIA_SESION == 1)
                    checked
                    @endif
                    >
                    <script>
                        function submit() {
                            var form = document.getElementById("form_check");
                            form.submit();
                        }
                    </script>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No tiene estudiantes inscritos en la clase</p>
@endif
<br><br>
<div>
    <input type="submit" value="Volver a lista de Clases" onclick="volver({{$id_gestion}});" class="btn btn-primary">
    <script>
        function volver(id_gestion) {
            window.location = "/auxiliar/clases/" + id_gestion;
        }
    </script>
</div>
@endsection