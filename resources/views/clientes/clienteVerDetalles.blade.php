@extends('plantilla')
@section('cuerpo')
<h1>Detalles Cliente</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Cliente</th>
            <th>CIF</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Cuenta Corriente</th>
            <th>País</th>
            <th>Moneda</th>
            <th>Importe Mensual</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$cliente['id']}}</td>
            <td>{{$cliente['cif']}}</td>
            <td>{{$cliente['nombre']}}</td>
            <td>{{$cliente['telefono']}}</td>
            <td>{{$cliente['correo']}}</td>
            <td>{{$cliente['cuentacorriente']}}</td>
            <td>{{$cliente['pais']}}</td>
            <td>{{$cliente['moneda']}}</td>
            <td>{{$cliente['importemensual']}}</td>
        </tr>
    </tbody>
</table>
<h5>
    <a href="{{ route('cuota.listarCuotasCliente', $cliente) }}" class="btn btn-secondary" role="button">Cuotas</a>
    &nbsp;&nbsp;
    <a href="{{ route('cliente.index') }}" class="btn btn-primary" role="button">Listado de Clientes</a>
    &nbsp;&nbsp;
    <a href="{{ route('cliente.confirmarBorrado', $cliente) }}" class="btn btn-danger" role="button">Borrar Cliente</a>
</h5>
@endsection