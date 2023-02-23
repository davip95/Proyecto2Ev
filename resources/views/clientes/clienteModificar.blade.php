@extends('plantilla')
@section('cuerpo')
<h1>Cambiar Datos Cliente</h1>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
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
<div class="formulario">
    <form action=" {{ route('cliente.update', $cliente) }}" method="POST">
        @method('put')
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nuevo Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre', $cliente->nombre) }}">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                @error('nombre')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo CIF</label>
                <input type="text" name="cif" class="form-control form-control-sm @error('cif') is-invalid @enderror" value="{{ old('cif', $cliente->cif) }}">
                @error('cif')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo Telefono</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $cliente->telefono) }}">
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo Correo</label>
                <input type="text" name="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo', $cliente->correo) }}">
                @error('correo')  
                <small>{{ $message }}</small>
                @enderror
                <br><input class="btn btn-success" type="submit" value="Editar Cliente" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Nuevo Importe Mensual</label>
                <input type="number" name="importemensual" step="0.01" min="0" class="form-control form-control-sm @error('importemensual') is-invalid @enderror" value="{{ old('importemensual', $cliente->importemensual) }}" />
                <div class="form-text info">Admite hasta dos decimales separados por coma (,).</div>
                @error('importemensual')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nueva Cuenta Corriente</label>
                <input type="text" name="cuentacorriente" class="form-control form-control-sm @error('cuentacorriente') is-invalid @enderror" value="{{ old('cuentacorriente', $cliente->cuentacorriente) }}">
                @error('cuentacorriente')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo País</label>
                <select class="form-select form-select-lg @error('pais') is-invalid @enderror" name="pais">
                    <option disabled selected>Selecciona País</option>
                    @foreach ($paises as $pais)
                    <option value="{{$pais['iso3']}}" @selected(old('pais', $cliente->pais) == $pais['iso3'])>{{$pais["nombre"]}}</option>
                    @endforeach
                </select>        
                @error('pais')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <br><br>
                <br><a href="{{ route('cliente.index') }}" class="btn btn-danger cancelaCliente" role="button">Cancelar Creación</a>
            </div>
        </div>
    </form>
</div>
@endsection