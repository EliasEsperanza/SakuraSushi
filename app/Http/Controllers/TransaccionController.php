<?php

namespace App\Http\Controllers;

use App\Models\CuentasContables;
use App\Models\Transacciones;
use App\Models\DocumentoFuente;

use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transacciones =Transacciones::with('cuentaContable')->get();
        return response()->json($transacciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_cuenta_contable' => 'required|exists:cuentas_contables,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'monto' => 'required|numeric',
            'tipo_movimiento' => 'required|string|max:10',
        ]);

        $transaccion = Transacciones::create($validatedData);
        return response()->json($transaccion, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaccion = Transacciones::with('cuentaContable')->findOrFail($id);
        return response()->json($transaccion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $transaccion = Transacciones::findOrFail($id);

    $validatedData = $request->validate([
        'id_cuenta_contable' => 'required|exists:cuentas_contables,id',
        'fecha' => 'required|date',
        'descripcion' => 'required|string|max:255',
        'monto' => 'required|numeric',
        'tipo_movimiento' => 'required|string|max:10',
    ]);

    $transaccion->update($validatedData);
    return redirect()->route('transacciones.index')->with('success', 'Transacción actualizada con éxito');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaccion = Transacciones::findOrFail($id);
        $transaccion->delete();
        return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada con éxito');
    }


    // Vista para listar transacciones
public function indexView()
{
    $transacciones = Transacciones::with('cuentaContable')->get();
    return view('transacciones.index', compact('transacciones'));
}

// Vista para crear una nueva transacción
public function createView()
{
    $cuentas = CuentasContables::all();
    $documentos = DocumentoFuente::all();
    return view('transacciones.create', compact('cuentas', 'documentos'));
}


// Vista para editar una transacción
    public function editView($id)
    {
         $transaccion = Transacciones::findOrFail($id);
        $cuentas = CuentasContables::all(); // Para el selector de cuenta contable
        return view('transacciones.edit', compact('transaccion', 'cuentas'));
    }


public function libroDiario()
{
    $transacciones = Transacciones::with('cuentaContable')
                    ->orderBy('fecha', 'asc')
                    ->get();
                    
    return view('transacciones.libro_diario', compact('transacciones'));
}
}
