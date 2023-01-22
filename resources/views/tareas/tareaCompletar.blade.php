@extends('plantilla')
@section('cuerpo')
<h1>Completar Tarea {{$tarea['id']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Tarea</th>
            <th>Cliente ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['id']}}</td>
            <td>{{$tarea['clientes_id']}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['correo']}}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Direccion</th>
            <th>Población</th>
            <th>Código Postal</th>
            <th>Provincia</th>
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Anotaciones Anteriores</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['direccion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['codpostal']}}</td>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['idusuario']}}</td>
            <td>{{$tarea['fechacreacion']->format('d/m/Y')}}</td>
            <td>{{$tarea['anotaantes']}}</td>
        </tr>
    </tbody>
</table>
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
    <form action=" {{ route('tarea.completar', $tarea) }}" method="POST">
        <div class="padrecolumnas">
            <div class="columnacampos">
                <label class="form-label">Estado</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="B">
                    <label class="form-check-label" for="espera">B</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="P">
                    <label class="form-check-label" for="espera">P</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="R" checked>
                    <label class="form-check-label" for="realizada">R</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="espera" value="C">
                    <label class="form-check-label" for="cancelada">C</label>
                </div>
                <div class="form-text info">B: Esperando ser aprobada. P: Pendiente. R: Realizada. C: Cancelada</div>
            </div>
            <div class="columnacampos">
                <label class="form-label">Fecha de realización</label><br>
                <input type="date" name="fechafin" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>">
                <br>
                <label class="form-label">Anotaciones posteriores</label><br>
                <textarea name="anotapost" class="form-control form-control-sm" cols="10" rows="1">{{$tarea['anotapost']}}</textarea>
            </div>
            <div class="columnacampos">
                <label class="form-label">Fichero resumen</label>
                <br>
                <input type="file" name="fichero" class="form-control form-control-sm" id="formFileSm">
                <br>
                <input class="btn btn-success" type="submit" value="Confirmar Cambios" id="añadir">
                <br><a href=" {{ route('tarea.show', $tarea) }} " class="btn btn-danger" role="button">Cancelar Cambios</a>
            </div>
        </div>
    </form>
</div>
@endsection