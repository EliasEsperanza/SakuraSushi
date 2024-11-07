<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Lista de Transacciones</h1>
<a href="{{ route('transacciones.create') }}">Crear Nueva Transacción</a>

<table>
    <tr>
        <th>Cuenta</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Monto</th>
        <th>Tipo de Movimiento</th>
        <th>Acciones</th>
    </tr>
    @foreach($transacciones as $transaccion)
    <tr>
        <td>{{ $transaccion->cuentaContable->nombre }}</td>
        <td>{{ $transaccion->fecha }}</td>
        <td>{{ $transaccion->descripcion }}</td>
        <td>{{ $transaccion->monto }}</td>
        <td>{{ $transaccion->tipo_movimiento }}</td>
        <td>
            <a href="{{ route('transacciones.edit', $transaccion->id) }}">Editar</a>
            <form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>