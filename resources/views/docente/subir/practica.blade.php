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
<<<<<<< HEAD
            <input type="hidden" name="clase_id" value="{{$clase_id}}"/>
            <input type="hidden" name="semana_valor" value="{{$semana_valor}}"/>
            <input type="hidden" name="auxiliar_id" value="{{$auxiliar_id}}"/>
            <input type="hidden" name="gestion_id" value="{{$gestion_id}}"/>
            <div class="form-group m-4" id="dropzone">            
                    <div class="dropzone" id="dropzoneFileUpload"></div>
            </div>

            <!-- COMPONENT END -->
            <div class="form-group">
                <button type="submit" class="m-3 btn btn-primary pull-right">Confirmar</button>
                <button type="reset" onclick="borrarArchivos();" class="m-3 btn btn-danger">Cancelar</button>
            </div>
        </form>
=======
            <input type="hidden" name="grupo_a_docente_id" value="{{$grupo_a_docente_id}}"/>
            <input type="hidden" name="auxiliar_id" value="{{$auxiliar_id}}"/>
            <input type="hidden" name="gestion_id" value="{{$gestion_id}}"/>
            <center>
                <div class="ex1 form-group col-md-6">
                    <select name="semana_valor" class="form-control">
                        @for($i=1;$i<=$semana_valor;$i++)
                        <option value="{{$i}}" @if($i==$semana_valor) selected="selected" @endif>{{'Semana '.$i}}</option>
                        @endfor
                    </select>
                </div>
            </center>
            <br>
            <div id="alertas"></div>
            <div class="form-group m-4" id="dropzone">            
                    <div class="dropzone" id="dropzoneFileUpload"></div>
            </div>
        </form>
        <div class="form-group">
            <button class="m-3 btn btn-primary pull-right" id="enviarArchivo">Confirmar</button>
            <button type="reset"  class="m-3 btn btn-danger" id="cancelar">Cancelar</button>
        </div>
>>>>>>> origin
    </div>

</div>
<script type="text/javascript">
    var baseUrl = "{{ url('/') }}";
    var token = "{{ Session::getToken() }}";
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        url: "/docente/subirPractica/subir",
<<<<<<< HEAD
        maxFiles: 1,
        maxFilesize: 5,
        addRemoveLinks: true,
        accept: function(file, done) {
            
=======
        autoProcessQueue: false,
        maxFiles: 1,
        maxFilesize: 5,
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
>>>>>>> origin
            done();
        },
        success: function (file) {
            var guia_id = document.getElementById("guia_practica_id");
            guia_id.setAttribute("value", "uploads/{{$nombre_archivo}}."+file.upload.filename.split('.').pop());
<<<<<<< HEAD
=======
            var form = document.getElementById("form_clase");
            form.submit();
        },
        error:function(file, response)
        {
            myDropzone.removeAllFiles();
            $alertas = document.getElementById('alertas');
            $alertas.innerHTML = "<div class='flash-message'><p class='alert alert-danger'>"+response+"<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></p></div>";
>>>>>>> origin
        },
        params: {
            _token: token,
            nombre_archivo: "{{$nombre_archivo}}"
        }
    });
    function borrarArchivos(){
        myDropzone.removeAllFiles(true);
<<<<<<< HEAD
=======
        var guia_id = document.getElementById("guia_practica_id");
        guia_id.setAttribute("value", "");
>>>>>>> origin
    }
</script>
@endsection