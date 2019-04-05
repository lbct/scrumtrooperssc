<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('estudiante.plantilla')
@section('contenido_barra')
  <h2>Estudiante</h2>
@endsection
@section('contenido')
<!-- AQUI EL CONTENIDO :V-->

<link href="{{asset('css/bs-stepper.min.css')}}" rel="stylesheet">
@include('alertas')
@include('errores')

<div class="container flex-grow-1 flex-shrink-0 py-5">
        <div class="mb-5 p-4">
          <h3>Formulario de Inscripcion</h3>
          <div id="stepper" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
              <div class="step" data-target="#test-l-1">
                <button type="button" class="step-trigger" role="tab" id="steppertrigger1" aria-controls="test-l-1">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Materia</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="step-trigger" role="tab" id="steppertrigger2" aria-controls="test-l-2">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Docente</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-3">
                <button type="button" class="step-trigger" role="tab" id="steppertrigger3" aria-controls="test-l-3">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Horario</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-4">
                <button type="button" class="step-trigger" role="tab" id="steppertrigger4" aria-controls="test-l-4">
                  <span class="bs-stepper-circle">4</span>
                  <span class="bs-stepper-label">Verificacion</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <form method="POST" action="/estudiante/inscripcion">
                {!! csrf_field() !!}
                <input type="hidden" id="paso" name="paso" value=1>
                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger1">
                  <div class="form-group">
                    <label for="materia">Seleciona la Materia</label>
                    <select class="form-control" id="materia" value="{{ old('materia') }}">
                      @foreach ($materias as $materia)
                        <option value={{$materia->ID}}>{{$materia->NOMBRE_MATERIA}}</option>
                      @endforeach
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.next();fijarPaso(2);getDocentes();" type="button">Siguiente</button>
                </div>
                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger2">
                  <div class="form-group">
                    <label for="docente">Seleciona tu Docente</label>
                    <select class="form-control" id="docente" value="{{ old('docente') }}">
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.previous()" type="button">Anterior</button>
                  <button class="btn btn-primary" onclick="stepper.next();fijarPaso(3);getHorarios();" type="button">Siguiente</button>
                </div>
                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="steppertrigger3">
                  <div class="form-group">
                    <label for="horario">Seleciona un Horario</label>
                    <select class="form-control" id="horario" name="horario">
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.previous()" type="button">Anterior</button>
                  <button class="btn btn-primary" onclick="stepper.next();fijarPaso(4);verificacion()" type="button">Siguiente</button>
                </div>
                <div id="test-l-4" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="steppertrigger4">
                  <div class="form-group">
                      <label for="verficar_materia">Materia</label>
                      <input type="text" class="form-control" id="verificar_materia" value="Materia Selecionada" disabled>
                      <label for="verficar_docente">Docente</label>
                      <input type="text" class="form-control" id="verificar_docente" value="Docente Selecionado" disabled>
                      <label for="verficar_horario">Horario</label>
                      <input type="text" class="form-control" id="verificar_horario" value="Horario Selecionada" disabled>
                  </div>
                  <button class="btn btn-primary mt-5" onclick="stepper.previous()" type="button">Anterior</button>
                  <button type="submit" class="btn btn-primary mt-5">Inscribirse</button>
                </div>
              </form>
            </div>
          </div>
        </div>
</div>

<script src="{{asset('js/bs-stepper.min.js')}}"></script>
<script>
      //var stepperNode = document.querySelector('#stepper')
      var stepper = new Stepper(document.querySelector('#stepper'), {
        linear: true
      })
      
      function fijarPaso(paso) {
          if(paso < 1 || paso > 4)
            paso = 1;
          
          document.getElementById('paso').value = paso;
      }
    
      function getDocentes() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          
            $.ajax({
                url: '/estudiante/inscripcion',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    paso: document.getElementById('paso').value,
                    materia: document.getElementById('materia').value
                },
                dataType: 'JSON',
                success: function (docentes) {
                    selectDocente   = document.getElementById('docente');
                    opcionesDocente = "";
                    
                    docentes.forEach(function(docente) {
                        opcionesDocente += '<option value='+docente.ID+'>'+docente.NOMBRE+' '+docente.APELLIDO+'</option>';
                    });
                    
                    selectDocente.innerHTML = opcionesDocente;
                }
            });
      }
    
      function getHorarios() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          
            $.ajax({
                url: '/estudiante/inscripcion',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    paso: document.getElementById('paso').value,
                    docente: document.getElementById('docente').value
                },
                dataType: 'JSON',
                success: function (horarios) {
                    horario   = document.getElementById('horario');
                    opcionesHorario = "";
                    
                    horarios.forEach(function(horario) {
                        dia = "";
                        switch (horario.DIA) {
                          case 1:
                            dia = "Lunes";
                            break;
                          case 2:
                            dia = "Martes";
                            break;
                          case 3:
                            dia = "Miercoles";
                            break;
                          case 4:
                            dia = "Jueves";
                            break;
                          case 5:
                            dia = "Viernes";
                            break;
                          case 6:
                            dia = "Sábado";
                            break;
                        }
                        
                        opcionesHorario += '<option value='+horario.ID+'>'+dia+' - '+horario.HORA_INICIO+' / '+horario.HORA_FIN+' - '+horario.NOMBRE_AULA+'</option>';
                        
                        
                    });
                    
                    horario.innerHTML = opcionesHorario;
                }
            });
      }
    
      function verificacion() {
          document.getElementById('verificar_materia').value = $("#materia option:selected").text();
          document.getElementById('verificar_docente').value = $("#docente option:selected").text();
          document.getElementById('verificar_horario').value = $("#horario option:selected").text();
      }
</script>

@endsection