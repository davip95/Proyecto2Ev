@extends('plantilla')
@section('cuerpo')
<h1>Tarea {{$tarea['id']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Tarea</th>
            <th>Cliente</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Correo</th>
            <th>Direccion</th>
            <th>Población</th>
            <th>Código Postal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['id']}}</td>
            <td>{{$tarea->clientes->nombre}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['correo']}}</td>
            <td>{{$tarea['direccion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['codpostal']}}</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Provincia</th>
            <th>Estado</th>
            <th>Operario</th>
            <th>Fecha Creación</th>
            <th>Fecha Realización</th>
            <th>Anotaciones Anteriores</th>
            <th>Anotaciones Posteriores</th>
            <th>Fichero Adjunto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea->users->name}}</td>
            <td>{{$tarea['fechacreacion']->format('d/m/Y H:i')}}</td>
            @if($tarea['fechafin'] != null)
            <td>{{$tarea['fechafin']->format('d/m/Y H:i')}}</td>
            @else
            <td>{{$tarea['fechafin']}}</td>
            @endif
            <td>{{$tarea['anotaantes']}}</td>
            <td>{{$tarea['anotapost']}}</td>
            <td>{{$tarea['fichero']}} <br>
                @if($tarea['fichero'] != '' && $tarea['fichero'] != NULL)
                <a class='btn btn-primary' href="" download>Descargar</a>
                @endif
            </td>
            <td>
                <!-- Solo muestro el boton de completar si la tarea no está realizada -->
                @if($tarea['estado'] != 'R')
                <a href="{{ route('tarea.cambiarEstado', $tarea) }}" class="btn btn-success" role="button">Completar</a>
                @endif
                <a href="{{ route('tarea.edit', $tarea) }}" class="btn btn-warning" role="button">Editar</a>
                <a href="{{ route('tarea.confirmarBorrado', $tarea) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="{{ route('tarea.index') }}" class="btn btn-primary" role="button">Ir a Listado</a></h5>

@endsection