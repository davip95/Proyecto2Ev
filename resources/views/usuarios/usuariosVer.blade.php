@extends('plantilla')
@section('cuerpo')
<h1>Lista de usuarios</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Fecha Alta</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{$usuario->fechaalta->format('d/m/Y H:i')}}</td>
            <td>{{$usuario['name']}}</td>
            <td>{{$usuario['dni']}}</td>
            <td>{{$usuario['tipo']}}</td>
            <td>
                <a href="{{ route('usuario.show', $usuario) }}" class="btn btn-info" role="button">Detalles</a>
                <a href="{{ route('usuario.edit', $usuario) }}" class="btn btn-warning" role="button">Editar</a>
                <a href="{{ route('usuario.confirmarBorrado', $usuario) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$usuarios->links()}}
</div>
@endsection