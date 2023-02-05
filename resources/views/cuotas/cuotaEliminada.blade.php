@extends('plantilla')
@section('cuerpo')
<h1>Cuota {{$id}} Eliminada</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>La cuota ha sido eliminado correctamente.</strong></div>
<h5><a href=" {{ route('cliente.index')}}" class="btn btn-primary" role="button">Listado de Clientes</a></h5>
@endsection