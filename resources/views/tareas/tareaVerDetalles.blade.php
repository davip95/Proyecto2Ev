@extends('plantilla_admin')
@section('cuerpo')
<h1>Tarea {{$tarea['idtarea']}}</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>ID Tarea</th>
            <th>DNI</th>
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
            <td>{{$tarea['idtarea']}}</td>
            <td>{{$tarea['dni']}}</td>
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
            <th>ID Operario</th>
            <th>Fecha Creación</th>
            <th>Fecha Realización</th>
            <th>Anotaciones Anteriores</th>
            <th>Anotaciones Posteriores</th>
            <th>Fichero Adjunto</th>
            <th>Foto Adjunta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea['idusuario']}}</td>
            <td>{{$tarea['fechacreacion']}}</td>
            <td>{{$tarea['fechafin']}}</td>
            <td>{{$tarea['anotaantes']}}</td>
            <td>{{$tarea['anotapost']}}</td>
            <td>{{$tarea['fichero']}} <br>
                @if($tarea['fichero'] != '' && $tarea['fichero'] != NULL)
                <a class='btn btn-primary' href="<?= BASE_URL . "archivos/" . $tarea['fichero'] ?>" download>Descargar</a>
                @endif
            </td>
            <td>{{$tarea['foto']}} <br>
                @if($tarea['foto'] != '' && $tarea['foto'] != NULL)
                <a class='btn btn-primary' href="<?= BASE_URL . "archivos/" . $tarea['foto'] ?>" download>Descargar</a>
                @endif
            </td>
            <td>
                <a href="index.php?controller=tareas&action=editar&id={{$tarea['idtarea']}}" class="btn btn-warning" role="button">Editar</a>
                <a href="index.php?controller=tareas&action=confirmaEliminar&id={{$tarea['idtarea']}}" class="btn btn-danger" role="button">Borrar</a>
            </td>
        </tr>
    </tbody>
</table>
<h5><a href="index.php?controller=tareas&action=listar" class="btn btn-primary" role="button">Ir a Listado</a></h5>

@endsection