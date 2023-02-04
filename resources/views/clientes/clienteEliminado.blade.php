@extends('plantilla')
@section('cuerpo')
<h1>Cliente {{$id}} Eliminado</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>El cliente ha sido eliminado correctamente.</strong></div>
<h5><a href=" {{ route('cliente.index')}}" class="btn btn-primary" role="button">Listado de Clientes</a></h5>
@endsection