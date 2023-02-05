@extends('plantilla')
@section('cuerpo')
<h1>Añadir Remesa Mensual</h1>
<h3>Mes: {{strftime("%B")}}</h3>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Concepto</th>
            <th>Fecha Emisión</th>
            <th>Cliente</th>
            <th>Importe</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente['id'] . "_" . strftime("%B/%Y")}}</td>
            <td>{{strftime("%d/%m/%Y")}}</td>
            <td>{{$cliente['nombre']}}</td>
            <td>{{$cliente['importemensual'] . " " . $cliente['moneda']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$clientes->links()}}
</div>
<div class="formulario">
    <form action=" {{ route('cuota.agregarRemesa') }}" method="POST">
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Anotaciones Adicionales</label>
                <textarea name="notas" class="form-control form-control-sm @error('notas') is-invalid @enderror" cols="50" rows="4">{{ old('notas') }}</textarea>
                @error('notas')  
                <small>{{ $message }}</small>
                @enderror
                <br><input class="btn btn-success" type="submit" value="Añadir Remesa" id="añadir">
                <br>
                <a href="{{ route('cliente.index') }}" class="btn btn-danger" role="button">Cancelar Remesa</a>
            </div>
        </div>
    </form>
</div>
@endsection