@extends('plantilla')
@section('cuerpo')
<h1>Cuotas de {{$cliente->nombre}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Concepto</th>
            <th>Fecha Emisión</th>
            <th>Importe (€)</th>
            <th>Pago</th>
            <th>Fecha Pago</th>
            <th>Notas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cuotas as $cuota)
        <tr>
            <td>{{$cuota->concepto}}</td>
            <td>{{$cuota->fechaemision->format('d/m/Y')}}</td>
            <td>{{$cuota->importe}}</td>
            <td>
                @if($cuota->pagada)
                    <span class="text-success">Realizado</span>
                @else
                    <span class="text-danger">Pendiente</span>
                @endif
            </td>
            <td>
                @if($cuota->fechapago!=null)
                    {{$cuota->fechapago->format('d/m/Y')}}
                @endif
            </td>
            <td>{{$cuota->notas}}</td>
            <td>
                @if(!$cuota->pagada)
                <a href="{{ route('paypal.pay', $cuota) }}" class="btn btn-primary" role="button">Pagar</a>
                @endif
                <a href="{{ route('cuota.pdf', $cuota) }}" class="btn btn-info" role="button">Factura</a>
                <a href="{{ route('cuota.edit', $cuota) }}" class="btn btn-warning" role="button">Corregir</a>
                <a href="{{ route('cuota.confirmarBorrado', $cuota) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$cuotas->links()}}
</div>
<h5>
    <a href="{{ route('cuota.crearCuota', $cliente) }}" class="btn btn-success" role="button">Añadir Cuota</a>
    &nbsp;&nbsp;
    <a href="{{ route('cuota.listarCuotasPendientes', $cliente) }}" class="btn btn-dark" role="button">Cuotas Pendientes</a>
</h5>
@endsection