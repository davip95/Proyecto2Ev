@extends('plantilla')
@section('cuerpo')
<h1>Lista de clientes</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>CIF</th>
            <th>Nombre</th>
            <th>Cuenta Corriente</th>
            <th>País</th>
            <th>Moneda</th>
            <th>Importe Mensual</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente['cif']}}</td>
            <td>{{$cliente['nombre']}}</td>
            <td>{{$cliente['cuentacorriente']}}</td>
            <td>{{$cliente['pais']}}</td>
            <td>{{$cliente['moneda']}}</td>
            <td>{{$cliente['importemensual']}}</td>
            <td>
                <a href="{{ route('cuota.listarCuotasCliente', $cliente) }}" class="btn btn-secondary" role="button">Cuotas</a>
                <a href="{{ route('cliente.show', $cliente) }}" class="btn btn-info" role="button">Detalles</a>
                <a href="{{ route('cliente.confirmarBorrado', $cliente) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$clientes->links()}}
</div>
@endsection