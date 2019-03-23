<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div>
        Nombre
        <input type="text" name="nombre" value="{{ old('nombre') }}">
    </div>

    <div>
        Email
        <input type="email" name="correo" value="{{ old('correo') }}">
    </div>

    <div>
        Contraseña
        <input type="contrasena" name="contrasena">
    </div>

    <div>
        Confirm Password
        <input type="contrasena" name="contrasena_confirmation">
    </div>

    <div>
        <button type="submit">Registrar</button>
    </div>
</form>