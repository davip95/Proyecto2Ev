@extends('plantilla')
@section('cuerpo')
<h1>Remesa Mensual Agregada</h1>
<br>
<div class="alert alert-success aletarborrar" role="alert"><strong>La remesa mensual ha sido agregada correctamente a todos los clientes.</strong></div>
<h5><a href="{{ route('cliente.index') }}" class="btn btn-primary" role="button">Listado de Clientes</a></h5>
@endsection