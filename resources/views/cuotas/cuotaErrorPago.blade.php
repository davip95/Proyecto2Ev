@extends('plantilla')
@section('cuerpo')
<h1>Error Pago Cuota</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>No se ha podido realizar el pago de la cuota.</strong></div>
<h5><a href=" {{ route('cliente.index')}}" class="btn btn-primary" role="button">Listado de Clientes</a></h5>
@endsection