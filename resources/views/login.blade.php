<link href="{{asset('/css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  
  <!------ Include the above in your HEAD tag ---------->
<form>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="{{asset('img/user.png')}}" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form>
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="CodigoSis">
        <input type="password" id="password" class="fadeIn third" name="login" placeholder="Contraseña">
        <input type="submit" class="fadeIn fourth" value="Iniciar Sesion">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a href="registro">Crear Cuenta?</a>
      </div>

    </div>
  </div>
</form>