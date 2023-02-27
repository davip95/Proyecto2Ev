<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Factura Nosecaen</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
		}

		.container {
			width: 800px;
			margin: 0 auto;
			padding: 20px;
			border: 2px solid #ccc;
			background-color: #f7f7f7;
		}

		h1 {
			text-align: center;
			font-size: 28px;
			margin-top: 0;
			margin-bottom: 20px;
			color: #333;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		th {
			background-color: #f2f2f2;
			text-align: left;
			padding: 10px;
			border: 1px solid #ccc;
		}

		td {
			padding: 10px;
			border: 1px solid #ccc;
		}

		.amount {
			font-weight: bold;
			color: #333;
			text-align: right;
		}

		.total {
			font-weight: bold;
			color: #333;
			text-align: right;
			border-top: 2px solid #333;
			padding-top: 10px;
		}
	</style>
</head>
<body>
    @php
    setlocale(LC_TIME, "spanish"); 
    @endphp 
	<div class="container">
		<h1>Detalles de {{'Factura #' . strftime("%B/%Y") . '_' . $cuota->id}}</h1>
		<table>
			<tr>
				<th>Cuota:</th>
				<td>{{ $cuota->id }}</td>
			</tr>
			<tr>
				<th>Concepto:</th>
				<td>{{ $cuota->concepto }}</td>
			</tr>
			<tr>
				<th>Fecha de Emisión:</th>
				<td>{{ $cuota->fechaemision->format('d/m/Y') }}</td>
			</tr>
			<tr>
				<th>Importe:</th>
				<td class="amount">{{ $cuota->importe }}</td>
			</tr>
			<tr>
				<th>Pago:</th>
				<td>{{ $cuota->pagada ? 'Pagada' : 'Pendiente' }}</td>
			</tr>
			<tr>
				<th>Fecha de Pago:</th>
				<td>{{ $cuota->fechapago ? $cuota->fechapago->format('d/m/Y') : '' }}</td>
			</tr>
			<tr>
				<th>Anotaciones:</th>
				<td>{{ $cuota->notas ? $cuota->notas : '' }}</td>
			</tr>
			<tr>
				<th>Cliente:</th>
				<td>{{ $cuota->clientes->nombre }}</td>
			</tr>
			<tr>
				<th>CIF Cliente:</th>
				<td>{{ $cuota->clientes->cif }}</td>
			</tr>
		</table>

		<div class="total">
			Total: {{ $cuota->importe }}
		</div>
	</div>
</body>
</html>
