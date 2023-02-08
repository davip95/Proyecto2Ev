@extends('plantilla')
@section('cuerpo')
<h1>Añadir cuota a {{$cliente->nombre}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas" style="width: 40%; margin: 0 auto">
    <thead class="table-dark">
        <tr>
            <th>Cliente</th>
            <th>Fecha Emisión</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$cliente->nombre}}</td>
            <td>{{strftime("%d/%m/%Y")}}</td>
        </tr>
    </tbody>
</table>
<div class="formulario">
    <form action=" {{ route('cuota.agregarCuota', $cliente) }}" method="POST">
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Concepto</label>
                <input type="text" name="concepto" class="form-control form-control-sm @error('concepto') is-invalid @enderror" value="{{ old('concepto') }}">
                @error('concepto')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Importe</label>
                <input type="number" name="importe" step="0.01" min="0" class="form-control form-control-sm @error('importe') is-invalid @enderror" value="{{ old('importe') }}" />
                <div class="form-text info mb-1">Admite hasta dos decimales separados por coma (,).</div>
                @error('importe')  
                <small>{{ $message }}</small>
                @enderror
                <br><input class="btn btn-success" type="submit" value="Añadir Cuota" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Anotaciones Adicionales</label>
                <textarea name="notas" class="form-control form-control-sm @error('notas') is-invalid @enderror" cols="35" rows="5">{{ old('notas') }}</textarea>
                @error('notas')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br><a href="{{ route('cliente.index') }}" class="btn btn-danger cancelaCliente" role="button">Cancelar Cuota</a>
            </div>
        </div>
    </form>
</div>
@endsection