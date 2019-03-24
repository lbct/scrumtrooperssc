<form method="POST" action="/estudiante/editar">
    {!! csrf_field() !!}
    <div>
        Nombre
        <input type="text" name="nombre" value="{{ $usuario->NOMBRE }}">
    </div>
    
    <div>
        Apellido
        <input type="text" name="apellido" value="{{ $usuario->APELLIDO }}">
    </div>

    <div>
        Correo
        <input type="email" name="correo" value="{{ $usuario->CORREO }}">
    </div>
    
    <div>
        Sexo
        <select name="sexo" >
            <option value ="M"@if($usuario->SEXO == 'M') selected @endif>Masculino</option>
            <option value ="F"@if($usuario->SEXO == 'F') selected @endif>Femenino</option>
        </select> 
    </div>
    
    <div>
        Telefono
        <input type="text" name="telefono" value="{{ $usuario->TELEFONO }}">
    </div>
    
    <div>
        Carnet de Identidad
        <input type="text" name="ci" value="{{ $usuario->CI }}">
    </div>
    
    <div>
        Fecha de nacimiento:
        <input name="fecha_nacimiento" type="date" value="{{ $usuario->FECHA_NACIMIENTO }}">
    </div>

    <div>
        Nueva Contraseña
        <input type="password" name="contrasena">
    </div>

    <div>
        Confirma la Nueva Contraseña
        <input type="password" name="confirmacion_contrasena">
    </div>

    <div>
        <button type="submit">Editar</button>
    </div>
</form>