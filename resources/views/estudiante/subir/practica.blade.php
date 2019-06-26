<meta name="csrf-token" content="{{ csrf_token() }}" />
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
            <div id="archivos_subidos">
                @foreach($envios as $envio)
                <div id="envio_{{$envio->ID}}">
                    {{$envio->ARCHIVO}}
                    <button class="btn btn-danger" onclick="eliminar_archivo({{$envio->ID}})" type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                @endforeach
            </div>
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

<div class="modal fade danger" id="eliminar_practica_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          Esto borrará permanente el archivo.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="confirmar_eliminar_archivo">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
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
                if (myDropzone.files.length == 0) {
                    $alertas = document.getElementById('alertas');
                    $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-warning'>No existen archivos para subir.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
                } else
                    myDropzone.processQueue();
            });

            var cancelButton = document.querySelector("#cancelar")
            myDropzone = this;

            cancelButton.addEventListener("click", function() {
                myDropzone.removeAllFiles();
            });

            this.on("maxfilesexceeded", function(file) {
                myDropzone.removeAllFiles();
                this.addFile(file);

                $alertas = document.getElementById('alertas');
                $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-warning'>Nuevo archivo para subir.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
            });
        },

        accept: function(file, done) {
            done();
        },

        success: function(file, response) {
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-success'>Se ha subido correctamente el archivo<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
            
            $archivos_subidos = document.getElementById('archivos_subidos');
            $archivos_subidos.innerHTML =  $archivos_subidos.innerHTML+"<div id='envio_"+response.ID+"'>"+response.ARCHIVO+" <button class='btn btn-danger' onclick='eliminar_archivo("+response.ID+")' type='button'><i class='fas fa-trash'></i></button></div>";
        },

        error: function(file, response) {
            myDropzone.removeAllFiles();
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-danger'>" + response + "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        }
    });
</script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>
    var $semana = $('#semana');

    $semana.change(function() {
        $sesion_id = $semana.val()
        console.log($sesion_id);
        window.location.href = "/estudiante/subirPractica/" + $sesion_id;
    });
    
    function eliminar_archivo($id){
        $('#eliminar_practica_modal').modal('show');
        $('#confirmar_eliminar_archivo').attr('onclick', 'confirmar_eliminar_archivo('+$id+')');
    }
    
    function confirmar_eliminar_archivo($id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            data: {
                _token: CSRF_TOKEN,
                archivo_id: $id,
            },
            url: '/estudiante/eliminarPractica',
            type: 'DELETE',
            success: function(result) {
                if(result == "success")
                {
                    var $envio = $('#envio_'+$id);
                    $envio.remove();
                    $('#eliminar_practica_modal').modal('hide');
                }
            }
        });
    }
</script>

@endsection