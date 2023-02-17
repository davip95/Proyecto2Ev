<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosecaen S.L.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/css/plantilla.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/inicioVista.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nuevaTarea.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/verTareas.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/eliminarTarea.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/verTareasBuscadas.css')}}">
</head>

<body>
<h1>Añadir Incidencia</h1>
<br>
<div class="formulario">
    <form action=" {{ route('tarea.agregarIncidencia') }}" method="POST">
        {{-- @csrf --}}
        <div class="mx-auto justify-center">
            <label class="form-label">CIF Cliente</label>
                <input type="text" name="cif" class="form-control form-control-sm @error('cif') is-invalid @enderror" value="{{ old('cif') }}">
                @error('cif')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Telefono Cliente</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
        </div>
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Nombre de contacto</label>
                <input type="text" name="nombre" class="form-control form-control-sm @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                @error('nombre')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Apellidos de contacto</label>
                <input type="text" name="apellidos" class="form-control form-control-sm @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}">
                @error('apellidos')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Teléfono contacto</label>
                <input type="text" name="telefono" class="form-control form-control-sm @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                <div class="form-text info">Debe ser de España. Puede separar los dígitos con espacio o guión.</div>
                @error('telefono')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror" value="{{ old('descripcion') }}">
                @error('descripcion')  
                <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="columnacampos">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control form-control-sm @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                @error('direccion')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Población</label>
                <input type="text" name="poblacion" class="form-control form-control-sm @error('poblacion') is-invalid @enderror" value="{{ old('poblacion') }}">
                @error('poblacion')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Código Postal</label>
                <input type="text" name="codpostal" class="form-control form-control-sm @error('codpostal') is-invalid @enderror" value="{{ old('codpostal') }}">
                @error('codpostal')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <label class="form-label">Provincia</label>
                <select class="form-select form-select-lg @error('provincia') is-invalid @enderror" name="provincia">
                    <option disabled selected>Selecciona provincia</option>
                    @foreach ($provincias as $provincia)
                    <option value="{{$provincia['nombre']}}" @selected(old('provincia') == $provincia['nombre'])>{{$provincia["nombre"]}}</option>
                    @endforeach
                </select>        
                @error('provincia')  
                <small>{{ $message }}</small>
                @enderror
                {{-- <br><br>
                <label class="form-label">Estado</label>
                <div class="form-check">
                    <input class="form-check-input @error('estado') is-invalid @enderror" type="radio" name="estado" id="espera" value="B" {{old('estado') == 'B' ? 'checked' : ''}}>
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('estado') is-invalid @enderror" type="radio" name="estado" id="pendiente" value="P" {{old('estado') == 'P' ? 'checked' : ''}}>
                    <label class="form-check-label" for="pendiente">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('estado') is-invalid @enderror" type="radio" name="estado" id="realizada" value="R" {{old('estado') == 'R' ? 'checked' : ''}}>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('estado') is-invalid @enderror" type="radio" name="estado" id="cancelada" value="C" {{old('estado') == 'C' ? 'checked' : ''}}>
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
                @error('estado')  
                <small>{{ $message }}</small>
                @enderror --}}
                <br>
                <input class="btn btn-success mt-1" type="submit" value="Añadir Incidencia" id="añadir">
            </div>
            <div class="columnacampos">
                <label class="form-label">Correo electrónico</label>
                <input type="text" name="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror" value="{{ old('correo') }}">
                @error('correo')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                <label class="form-label">Fecha de creación de tarea</label>
                <input type="datetime-local" name="fechacreacion" class="form-control form-control-sm @error('fechacreacion') is-invalid @enderror" value="<?= date('Y-m-d\TH:i') ?>">
                @error('fechacreacion')  
                <small>{{ $message }}</small>
                @enderror
                <br>
                {{-- <label class="form-label">Fecha de realización</label>
                <input type="datetime-local" name="fechafin" class="form-control form-control-sm @error('fechafin') is-invalid @enderror" value="{{ old('fechafin') }}">
                @error('fechafin')  
                <small>{{ $message }}</small>
                @enderror
                <br> --}}
                <label class="form-label">Anotaciones anteriores</label>
                <textarea name="anotaantes" class="form-control form-control-sm @error('anotaantes') is-invalid @enderror" cols="10" rows="1">{{ old('anotaantes') }}</textarea>
                @error('anotaantes')  
                <small>{{ $message }}</small>
                @enderror
                <br><br>
                <label class="form-label">Anotaciones posteriores</label>
                <textarea name="anotapost" class="form-control form-control-sm @error('anotapost') is-invalid @enderror" cols="10" rows="1">{{ old('anotapost') }}</textarea>
                @error('anotapost')  
                <small>{{ $message }}</small>
                @enderror
                <br><a href="{{ route('login') }}" class="btn btn-danger" role="button">Cancelar Incidencia</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>