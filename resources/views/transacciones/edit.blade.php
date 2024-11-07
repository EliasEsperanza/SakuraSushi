<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Editar Transacción</h1>

<form action="{{ route('transacciones.update', $transaccion->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="cuenta">Cuenta Contable:</label>
    <select name="id_cuenta_contable" required>
        @foreach ($cuentas as $cuenta)
            <option value="{{ $cuenta->id }}" {{ $transaccion->id_cuenta_contable == $cuenta->id ? 'selected' : '' }}>
                {{ $cuenta->nombre }}
            </option>
        @endforeach
    </select><br>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" value="{{ $transaccion->fecha }}" required><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" value="{{ $transaccion->descripcion }}" required><br>

    <label for="monto">Monto:</label>
    <input type="number" step="0.01" name="monto" value="{{ $transaccion->monto }}" required><br>

    <label for="tipo_movimiento">Tipo de Movimiento:</label>
    <select name="tipo_movimiento" required>
        <option value="debe" {{ $transaccion->tipo_movimiento === 'debe' ? 'selected' : '' }}>Debe</option>
        <option value="haber" {{ $transaccion->tipo_movimiento === 'haber' ? 'selected' : '' }}>Haber</option>
    </select><br>

    <button type="submit">Actualizar Transacción</button>
</form>
<form action="{{ route('transacciones.destroy', $transaccion->id) }}" method="POST" style="margin-top: 10px;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta transacción?')">
        Eliminar Transacción
    </button>
</form>
</body>
</html>