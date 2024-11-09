<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class BalanceComprobacion extends Model
{
    use HasFactory;


    public static function obtenerBalance()
    {
        // Obtenemos todas las cuentas contables
        $cuentas = CuentasContables::with('transacciones')->get();

        // Calculamos el saldo total de cada cuenta en el Debe y el Haber
        return $cuentas->map(function ($cuenta) {
            $debe = $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
            $haber = $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
            
            return [
                'codigo' => $cuenta->codigo,
                'nombre' => $cuenta->nombre,
                'tipo' => $cuenta->tipo,
                'saldo_debe' => $debe,
                'saldo_haber' => $haber,
            ];
        });
    }
}
