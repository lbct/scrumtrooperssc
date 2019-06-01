<!-- Muestra mensajes de Alerta -->
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="flash-message" id="alertas" role="alert">
   <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
</div>
<script>
   window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
         $(this).remove(); 
      });
   }, 8000);
</script>
@endif
@endforeach