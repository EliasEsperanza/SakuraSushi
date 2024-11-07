<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Crear Documento Fuente</h1>
<form action="{{ route('documento_fuentes.store') }}" method="POST">
    @csrf
    <label>Tipo:</label>
    <input type="text" name="tipo" required><br>
    <label>Fecha:</label>
    <input type="date" name="fecha" required><br>
    <label>Monto:</label>
    <input type="number" step="0.01" name="monto" required><br>
    <label>Descripción:</label>
    <input type="text" name="descripcion"><br>
    <button type="submit">Guardar</button>
</form>

</body>
</html>