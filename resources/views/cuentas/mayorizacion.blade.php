<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- resources/views/cuentas/mayorizacion.blade.php -->

<h1>Mayor - {{ $cuenta->nombre }}</h1>

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Debe</th>
            <th>Haber</th>
            <th>Saldo Acumulado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cuenta->transacciones as $transaccion)
            <tr>
                <td>{{ $transaccion->fecha }}</td>
                <td>{{ $transaccion->descripcion }}</td>
                @if ($transaccion->tipo_movimiento === 'debe')
                    <td>{{ $transaccion->monto }}</td>
                    <td></td>
                @else
                    <td></td>
                    <td>{{ $transaccion->monto }}</td>
                @endif
                <td>{{ $transaccion->saldo_acumulado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>