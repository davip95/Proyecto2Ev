@extends('plantilla')
@section('cuerpo')
<h1>Usuario {{$usuario['id']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Fecha Alta</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$usuario['id']}}</td>
            <td>{{$usuario['name']}}</td>
            <td>{{$usuario['password']}}</td>
            <td>{{$usuario['dni']}}</td>
            <td>{{$usuario['telefono']}}</td>
            <td>{{$usuario['direccion']}}</td>
            <td>{{$usuario->fechaalta->format('d/m/Y H:i')}}</td>
            <td>{{$usuario['tipo']}}</td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar el usuario antes de confirmarlo.</strong></div>
<h5><a href="{{ route('usuario.show', $usuario) }}" class="btn btn-success" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<form action="{{ route('usuario.destroy', $usuario) }}" method="post">
    {{-- @csrf --}}
    @method('delete')
    <button class="btn btn-danger" type="submit"><i class="bi bi-check-square"></i> Confirmar Borrado</button>
</form>
@endsection