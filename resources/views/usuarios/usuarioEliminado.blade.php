@extends('plantilla')
@section('cuerpo')
<h1>Usuario {{$id}} Eliminado</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>El usuario ha sido eliminado correctamente.</strong></div>
<h5><a href=" {{ route('usuario.index')}}" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>
@endsection