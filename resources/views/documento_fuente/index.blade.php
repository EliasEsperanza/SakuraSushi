<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Documentos Fuente</h1>
<a href="{{ route('documento_fuentes.create') }}">Crear Nuevo Documento</a>
<table>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documentos as $documento)
            <tr>
                <td>{{ $documento->tipo }}</td>
                <td>{{ $documento->fecha }}</td>
                <td>{{ $documento->monto }}</td>
                <td>{{ $documento->descripcion }}</td>
                <td>
                    <a href="{{ route('documento_fuentes.edit', $documento->id) }}">Editar</a>
                    <form action="{{ route('documento_fuentes.destroy', $documento->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>