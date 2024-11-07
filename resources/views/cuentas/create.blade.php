<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Crear Nueva Cuenta Contable</h1>

<form action="{{ route('cuentas.store') }}" method="POST">
    @csrf
    <label>Código:</label>
    <input type="text" name="codigo" required><br>

    <label>Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label>Tipo:</label>
    <input type="text" name="tipo" required><br>

    <button type="submit">Guardar</button>
</form>

</body>
</html>