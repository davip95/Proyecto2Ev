<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Clientes Rusos</title>
	<style>
		
	</style>
</head>
<body> 
	<h1>Clientes de Rusia</h1>
<br>
<table class="table table-bordered table-responsive table-condensed" id="listaTareas">
    <thead class="table-dark">
        <tr>
            <th>CIF</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Total Importe Cobrado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{$cliente['cif']}}</td>
            <td>{{$cliente['nombre']}}</td>
            <td>{{$cliente['telefono']}}</td>
            <td>{{$cliente['importetotal']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
