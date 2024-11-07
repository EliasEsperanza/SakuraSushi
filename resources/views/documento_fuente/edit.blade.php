<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Editar Documento Fuente</h1>
<form action="{{ route('documento_fuentes.update', $documentoFuente->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Tipo:</label>
    <input type="text" name="tipo" value="{{ $documentoFuente->tipo }}" required><br>
    <label>Fecha:</label>
    <input type="date" name="fecha" value="{{ $documentoFuente->fecha }}" required><br>
    <label>Monto:</label>
    <input type="number" step="0.01" name="monto" value="{{ $documentoFuente->monto }}" required><br>
    <label>Descripción:</label>
    <input type="text" name="descripcion" value="{{ $documentoFuente->descripcion }}"><br>
    <button type="submit">Actualizar</button>
</form>

</body>
</html>