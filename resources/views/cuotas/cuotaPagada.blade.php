@extends('plantilla')
@section('cuerpo')
<h1>Cuota Pagada</h1>
<br>
<div class="alert alert-success aletarborrar" role="alert"><strong>La cuota ha sido pagada correctamente.</strong></div>
<h5><a href=" {{ route('cliente.index')}}" class="btn btn-primary" role="button">Listado de Clientes</a></h5>
@endsection