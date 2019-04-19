@extends('layout')
@section('contenido')
<!-- AQUI EL CONTENIDO -->
<div>   
      <div class="container col-md-5 col-md-offset-5 ">
          <div class="row">
              <div class="panel panel-default">
                  <div>
                  <br><br>
                      <h3>Subir Guia Practica</h3>
                  </div>

                  <div>
                   <div id="drop_zone">Drop files here</div>
                     <output id="list"></output>

                   <script>
                   function handleFileSelect(evt) {
                   evt.stopPropagation();
                   evt.preventDefault();

                   var files = evt.dataTransfer.files; // FileList object.

                  // files is a FileList of File objects. List some properties.
                  var output = [];
                  for (var i = 0, f; f = files[i]; i++) {
                  output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                  '</li>');
                   } 
                   document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
                  } 

                 function handleDragOver(evt) {
                         evt.stopPropagation();
                         evt.preventDefault();
                         evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
                           }

                        // Setup the dnd listeners.
                      var dropZone = document.getElementById('drop_zone');
                     dropZone.addEventListener('dragover', handleDragOver, false);
                     dropZone.addEventListener('drop', handleFileSelect, false);
                    </script>
                  </div>

                           <div class="row">
                    
                                 <div class="col-sm-4">
                                  <input type="submit" value="Guardar" class="btn btn-primary" tabindex="7" style="margin:10px">
                                 </div>

                                 <div class="col-sm-4">
                                  <input type="submit" value="Cancelar" class="btn btn-primary" tabindex="7" style="margin:10px">
                                 </div>

                                 <div class="col-sm-4">
                                   <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Semana
                                      <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                         <li><a href="#">Semana 1</a></li>
                                         <li><a href="#">Semana 2</a></li>
                                         <li><a href="#">Semana 3</a></li>
                                         <li><a href="#">Semana 4</a></li>
                                         <li><a href="#">Semana 5</a></li>
                                         <li><a href="#">Semana 6</a></li>
                                         <li><a href="#">Semana 7</a></li>
                                         <li><a href="#">Semana 8</a></li>
                                         <li><a href="#">Semana 9</a></li>
                                         <li><a href="#">Semana 10</a></li>
                                         <li><a href="#">Semana 11</a></li>
                                         <li><a href="#">Semana 12</a></li>
                                         <li><a href="#">Semana 13</a></li>
                                         <li><a href="#">Semana 14</a></li>
                                         <li><a href="#">Semana 15</a></li>
                                        </ul>
                                     </div>
                                 </div>
                           </div>
                    </div>
               </div>
        </div>
  </div>
@endsection