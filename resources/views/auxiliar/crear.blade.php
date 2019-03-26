@extends('docente.plantilla')
@section('titulo', 'Nuevo Auxiliar')
@section('contenido_barra')
<h2>Docente</h2>
@endsection
@section('contenido')
<h3>Nuevo Auxiliar</h3>
<form method="POST" action="/docente/crearAuxiliar">
    {!! csrf_field() !!}
    @include('formulario')
    <!--<div>
        Código SIS
        <input type="text" name="codigo_sis" value="{{ old('codigo_sis') }}">
    </div>
    
    <div>
        Nombre
        <input type="text" name="nombre" value="{{ old('nombre') }}">
    </div>
    
    <div>
        Apellido
        <input type="text" name="apellido" value="{{ old('apellido') }}">
    </div>

    <div>
        Correo
        <input type="email" name="correo" value="{{ old('correo') }}">
    </div>
    
    <div>
        Sexo
        <select name="sexo">
            <option value ="M">Masculino</option>
            <option value ="F">Femenino</option>
        </select> 
    </div>
    
    <div>
        Telefono
        <input type="text" name="telefono" value="{{ old('telefono') }}">
    </div>
    
    <div>
        Carnet de Identidad
        <input type="text" name="ci" value="{{ old('ci') }}">
    </div>
    
    <div>
        Fecha de nacimiento:
        <input name="fecha_nacimiento" type="date">
    </div>

    <div>
        Contraseña
        <input type="password" name="contrasena">
    </div>

    <div>
        Confirma la contraseña
        <input type="password" name="confirmacion_contrasena">
    </div>

    <div>
        <button type="submit">Registrar</button>
    </div>-->
</form>
@endsection