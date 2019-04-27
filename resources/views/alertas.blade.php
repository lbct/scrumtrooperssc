<!-- Muestra mensajes de Alerta -->
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="flash-message" id="alertas">
   <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
</div>
@endif
@endforeach