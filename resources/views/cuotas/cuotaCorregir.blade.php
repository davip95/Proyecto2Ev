@extends('plantilla')
@section('cuerpo')
<h1>Corregir Cuota</h1>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Concepto</th>
            <th>Fecha Emision</th>
            <th>Importe</th>
            <th>Pagada</th>
            <th>Fecha Pago</th>
            <th>Notas</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>
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
            <td>{{$cuota->clientes->nombre}}</td>
        </tr>
    </tbody>
</table>
<div class="formulario">
    <form action=" {{ route('cuota.update', $cuota) }}" method="POST">
        @method('put')
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Concepto</label>
                <input type="text" name="concepto" class="form-control form-control-sm @error('concepto') is-invalid @enderror" value="{{ old('concepto', $cuota->concepto) }}">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                @error('concepto')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Fecha Emision</label>
                <input type="datetime-local" name="fechaemision" class="form-control form-control-sm @error('fechaemision') is-invalid @enderror" value="{{ old('password', $cuota->fechaemision->format('Y-m-d\TH:i')) }}">
                @error('fechaemision')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Importe</label>
                <input type="number" name="importe" step="0.01" min="0" class="form-control form-control-sm @error('importe') is-invalid @enderror" value="{{ old('importe', $cuota->importe) }}" />
                <div class="form-text info mb-1">Admite hasta dos decimales separados por coma (,).</div>
                @error('importe')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Fecha Pago</label>
                <input type="datetime-local" name="fechapago" class="form-control form-control-sm @error('fechapago') is-invalid @enderror" value="{{ old('fechapago', is_null($cuota->fechapago) ? '' : $cuota->fechapago->format('Y-m-d\TH:i')) }}">
                @error('fechapago')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br><input class="btn btn-danger" type="submit" value="Confirmar Cambios" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Pagada</label>
                <div class="form-check">
                    <input class="form-check-input @error('pagada') is-invalid @enderror" type="radio" name="pagada" id="si" value="1" {{old('pagada', $cuota->pagada) == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="si">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('pagada') is-invalid @enderror" type="radio" name="pagada" id="no" value="0" {{old('pagada', $cuota->pagada) == 0 ? 'checked' : ''}}>
                    <label class="form-check-label" for="no">No</label>
                </div>
                @error('pagada')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Anotaciones</label>
                <textarea name="notas" class="form-control form-control-sm @error('notas') is-invalid @enderror" cols="35" rows="5">{{ old('notas', $cuota->notas) }}</textarea>
                @error('notas')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <label class="form-label mt-1">Cliente</label>
                <select class="form-select form-select-lg @error('clientes_id') is-invalid @enderror" name="clientes_id">
                    <option disabled selected>Selecciona cliente</option>
                    @foreach ($clientes as $cliente)
                    <option value="{{$cliente['id']}}" @selected(old('clientes_id', $cuota->clientes_id) == $cliente['id'])>{{$cliente["nombre"]}}</option>
                    @endforeach
                </select>
                @error('clientes_id')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br><a href="{{ route('cuota.listarCuotasCliente', $cuota->clientes->id) }}" class="btn btn-success mt-2" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
@endsection