  <div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
      <link href="{{asset('/css/campos.css')}}" rel="stylesheet" id="bootstrap-css">
      <div class="container col-md-5 col-md-offset-5 ">
          <div class="row">
              <div class="panel panel-default">
                  <div>
                      <br><br>
                          <div class="form-row">
                              <div class="col-md-6 mb-10">
                                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre(s)" tabindex="1" value="{{ old('nombre') }}">
                              </div>
                              <div class="col-md-6 mb-4">
                                  <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos" tabindex="2" value="{{ old('apellido') }}">
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-md-12 mb-4">
                                  <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" tabindex="3" value="{{ old('username') }}">
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-md-12 mb-4">
                                  <input type="email" name="correo" id="correo" class="form-control input-lg" placeholder="name@example.com" tabindex="3" value="{{ old('correo') }}">
                              </div>
                          </div>
                  </div>
                  <div>
                      <div class=" form-row">
                          <div class="col-md-6 mb-3">
                              <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" value="{{ old('password') }}">
                          </div>
                          <div class="col-md-6 mb-5">
                              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirme la contraseña" value="{{ old('password_confirmation') }}">
                          </div>
                      </div>
                      <div>
                          <div class="form-group row justify-content-center">
                              <div class="column2"><input type="submit" value="Registrar" class="btn btn-primary" tabindex="7">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>