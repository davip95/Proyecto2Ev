@extends('plantilla')
@section('cuerpo')
<h1>Lista de Incidencias</h1>
<br>
<table class="table table-striped table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>Fecha Creación</th>
            <th>Cliente</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Población</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($incidencias as $incidencia)
        <tr>
            <td>{{$incidencia['fechacreacion']->format('d/m/Y H:i')}}</td>
            <td>{{$incidencia->clientes->nombre}}</td>
            <td>{{$incidencia['nombre']}}</td>
            <td>{{$incidencia['telefono']}}</td>
            <td>{{$incidencia['descripcion']}}</td>
            <td>{{$incidencia['poblacion']}}</td>
            <td>{{$incidencia['estado']}}</td>
            <td>
                <a href="{{ route('tarea.edit', $incidencia) }}" class="btn btn-primary" role="button">Asignar</a>
                <a href="{{ route('tarea.confirmarBorrado', $incidencia) }}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="paginacion">
    {{$incidencias->links()}}
</div>
@endsection