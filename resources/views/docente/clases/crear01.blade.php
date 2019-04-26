@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <form id="form_clase" action="/docente/clases/crear/aula" method="POST">
                {!! csrf_field() !!}
                <h3>Seleccione un Horario</h3>
                <br>
                <br>
                @if(sizeof($horarios) > 0)
                <table>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Horario</th>
                            <th scope="col">Lunes</th>
                            <th scope="col">Martes</th>
                            <th scope="col">Miercoles</th>
                            <th scope="col">Jueves</th>
                            <th scope="col">Viernes</th>
                            <th scope="col">Sábado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                        <tr>
                            <td>{{$horario->HORA_INICIO}} <br> {{$horario->HORA_FIN}}</td>
                            @for ($i = 1; $i < 7; $i++)
                                @if ($horarios_disponibles[$horario->ID][$i]>0)
                                    <td class="select_td" onclick="submit({{$horario->ID}},{{$i}})">{{$horarios_disponibles[$horario->ID][$i]}} aula(s)<br>disponibles</td>
                                @else
                                    <td>No disponible</td>
                                @endif
                            @endfor
                        </tr>
                        <script>
                            function submit(horario_id, dia) {
                                console.log(horario_id, dia);
                                var form = document.getElementById("form_clase");
                                
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", 'horario_id');
                                hiddenField.setAttribute("value", horario_id);
                                form.appendChild(hiddenField);
                                
                                var hiddenField = document.createElement("input");
                                hiddenField.setAttribute("type", "hidden");
                                hiddenField.setAttribute("name", 'dia');
                                hiddenField.setAttribute("value", dia);
                                form.appendChild(hiddenField);
                                
                                form.submit();
                            }
                        </script>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>No hay horarios disponibles/p>
                @endif
            <input type="hidden" id="grupo_docente_id" name="grupo_docente_id" value="{{$grupo_docente}}">
            <input type="button" class="m-3 btn btn-danger" value="Cancelar" onclick="window.location='/docente/clases/crear'">
        </form>
    </div>
</div>
@endsection