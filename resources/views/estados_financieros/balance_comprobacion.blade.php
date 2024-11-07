<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Balance de Comprobación</h1>

<table>
    <thead>
        <tr>
            <th>Cuenta</th>
            <th>Debe</th>
            <th>Haber</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cuentas as $cuenta)
            <tr>
                <td>{{ $cuenta->nombre }}</td>
                <td>{{ $cuenta->transacciones->where('tipo_movimiento', 'debe')->sum('monto') }}</td>
                <td>{{ $cuenta->transacciones->where('tipo_movimiento', 'haber')->sum('monto') }}</td>
                <td>{{ $cuenta->transacciones->sum(function($transaccion) {
                    return $transaccion->tipo_movimiento === 'debe' ? $transaccion->monto : -$transaccion->monto;
                }) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>