@extends('plantilla')
@section('cuerpo')
<h1>Modificar tarea {{$tarea['id']}}</h1>
<div class="formulario">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li><br>
            @endforeach
        </ul>
    </div>
    @endif
    <form action=" {{ route('tarea.update', $tarea) }}" method="POST">
        @method('put')
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Cliente</label>
                <select class="form-select form-select-lg" name="clientes_id">
                    <option disabled selected>Selecciona cliente</option>
                    @foreach ($clientes as $cliente)
                    <option value="{{$cliente['id']}}" @selected(old('clientes_id', $tarea->clientes_id) == $cliente['id'])>{{$cliente["nombre"]}}</option>
                    @endforeach
                </select>
                <br>
                <label class="form-label">Nombre de contacto</label>
                <input type="text" name="nombre" class="form-control form-control-sm" value="{{ old('nombre', $tarea->nombre) }}">
                <br>
                <label class="form-label">Apellidos de contacto</label>
                <input type="text" name="apellidos" class="form-control form-control-sm" value="{{ old('apellidos', $tarea->apellidos) }}">
                <br>
                <label class="form-label">Teléfono contacto</label>
                <input type="text" name="telefono" class="form-control form-control-sm" value="{{ old('telefono', $tarea->telefono) }}">
                <div class="form-text info">Debe ser de España. Puede separar los dígitos con espacio o guión.</div>
                <br>
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control form-control-sm" value="{{ old('descripcion', $tarea->descripcion) }}">
                <br>
                <label class="form-label">Correo electrónico</label>
                <input type="text" name="correo" class="form-control form-control-sm" value="{{ old('correo', $tarea->correo) }}">
            </div>
            <div class="columnacampos">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control form-control-sm" value="{{ old('direccion', $tarea->direccion) }}">
                <br>
                <label class="form-label">Población</label>
                <input type="text" name="poblacion" class="form-control form-control-sm" value="{{ old('poblacion', $tarea->poblacion) }}">
                <br>
                <label class="form-label">Código Postal</label>
                <input type="text" name="codpostal" class="form-control form-control-sm" value="{{ old('codpostal', $tarea->codpostal) }}">
                <br>
                <label class="form-label">Provincia</label>
                <select class="form-select form-select-lg" name="provincia">
                    <option disabled selected>Selecciona provincia</option>
                    @foreach ($provincias as $provincia)
                    <option value="{{$provincia['nombre']}}" @selected(old('provincia', $tarea->provincia) == $provincia['nombre'])>{{$provincia["nombre"]}}</option>
                    @endforeach
                </select>        
                <br><br>
                <label class="form-label">Estado</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B" {{old('estado', $tarea->estado) == 'B' ? 'checked' : ''}}>
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="pendiente" value="P" {{old('estado', $tarea->estado) == 'P' ? 'checked' : ''}}>
                    <label class="form-check-label" for="pendiente">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="realizada" value="R" {{old('estado', $tarea->estado) == 'R' ? 'checked' : ''}}>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="cancelada" value="C" {{old('estado', $tarea->estado) == 'C' ? 'checked' : ''}}>
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
            </div>
            <div class="columnacampos">
                <label class="form-label">Operario encargado</label>
                <select class="form-select form-select-lg" name="users_id">
                    <option disabled selected>Selecciona operario</option>
                    @foreach ($operarios as $operario)
                    <option value="{{$operario['id']}}" @selected(old('users_id', $tarea->users_id) == $operario['id'])>{{$operario["name"]}}</option>
                    @endforeach
                </select>              
                <br>
                <label class="form-label">Fecha de creación de tarea</label>
                <input type="date" name="fechacreacion" class="form-control form-control-sm" value="{{ old('fechacreacion', $tarea->fechacreacion->format('Y-m-d')) }}">
                <br>
                <label class="form-label">Fecha de realización</label>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="{{ old('fechafin', is_null($tarea->fechafin) ? '' : $tarea->fechafin->format('Y-m-d')) }}">
                <br>
                <label class="form-label">Anotaciones anteriores</label>
                <textarea name="anotaantes" class="form-control form-control-sm" cols="10" rows="1">{{ old('anotaantes', $tarea->anotaantes) }}</textarea>
                <br>
                <label class="form-label">Anotaciones posteriores</label>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1">{{ old('anotapost', $tarea->anotapost) }}</textarea>
                <br>
                <br><input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href=" {{ route('tarea.show', $tarea) }} " class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>

    </form>
</div>
@endsection