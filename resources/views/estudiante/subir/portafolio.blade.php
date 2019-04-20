@extends('layout')
@section('contenido')
<link href="{{asset('/css/upload.css')}}" rel="stylesheet" id="bootstrap-css">

    <div class="py-5 d-flex justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h3>Subir Archivos a Portafolio</h3>
            <form method="POST" action="#" enctype="multipart/form-data">
                <!-- COMPONENT START -->
                <div class="form-group">
                    <div class="input-group input-file" name="Fichier1">
                        <div>
                            <button class="btn btn-default btn-choose" type="button">
                                <label for="upload">Selecionar Archivo(s):</label>
                                <input type="file" style="display: none;" name="files[]" id="upload" multiple>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder='Selecciona tu Archivo' />
                        <span class="input-group-btn">
                                <button class="btn btn-warning btn-reset" type="button">Reset</button>
                        </span>
                    </div>
                </div>


                <!-- Drop Zone -->
                <h4>O Arrastra los Archivos</h4>
                <div class="upload-drop-zone" id="drop-zone">
                    Arrastra los Archivos que quieras Subir Aqui
                </div>

                <!-- COMPONENT END -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Subir Archivo</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>
                <p>Submit is disabled because it's not handle on this site
                <p>Input Reset or Input Choose can be omitted
                <p>Input Reset or Input Choose can be placed on left or right
                <p> Me dio flojera eliminar estos comentarios 
            </form>
        </div>
    </div>
    <script>   
        + function($) {
            'use strict';

            // UPLOAD CLASS DEFINITION
            // ======================

            var dropZone = document.getElementById('drop-zone');
            var uploadForm = document.getElementById('js-upload-form');

            var startUpload = function(files) {
                console.log(files)
            }

            uploadForm.addEventListener('submit', function(e) {
                var uploadFiles = document.getElementById('js-upload-files').files;
                e.preventDefault()

                startUpload(uploadFiles)
            })

            dropZone.ondrop = function(e) {
                e.preventDefault();
                this.className = 'upload-drop-zone';

                startUpload(e.dataTransfer.files)
            }

            dropZone.ondragover = function() {
                this.className = 'upload-drop-zone drop';
                return false;
            }

            dropZone.ondragleave = function() {
                this.className = 'upload-drop-zone';
                return false;
            }

        }(jQuery);
    </script>



  @endsection