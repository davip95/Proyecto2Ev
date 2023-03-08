@extends('plantilla')
@section('cuerpo')
<h1>Tipos de Cambio</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Moneda</th>
            <th>Tipo de cambio respecto a €</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($monedas as $moneda)
        <tr>
            <td>{{$moneda->iso_moneda}}</td>
            <td>{{$moneda->cambio}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$monedas->links()}}
</div>
@endsection