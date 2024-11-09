<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class BalanceGeneral extends Model
{
    use HasFactory;
    public static function obtenerBalance()
    {
        // Obtenemos las cuentas agrupadas por Activos, Pasivos y Patrimonio
        $activos = CuentasContables::where('tipo', 'activo')->with('transacciones')->get();
        $pasivos = CuentasContables::where('tipo', 'pasivo')->with('transacciones')->get();
        $patrimonio = CuentasContables::where('tipo', 'patrimonio')->with('transacciones')->get();

        // Función para calcular el saldo final de cada tipo de cuenta
        $calcularSaldo = function ($cuentas) {
            return $cuentas->map(function ($cuenta) {
                $debe = $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
                $haber = $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
                return [
                    'codigo' => $cuenta->codigo,
                    'nombre' => $cuenta->nombre,
                    'saldo' => $debe - $haber,
                ];
            });
        };

        return [
            'activos' => $calcularSaldo($activos),
            'pasivos' => $calcularSaldo($pasivos),
            'patrimonio' => $calcularSaldo($patrimonio),
        ];
    }
}
