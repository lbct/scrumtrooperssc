@extends('estudiante.plantilla')
@section('contenido_barra')
  <h2>Estudiante</h2>
@endsection
@section('contenido')
<!-- AQUI EL CONTENIDO :V-->

<link href="{{asset('css/bs-stepper.min.css')}}" rel="stylesheet">

<div class="container flex-grow-1 flex-shrink-0 py-5">
        <div class="mb-5 p-4 bg-white shadow-sm">
          <h3>Linear stepper</h3>
          <div id="stepper1" class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
              <div class="step" data-target="#test-l-1">
                <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">Email</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Password</span>
                </button>
              </div>
              <div class="bs-stepper-line"></div>
              <div class="step" data-target="#test-l-3">
                <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Validate</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <form  method="POST" action="/inscripcion">
                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                </div>
                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <button class="btn btn-primary" onclick="stepper1.previous()">Previous</button>
                  <button class="btn btn-primary" onclick="stepper1.next()">Next</button>
                </div>
                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane text-center" aria-labelledby="stepper1trigger3">
                  <button class="btn btn-primary mt-5" onclick="stepper1.previous()">Previous</button>
                  <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
</div>

<script src="{{asset('js/bs-stepper.min.js')}}"></script>
<script>
      var stepper1Node = document.querySelector('#stepper1')
      var stepper1 = new Stepper(document.querySelector('#stepper1'))
      stepper1Node.addEventListener('show.bs-stepper', function (event) {
        console.warn('show.bs-stepper', event)
      })
      stepper1Node.addEventListener('shown.bs-stepper', function (event) {
        console.warn('shown.bs-stepper', event)
      })
      var stepper2 = new Stepper(document.querySelector('#stepper2'), {
          linear: false,
          animation: true
        })
      var stepper3 = new Stepper(document.querySelector('#stepper3'), {
          animation: true
        })
</script>

@endsection