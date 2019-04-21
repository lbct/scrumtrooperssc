@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Semana 1:</h3>

        <!-- Drop Zone -->
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
        url: "/estudiante/subirArchivo",
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
                alert("¡Archivo Reemplazado!");
            });
        },
        
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
    });
</script>

@endsection