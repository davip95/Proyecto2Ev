@extends('plantilla')
@section('cuerpo')
<h1>Eliminar Tarea {{$tarea['id']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Tarea</th>
            <th>Cliente</th>
            <th>Contacto</th>
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
            <td>{{$tarea['fichero']}}&nbsp;
                @if($tarea['fichero'] != '' && $tarea['fichero'] != NULL)
                <a class='btn btn-primary' href="{{ $url }}" download>Descargar</a>
                @endif
            </td>
        </tr>
    </tbody>
</table>
<div class="alert alert-danger aletarborrar" role="alert"><strong>Esta operación es irreversible. Asegúrese de que quiere eliminar la tarea antes de confirmarlo.</strong></div>
<h5><a href=" {{ route('tarea.show', $tarea) }} " class="btn btn-success" role="button"><i class="bi bi-x-square"></i> Cancelar Borrado</a></h5>
<br>
{{-- <form action="{{ route('tarea.borrar', $tarea) }}" method="post">
    <button class="btn btn-danger" type="submit"><i class="bi bi-check-square"></i> Confirmar Borrado</button>
</form> --}}
<form action="{{ route('tarea.destroy', $tarea) }}" method="post">
    {{-- @csrf --}}
    @method('delete')
    <button class="btn btn-danger" type="submit"><i class="bi bi-check-square"></i> Confirmar Borrado</button>
</form>

@endsection