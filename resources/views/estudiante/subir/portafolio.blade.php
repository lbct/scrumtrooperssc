@extends('layout')
@section('contenido')
<link href="{{asset('/css/upload.css')}}" rel="stylesheet" id="bootstrap-css">
<link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
<script src="{{asset('/js/dropzone.js')}}"></script>

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h3>Subir Archivos a Portafolio</h3>
    

        <!-- Drop Zone -->
        <div class="form-group m-4">            
            <form action="#" class="dropzone" id="dropzone">


            </form>
        </div>

        <!-- COMPONENT END -->
        <div class="form-group">
            <button type="submit" class="m-3 btn btn-primary pull-right">Subir Archivo</button>
            <button type="reset" class="m-3 btn btn-danger">Cancelar</button>
        </div>

    </div>

</div>




  @endsection