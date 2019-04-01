@extends('estudiante.plantilla')
@section('contenido_barra')
  <h2>Estudiante</h2>
@endsection
@section('contenido')
<!-- AQUI EL CONTENIDO :V-->

<link href="{{asset('css/bs-stepper.min.css')}}" rel="stylesheet">
@include('alertas')
@include('errores')
{!! csrf_field() !!}


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
                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger1">
                  <div class="form-group">
                    <label for="materia">Seleciona la Materia</label>
                    <select class="form-control" id="materia" value="{{ old('materia') }}">
                      <option value="1">Intro</option>
                      <option value="2">Elementos</option>
                      <option value="3">Taller de Progra</option>
                      <option value="4">TIS :(</option>
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.next()" type="button">Siguiente</button>
                </div>
                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="steppertrigger2">
                  <div class="form-group">
                    <label for="docente">Seleciona tu Docente</label>
                    <select class="form-control" id="docente" value="{{ old('docente') }}">
                      <option value="1">Leticia</option>
                      <option value="2">Vladimir</option>
                      <option value="3">Flores</option>
                      <option value="4">TIS :(</option>
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.previous()" type="button">Anterior</button>
                  <button class="btn btn-primary" onclick="stepper.next()" type="button">Siguiente</button>
                </div>
                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="steppertrigger3">
                  <div class="form-group">
                    <label for="horario">Seleciona un Horario</label>
                    <select class="form-control" id="horario">
                      <option value="1">Lunes 6'45"</option>
                      <option value="2">Lunes 6:45</option>
                      <option value="3">Lunes 00:00</option>
                      <option value="4">TIS :(</option>
                    </select>
                  </div>
                  <button class="btn btn-primary" onclick="stepper.previous()" type="button">Anterior</button>
                  <button class="btn btn-primary" onclick="stepper.next()" type="button">Siguiente</button>
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
        linear: false
      })
      /*
      stepperNode.addEventListener('show.bs-stepper', function (event) {
        //console.warn('show.bs-stepper', event)
      })
      stepperNode.addEventListener('shown.bs-stepper', function (event) {
        //console.warn('shown.bs-stepper', event)
      })
      var stepper2 = new Stepper(document.querySelector('#stepper2'), {
          linear: false,
          animation: true
        })
      var stepper3 = new Stepper(document.querySelector('#stepper3'), {
          animation: true
        })*/
</script>

@endsection