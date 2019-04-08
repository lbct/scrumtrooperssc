<!-- Vista de Editar Constraseña de Usuario-->
@extends('layout')
@section('contenido')
<br><br>
<h3>Cambiar contraseña Docente</h3>
<form method="POST" action="{{'/administrador/editarDocente/'.$id_usuario.'/cambiarClave'}}">
<link href="{{asset('/css/campos_gestion.css')}}" rel="stylesheet" id="bootstrap-css">
{!! csrf_field() !!}
    <div>
        <div class="ex1">
            <input type="password" name="password" placeholder="Contraseña">
        </div>
        <div class="ex2">
            <input type="password" name="password_confirmation" placeholder="Confirme la contraseña">
        </div>
        <div>
            <input type="button" value="Volver Atras" onclick="back({{$id_usuario}});" class="btn btn-primary"/>
            <input type="submit" value="Cambiar contraseña" class="btn btn-primary" />
            <script>
            function back(id_usuario)
            {
                window.location = "/administrador/editarDocente/"+id_usuario;
            }
        </script>
        </div>
    </div>
</form>
@endsection