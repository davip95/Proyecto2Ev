@extends('plantilla')
@section('cuerpo')
<h1>Añadir nuevo usuario</h1>
<div class="formulario">
    <form action=" {{ route('usuario.store') }}" method="POST">
        {{-- @csrf --}}
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}">
                <div class="form-text info">El nombre sólo puede contener letas y/o números.</div>
                @error('name')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Contraseña</label>
                <input type="text" name="password" class="form-control form-control-sm @error('name') is-invalid @enderror">
                @error('password')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Repita Contraseña</label>
                <input type="text" name="passrep" class="form-control form-control-sm @error('name') is-invalid @enderror">
                @error('passrep')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Correo electrónico</label>
                <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <br><input class="btn btn-success" type="submit" value="Añadir Usuario" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">DNI</label>
                <input type="text" name="dni" class="form-control form-control-sm @error('dni') is-invalid @enderror" value="{{ old('dni') }}">
                @error('dni')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <label class="form-label">Telefono</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Direccion</label>
                <input type="text" name="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                @error('direccion')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Tipo</label>
                <div class="form-check">
                    <input class="form-check-input @error('tipo') is-invalid @enderror" type="radio" name="tipo" id="admin" value="administrador" {{old('tipo') == 'administrador' ? 'checked' : ''}}>
                    <label class="form-check-label" for="admin">Administrador</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('tipo') is-invalid @enderror" type="radio" name="tipo" id="operario" value="operario" {{old('tipo') == 'operario' ? 'checked' : ''}}>
                    <label class="form-check-label" for="operario">Operario</label>
                </div>
                @error('tipo')  
                <small>{{ $message }}</small>
                @enderror
                <br><a href="{{ route('usuario.index') }}" class="btn btn-danger" role="button">Cancelar Creación</a>
            </div>
        </div>
    </form>
</div>
@endsection