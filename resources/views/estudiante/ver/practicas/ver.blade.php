@extends('layout')
@section('contenido')
<!-- Vista de verPracticas de Estudiante -->

<div class="py-5 d-flex justify-content-center">
    <div class="col-md-12 col-md-offset-2">
      <h3>Practicas</h3>
      <br>
      @if(sizeof($practicas) > 0)
        <table>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Semana</th>
                    <th scope="col">Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($practicas as $practica)
                <tr>
                    <td>#{{$practica->SEMANA}}</td>
                    <td>
                      <a href="/descargar/guia/{{$practica->ARCHIVO}}" class="btn btn-info">{{$practica->ARCHIVO}}</a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      @else
      <p>No tiene practicas para esta materia</p>
      @endif
    </div>
  </form>
</div>

@endsection