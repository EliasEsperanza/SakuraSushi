<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Editar Cuenta Contable</h1>

<form action="{{ route('cuentas.update', $cuenta->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Código:</label>
    <input type="text" name="codigo" value="{{ $cuenta->codigo }}" required><br>

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $cuenta->nombre }}" required><br>

    <label>Tipo:</label>
    <input type="text" name="tipo" value="{{ $cuenta->tipo }}" required><br>

    <button type="submit">Actualizar</button>
</form>

</body>
</html>