@extends('plantilla')
@section('cuerpo')
<h1>Tarea {{$id}} Eliminada</h1>
<br>
<div class="alert alert-danger aletarborrar" role="alert"><strong>La tarea ha sido eliminada correctamente.</strong></div>
<h5><a href="{{ route('tarea.index') }}" class="btn btn-primary" role="button">Ir a Listado</a></h5>
@endsection