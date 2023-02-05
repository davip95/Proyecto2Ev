@extends('plantilla')
@section('cuerpo')
<h1>Añadir cuota a {{$cliente->nombre}}</h1>
<div class="formulario">
    <form action=" {{ route('cliente.store') }}" method="POST">
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                @error('nombre')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">CIF</label>
                <input type="text" name="cif" class="form-control form-control-sm @error('cif') is-invalid @enderror" value="{{ old('cif') }}">
                @error('cif')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Telefono</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Correo electrónico</label>
                <input type="text" name="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo') }}">
                @error('correo')  
                <small>{{ $message }}</small>
                @enderror
                <br><input class="btn btn-success" type="submit" value="Añadir Cliente" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Importe Mensual</label>
                <input type="number" name="importemensual" step="0.01" min="0" class="form-control form-control-sm @error('importemensual') is-invalid @enderror" value="{{ old('importemensual') }}" />
                <div class="form-text info">Admite hasta dos decimales separados por coma (,).</div>
                @error('importemensual')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Cuenta Corriente</label>
                <input type="text" name="cuentacorriente" class="form-control form-control-sm @error('cuentacorriente') is-invalid @enderror" value="{{ old('cuentacorriente') }}">
                @error('cuentacorriente')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">País</label>
                <select class="form-select form-select-lg @error('pais') is-invalid @enderror" name="pais">
                    <option disabled selected>Selecciona País</option>
                    @foreach ($paises as $pais)
                    <option value="{{$pais['iso3']}}" @selected(old('pais') == $pais['iso3'])>{{$pais["nombre"]}}</option>
                    @endforeach
                </select>        
                @error('pais')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <br><br>
                <br><a href="{{ route('usuario.index') }}" class="btn btn-danger cancelaCliente" role="button">Cancelar Creación</a>
            </div>
        </div>
    </form>
</div>
@endsection