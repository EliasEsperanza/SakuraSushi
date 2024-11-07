<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/transacciones/libro_diario.blade.php -->

<h1>Libro Diario</h1>

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Cuenta</th>
            <th>Descripción</th>
            <th>Debe</th>
            <th>Haber</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transacciones as $transaccion)
            <tr>
                <td>{{ $transaccion->fecha }}</td>
                <td>{{ $transaccion->cuentaContable->nombre }}</td>
                <td>{{ $transaccion->descripcion }}</td>
                @if ($transaccion->tipo_movimiento === 'debe')
                    <td>{{ $transaccion->monto }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $transaccion->monto }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>