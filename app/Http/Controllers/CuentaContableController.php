<?php

namespace App\Http\Controllers;

use App\Models\CuentasContables;
use Illuminate\Http\Request;

class CuentaContableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuentas= CuentasContables::all();
        return response()->json($cuentas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData= $request->validate([
            'codigo'=>'required|string|max:4',
            'nombre'=>'required|string|max:100',
            'tipo'=>'required|string|max:50',
        ]);

        $cuenta = CuentasContables::create($validateData);
        return response()->json($cuenta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cuenta =CuentasContables::findOrFail($id);
        return response()->json($cuenta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cuenta =CuentasContables::findORFail($id);

        $validateData=$request->validate([
            'codigo'=>'required|string|max:4',
            'nombre'=>'required|string|max:100',
            'tipo'=>'required|string|max:50',
        ]);

        $cuenta->update($validateData);
        return response()->json($cuenta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cuenta=CuentasContables::findOrFail($id);
        $cuenta->delete();
        return response()->json(['mensaje'=>'cuenta contable eliminada'], 200);
    }

    public function indexView()
    {
        $cuentas = CuentasContables::all();
        return view('cuentas.index', compact('cuentas'));
    }

    // Vista para crear una nueva cuenta contable
    public function createView()
    {
        return view('cuentas.create');
    }

    // Vista para editar una cuenta contable
    public function editView($id)
    {
        $cuenta = CuentasContables::findOrFail($id);
        return view('cuentas.edit', compact('cuenta'));
    }
    public function mayorizar($id)
{
    $cuenta = CuentasContables::with(['transacciones' => function($query) {
                    $query->orderBy('fecha', 'asc');
                }])->findOrFail($id);
                
    // Calcular el saldo acumulado
    $saldo = 0;
    foreach ($cuenta->transacciones as $transaccion) {
        if ($transaccion->tipo_movimiento === 'debe') {
            $saldo += $transaccion->monto;
            $transaccion->saldo_acumulado = $saldo;
        } else {
            $saldo -= $transaccion->monto;
            $transaccion->saldo_acumulado = $saldo;
        }
    }

    return view('cuentas.mayorizacion', compact('cuenta'));
}

}
