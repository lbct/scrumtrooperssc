@extends('layout')
@section('contenido')

<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Subir Práctica</h3>
        <br>
        <form id="form_clase" action="{{route('docente/subirPractica/confirmar')}}" method="POST">
            {!! csrf_field() !!}
            <!-- Drop Zone -->
            <input type="hidden" name="ubicacion_guia_practica" id="guia_practica_id"/>
            <input type="hidden" id="grupo_a_docente_id" name="grupo_a_docente_id" value="{{$grupo_a_docente_id}}"/>
            <input type="hidden" name="auxiliar_id" value="{{$auxiliar_id}}"/>
            <input type="hidden" name="gestion_id" value="{{$gestion_id}}"/>
            <center>
                <div class="ex1 form-group col-md-6">
                    <select id="semana_valor" name="semana_valor" class="form-control">
                        @for($i=1;$i<=$semana_valor;$i++)
                        <option value="{{$i}}" @if($i==$semana_valor) selected="selected" @endif>{{'Semana '.$i}}</option>
                        @endfor
                    </select>
                </div>
                <div id="practica_actual" class="ex1 form-group col-md-6"></div>
            </center>
            <br>
            <div id="alertas" role='alert'></div>
            <div class="form-group m-4" id="dropzone">            
                    <div class="dropzone" id="dropzoneFileUpload"></div>
            </div>
        </form>
        <div class="form-group">
            <button class="m-3 btn btn-primary pull-right" id="enviarArchivo">Subir Archivo</button>
            <button class="m-3 btn btn-danger" id="cancelar" onclick="window.location='/docente/subirPractica'">Cancelar</button>
        </div>
    </div>

</div>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
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
        url: "/docente/subirPractica/subir",
        autoProcessQueue: false,
        maxFiles: 1,
        maxFilesize: 5,
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
        success: function (file) {
            var guia_id = document.getElementById("guia_practica_id");
            guia_id.setAttribute("value", "{{$nombre_archivo}}."+file.upload.filename.split('.').pop());
            var form = document.getElementById("form_clase");
            form.submit();
        },
        error:function(file, response)
        {
            myDropzone.removeAllFiles();
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message' role='alert'><p class='alert alert-danger'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
        },
        params: {
            _token: token,
            nombre_archivo: "{{$nombre_archivo}}"
        }
    });
    
    function borrarArchivos(){
        myDropzone.removeAllFiles(true);
        var guia_id = document.getElementById("guia_practica_id");
        guia_id.setAttribute("value", "");
    }
    
    $("#semana_valor").change(function() {
        var semana=$("#semana_valor").val();
        var grupo_a_docente_id=$("#grupo_a_docente_id").val();
        
        $.get("/docente/practicaSemana/"+grupo_a_docente_id+"/"+semana, function( data ) {
            $practica_actual = document.getElementById('practica_actual');
            if(data != null)
                $practica_actual.innerHTML = "<a href='/descargar/guia/"+data+"' class='btn btn-info'>"+data+"</a>";
        });
        
    });
</script>
@endsection