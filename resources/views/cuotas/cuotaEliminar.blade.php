@extends('plantilla')
@section('cuerpo')
<h1>Cuota {{$cuota['id']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Cuota</th>
            <th>Cliente</th>
            <th>Concepto</th>
            <th>Fecha Emisión</th>
            <th>Importe</th>
            <th>Pago</th>
            <th>Fecha Pago</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$cuota['id']}}</td>
            <td>{{$cuota->clientes->nombre}}</td>
            <td>{{$cuota['concepto']}}</td>
            <td>{{$cuota['fechaemision']->format('d/m/Y')}}</td>
            <td>{{$cuota['importe']}}</td>
            <td>
                @if($cuota->pagada)
                    <span class="text-success">Realizado</span>
                @else
                    <span class="text-danger">Pendiente</span>
                @endif
            </td>
            <td>{{$cuota['notas']}}</td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar la cuota antes de confirmarlo.</strong></div>
<h5><a href="{{ route('cliente.index') }}" class="btn btn-success" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
<form action="{{ route('cuota.destroy', $cuota) }}" method="post">
    {{-- @csrf --}}
    @method('delete')
    <button class="btn btn-danger" type="submit"><i class="bi bi-check-square"></i> Confirmar Borrado</button>
</form>
@endsection