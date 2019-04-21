@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Subir Archivos a Portafolio</h3>
    

        <!-- Drop Zone -->
        <div class="form-group m-4">            
                <div class="dropzone" id="dropzoneFileUpload"></div>
        </div>

        <!-- COMPONENT END -->
        <div class="form-group">
            <button type="submit" class="m-3 btn btn-primary pull-right">Subir Archivo</button>
            <button type="reset" class="m-3 btn btn-danger">Cancelar</button>
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
        }
    });
    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        accept: function(file, done) {

        },
    };
</script>



  @endsection