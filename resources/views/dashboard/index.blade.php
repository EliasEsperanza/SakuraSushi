<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/dashboard/index.blade.php -->

<h1>Dashboard</h1>
<p>Bienvenido al sistema contable.</p>

<ul>
    <li><a href="{{ route('transacciones.create') }}">Registrar Nueva Transacción</a></li>
    <li><a href="{{ route('libro.diario') }}">Ver Libro Diario</a></li>
    <li><a href="{{ route('cuentas.index') }}">Ver Cuentas Contables</a></li>
    <li><a href="{{ route('cuentas.mayorizar', ['id' => 1]) }}">Mayorización</a></li>
    <li><a href="{{ route('estado_financiero.balance_comprobacion') }}">Balance de Comprobación</a></li>
    <li><a href="{{ route('estado_financiero.balance_general') }}">Balance General</a></li>
    <li><a href="{{ route('estado_financiero.estado_resultados') }}">Estado de Resultados</a></li>
</ul>


</body>
</html>