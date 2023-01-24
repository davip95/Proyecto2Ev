@extends('plantilla')
@section('cuerpo')
<h1>Lista de tareas pendientes</h1>
<br>
<table class="table table-striped table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Fecha Creación</th>
            <th>Cliente</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Población</th>
            <th>Estado</th>
            <th>Fecha Realización</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tareas as $tarea)
        <tr>
            <td>{{$tarea['fechacreacion']->format('d/m/Y H:i')}}</td>
            <td>{{$tarea->clientes->nombre}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['estado']}}</td>
            @if($tarea['fechafin'] != null)
            <td>{{$tarea['fechafin']->format('d/m/Y H:i')}}</td>
            @else
            <td>{{$tarea['fechafin']}}</td>
            @endif
            <td>
                <a href=" {{ route('tarea.show', $tarea) }} " class="btn btn-info" role="button">Detalles</a>
                <a href="{{ route('tarea.edit', $tarea) }}" class="btn btn-warning" role="button">Editar</a>
                <a href="{{ route('tarea.confirmarBorrado', $tarea) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="paginacion">
    {{$tareas->links()}}
</div>
@endsection