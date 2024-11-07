<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Transacción</title>
</head>
<body>
    <h1>Crear Nueva Transacción</h1>

    <form action="{{ route('transacciones.store') }}" method="POST">
        @csrf

        <label for="cuenta">Cuenta Contable:</label>
        <select name="id_cuenta_contable" required>
            @foreach ($cuentas as $cuenta)
                <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
            @endforeach
        </select><br>

        <!-- Nuevo campo para seleccionar Documento Fuente -->
        <label for="documento_fuente">Documento Fuente:</label>
        <select name="id_documento_fuente" required>
            @foreach ($documentos as $documento)
                <option value="{{ $documento->id }}">{{ $documento->tipo }} - {{ $documento->fecha }}</option>
            @endforeach
        </select><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required><br>

        <label for="monto">Monto:</label>
        <input type="number" step="0.01" name="monto" required><br>

        <label for="tipo_movimiento">Tipo de Movimiento:</label>
        <select name="tipo_movimiento" required>
            <option value="debe">Debe</option>
            <option value="haber">Haber</option>
        </select><br>

        <button type="submit">Crear Transacción</button>
    </form>
</body>
</html>
