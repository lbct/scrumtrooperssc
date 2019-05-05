@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h2>{{ $sesion->clase->grupoADocente->grupoDocente->materia->NOMBRE_MATERIA }}</h2>
        <center>
            <div class="ex1 form-group col-md-6">
              <select class="form-control" id="semana" name="semana" required>
                @foreach ($semanas as $semana)
                    <option value="{{$semana->ID}}" @if ($sesion->ID == $semana->ID) selected @endif">
                      Semana: {{$semana->SEMANA}}
                    </option>
                @endforeach
              </select>
            </div>
        </center>
        
        <h4>Archivos subidos:</h4>
            <p>
                @foreach($envios as $envio)
                    {{$envio->ARCHIVO}}
                @endforeach
            </p>
        <!-- Drop Zone -->
        <div id="alertas" role='alert'></div>
        <div class="form-group m-4">            
                <div class="dropzone" id="dropzoneFileUpload"></div>
        </div>

        <!-- COMPONENT END -->
        <div class="form-group">
            <button type="submit" class="m-3 btn btn-primary pull-right" id="enviarArchivo">Subir Archivo</button>
            <button type="submit" class="m-3 btn btn-danger" id="cancelar" onclick="window.location='/estudiante/subirPractica'">Cancelar</button>
        </div>
        
    </div>
</div>
<script>
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
       });
    }, 8000);
 </script>
<script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var token = "{{ Session::getToken() }}";
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        url: window.location.pathname,
        params: {
            _token: token
        },
        autoProcessQueue: false,
        maxFiles: 1,
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        
        init: function() {
            var submitButton = document.querySelector("#enviarArchivo")
                myDropzone = this;
            
            submitButton.addEventListener("click", function() {
                if (myDropzone.files.length == 0){
                    $alertas = document.getElementById('alertas');
                    $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-warning'>No existen archivos para subir.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
                }
                else
                    myDropzone.processQueue();
            });
            
            var cancelButton = document.querySelector("#cancelar")
                myDropzone = this;
            
            cancelButton.addEventListener("click", function() {
                myDropzone.removeAllFiles();
            });
            
            this.on("maxfilesexceeded", function(file){
                myDropzone.removeAllFiles();
                this.addFile(file);
                
                $alertas = document.getElementById('alertas');
                $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-warning'>Nuevo archivo para subir.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
            });
        },
        
        accept: function(file, done) {
            done();
        },
        
        success:function(file, response)
        {
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-success'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        },
        
        error:function(file, response)
        {
            myDropzone.removeAllFiles();
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-danger'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        }
    });
</script>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>
  var $semana = $('#semana');

  $semana.change(function() {
    $sesion_id = $semana.val()
    console.log($sesion_id);
    window.location.href = "/estudiante/subirPractica/"+$sesion_id;
  });
</script>

@endsection