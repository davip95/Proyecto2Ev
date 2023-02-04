@extends('plantilla')
@section('cuerpo')
<h1>Cambiar Datos Usuario</h1>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Contraseña</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Fecha Alta</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$usuario['name']}}</td>
            <td>{{$usuario['password']}}</td>
            <td>{{$usuario['dni']}}</td>
            <td>{{$usuario['telefono']}}</td>
            <td>{{$usuario['direccion']}}</td>
            <td>{{$usuario->fechaalta->format('d/m/Y H:i')}}</td>
            <td>{{$usuario['tipo']}}</td>
        </tr>
    </tbody>
</table>
<div class="formulario">
    <form action=" {{ route('usuario.update', $usuario) }}" method="POST">
        @method('put')
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nuevo Nombre</label>
                <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name', $usuario->name) }}">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                @error('name')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nueva Contraseña</label>
                <input type="text" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" value="{{ old('password', $usuario->password) }}">
                @error('password')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Repita Nueva Contraseña</label>
                <input type="text" name="passrep" class="form-control form-control-sm @error('passrep') is-invalid @enderror" value="{{ old('passrep', $usuario->password) }}">
                @error('passrep')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo Correo electrónico</label>
                <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email', $usuario->email) }}">
                @error('email')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo Telefono</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono', $usuario->telefono) }}">
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br><input class="btn btn-danger" type="submit" value="Confirmar Cambios" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Nuevo DNI</label>
                <input type="text" name="dni" class="form-control form-control-sm @error('dni') is-invalid @enderror" value="{{ old('dni', $usuario->dni) }}">
                @error('dni')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <label class="form-label">Nueva Fecha Alta</label>
                <input type="datetime-local" name="fechaalta" class="form-control form-control-sm @error('fechaalta') is-invalid @enderror" value="{{ old('fechaalta', $usuario->fechaalta->format('Y-m-d\TH:i')) }}">
                @error('fechaalta')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nueva Direccion</label>
                <input type="text" name="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion', $usuario->direccion) }}">
                @error('direccion')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Nuevo Tipo</label>
                <div class="form-check">
                    <input class="form-check-input @error('tipo') is-invalid @enderror" type="radio" name="tipo" id="admin" value="administrador" {{old('tipo', $usuario->tipo) == 'administrador' ? 'checked' : ''}}>
                    <label class="form-check-label" for="admin">Administrador</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('tipo') is-invalid @enderror" type="radio" name="tipo" id="operario" value="operario" {{old('tipo', $usuario->tipo) == 'operario' ? 'checked' : ''}}>
                    <label class="form-check-label" for="operario">Operario</label>
                </div>
                @error('tipo')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br>
                <br>
                <br>
                <br><a href="{{ route('usuario.show', $usuario) }}" class="btn btn-success" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
@endsection