<!--Vista de Horario de Estudiante-->
@extends('layout')
@section('contenido')
<br><br>
<div>
    <h3 class="pb-1">Horario</h3>
</div>
<br>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Hora</th>
            <th scope="col">Lunes</th>
            <th scope="col">Martes</th>
            <th scope="col">Miercoles</th>
            <th scope="col">Jueves</th>
            <th scope="col">Viernes</th>
            <th scope="col">Sabado</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>06:45/08:15</td>
            @foreach ($horario[0] as $clase)
                @if($clase != null)
                    <td>
                        <a>{{$clase->NOMBRE_MATERIA}}</a>
                        <a>{{$clase->NOMBRE_AULA}}</a>
                    </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>08:15/08:45</td>
            @foreach ($horario[1] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>09:45/11:15</td>
            @foreach ($horario[2] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>11:15/12:45</td>
            @foreach ($horario[3] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>12:45/14:15</td>
            @foreach ($horario[4] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>14:15/15:45</td>
            @foreach ($horario[5] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>15:45/17:15</td>
            @foreach ($horario[6] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>17:15/18:45</td>
            @foreach ($horario[7] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>18:45/20:15</td>
            @foreach ($horario[8] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
        <tr>
            <td>20:15/21:45</td>
            @foreach ($horario[9] as $clase)
                @if($clase != null)
                <td>
                    <a>{{$clase->NOMBRE_MATERIA}}</a>
                    <a>{{$clase->NOMBRE_AULA}}</a>
                </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    </tbody>
</table>




@endsection