@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h2>{{ $sesion->clase->grupoADocente->grupoDocente->materia->NOMBRE_MATERIA }}</h2>
        <h4>Semana: {{ $sesion->SEMANA }}</h4>
        
        <h4>Archivos subidos:</h4>
            <p>
                @foreach($envios as $envio)
                    {{$envio->ARCHIVO}}
                @endforeach
            </p>
        <!-- Drop Zone -->
        <div id="alertas"></div>
        <div class="form-group m-4">            
                <div class="dropzone" id="dropzoneFileUpload"></div>
        </div>

        <!-- COMPONENT END -->
        <div class="form-group">
            <button type="submit" class="m-3 btn btn-primary pull-right" id="enviarArchivo">Subir Archivo</button>
            <button type="submit" class="m-3 btn btn-danger" id="cancelar">Cancelar</button>
        </div>
        
    </div>
</div>
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
                $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-warning'>Nuevo archivo para subir.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
            });
        },
        
        accept: function(file, done) {
            done();
        },
        
        success:function(file, response)
        {
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-success'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        },
        
        error:function(file, response)
        {
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-danger'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        }
    });
</script>

@endsection