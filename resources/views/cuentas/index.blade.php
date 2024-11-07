<!-- resources/views/cuentas/index.blade.php -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuentasContables</title>
 </head>
 <body>
    

<h1>Lista de Cuentas Contables</h1>
<a href="{{ route('cuentas.create') }}">Crear Nueva Cuenta</a>

<table>
    <tr>
        <th>Código</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    @foreach($cuentas as $cuenta)
    <tr>
        <td>{{ $cuenta->codigo }}</td>
        <td>{{ $cuenta->nombre }}</td>
        <td>{{ $cuenta->tipo }}</td>
        <td>
            <a href="{{ route('cuentas.edit', $cuenta->id) }}">Editar</a>
            <form action="{{ route('cuentas.destroy', $cuenta->id) }}" method="POST" style="display:inline;">
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