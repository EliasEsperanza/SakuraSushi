<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Balance General</h1>

<h2>Activos</h2>
<table>
    <thead>
        <tr>
            <th>Cuenta</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activos as $activo)
            <tr>
                <td>{{ $activo->nombre }}</td>
                <td>{{ $activo->transacciones->sum('monto') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Pasivos</h2>
<table>
    <thead>
        <tr>
            <th>Cuenta</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pasivos as $pasivo)
            <tr>
                <td>{{ $pasivo->nombre }}</td>
                <td>{{ $pasivo->transacciones->sum('monto') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Patrimonio</h2>
<table>
    <thead>
        <tr>
            <th>Cuenta</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($capital as $cap)
            <tr>
                <td>{{ $cap->nombre }}</td>
                <td>{{ $cap->transacciones->sum('monto') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>