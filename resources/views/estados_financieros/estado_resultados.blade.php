<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Estado de Resultados</h1>

<h2>Ingresos</h2>
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Ingresos</td>
            <td>{{ $ingresos }}</td>
        </tr>
    </tbody>
</table>

<h2>Costos</h2>
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Costos</td>
            <td>{{ $costos }}</td>
        </tr>
    </tbody>
</table>

<h2>Gastos</h2>
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Monto</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total Gastos</td>
            <td>{{ $gastos }}</td>
        </tr>
    </tbody>
</table>

<h3>Beneficio / Pérdida: {{ $beneficio }}</h3>

</body>
</html>