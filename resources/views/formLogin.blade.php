<form method="POST" action="/login">
    {!! csrf_field() !!}

    <div>
        Codigo SIS
        <input type="text" name="codigo_sis" value="{{ old('codigo_sis') }}">
    </div>

    <div>
        Contraseña
        <input type="password" name="contrasena" id="contrasena">
    </div>

    <div>
        <input type="checkbox" name="remember"> Recordarme
    </div>

    <div>
        <button type="submit">Ingresar</button>
    </div>
</form>