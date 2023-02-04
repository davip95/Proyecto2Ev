@extends('plantilla')
@section('cuerpo')
<h1>Detalles Usuario</h1>
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
            <th>Acciones</th>
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
            <td>
                <a href="{{ route('usuario.edit', $usuario) }}" class="btn btn-warning" role="button">Editar</a>
                <a href="{{ route('usuario.confirmarBorrado', $usuario) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="{{ route('usuario.index') }}" class="btn btn-primary" role="button">Ir a Listado de Usuarios</a></h5>

@endsection