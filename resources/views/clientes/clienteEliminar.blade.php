@extends('plantilla')
@section('cuerpo')
<h1>Cliente {{$cliente['id']}}</h1>
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
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Se borrarán todas las cuotas asociadas. Asegúrese de que quiere eliminar el cliente antes de confirmarlo.</strong></div>
<h5><a href="{{ route('cliente.show', $cliente) }}" class="btn btn-success" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<form action="{{ route('cliente.destroy', $cliente) }}" method="post">
    {{-- @csrf --}}
    @method('delete')
    <button class="btn btn-danger" type="submit"><i class="bi bi-check-square"></i> Confirmar Borrado</button>
</form>
@endsection