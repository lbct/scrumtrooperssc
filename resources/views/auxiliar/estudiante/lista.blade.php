@extends('layout')
@section('contenido')
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
<link href="{{asset('/css/table_test.css')}}" rel="stylesheet" id="bootstrap-css">
<div>
    <br>
    <br>
    <h2 class="pb-1">Lista de Estudiantes</h2>
</div>
<div class="ex1">
    <form action="{{route('auxiliar/clases')}}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="clase_id" value="{{$clase_id}}"/>
        <select class="form-control" id='sesiones_est' name='sesion_id' onchange="parentNode.submit();">
            @for($i=0;$i<sizeof($sesiones);$i++)
                <option value="{{$sesiones[$i]->ID}}" @if(($sesiones[$i]->ID)==$sesion_id) selected="selected" @endif>{{'Sesión #'.(sizeof($sesiones) - $i).':'}}</option>
            @endfor
        </select>
    </form>
</div>
    @if(sizeof($estudiantes) > 0)
    <table>
        <thead>
        <tr>
            <th scope="col">CódigoSis</th>    
            <th scope="col">Nombre(s)</th>
            <th scope="col">Apellidos</th>
            <th scope="col">E-Mail</th>
            <th scope="col">Asiste</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estudiantes as $estudiante)
        <tr>
            <td>{{$estudiante->CODIGO_SIS}}</th>
            <td>{{$estudiante->usuario->NOMBRE}}</td>
            <td>{{$estudiante->usuario->APELLIDO}}</td>
            <td>{{$estudiante->usuario->CORREO}}</td>
            <td>
                <form action="{{route('auxiliar/clases')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="clase_id" value="{{$clase_id}}"/>
                    <input type="hidden" name="sesion_id" value="{{$sesion_id}}"/>
                    <input type="hidden" name="estudiante_id" value="{{$estudiante->ID}}"/>
                    <input type="checkbox" name='asiste' value="1" onchange="parentNode.submit();"
                    {{$sesion_est = App\Models\SesionEstudiante::whereRaw('SESION_ID='.$sesion_id.' AND ESTUDIANTE_ID='.$estudiante->ID)->first()}}
                    @if($sesion_est != null && $sesion_est->ASISTENCIA_SESION == 1)
                        checked
                    @endif
                    >
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <h4>No tiene estudiantes inscritos en la clase</h4>
    @endif
    <br><br>
<div>
    <input type="submit" value="Volver a lista de Clases" onclick="volver();" class="btn btn-primary">
    <script>
        function volver()
        {
            window.location = "/auxiliar/clases/"+{{$id_gestion}};
        }
    </script>
</div>
@endsection