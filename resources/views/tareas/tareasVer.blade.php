@extends('plantilla')
@section('cuerpo')
<h1>Lista de tareas</h1>
<br>
@if($tareas->isEmpty())
<br>
<div class="alert alert-primary w-25 mx-auto" role="alert">
    <strong>No hay tareas que listar</strong>
</div>
@else
<table class="table table-striped table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Nº</th>
            <th>Fecha Creación</th>
            <th>Cliente</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Población</th>
            <th>Estado</th>
            <th>Operario</th>
            <th>Fecha Realización</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tareas as $tarea)
        <tr>
            <td>{{$tareas->firstItem() + $loop->index}}</td>
            <td>{{$tarea['fechacreacion']->format('d/m/Y H:i')}}</td>
            <td>{{$tarea->clientes->nombre}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea->users->name}}</td>
            @if($tarea['fechafin'] != null)
            <td>{{$tarea['fechafin']->format('d/m/Y H:i')}}</td>
            @else
            <td>{{$tarea['fechafin']}}</td>
            @endif
            <td>
                <a href=" {{ route('tarea.show', $tarea) }} " class="btn btn-info" role="button">Detalles</a>
                @if(Auth::user()->tipo=='administrador')
                <a href="{{ route('tarea.edit', $tarea) }}" class="btn btn-warning" role="button">Editar</a>
                <a href="{{ route('tarea.confirmarBorrado', $tarea) }}" class="btn btn-danger" role="button">Borrar</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="paginacion">
    {{$tareas->links()}}
</div>
@endif
@endsection
