<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class BalanceGeneral extends Model
{
    use HasFactory;
    
    protected $table = 'balance_generals'; 
    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
        'saldo_final',
    ];
    public function cuentaContable()
{
    return $this->belongsTo(CuentasContables::class, 'id_cuenta_contable');
}
    
    public static function booted()
    {
        static::creating(function ($balanceGeneral) {
            $cuentas = [
                'activo' => CuentasContables::where('tipo', 'activo')->with('transacciones')->get(),
                'pasivo' => CuentasContables::where('tipo', 'pasivo')->with('transacciones')->get(),
                'patrimonio' => CuentasContables::where('tipo', 'patrimonio')->with('transacciones')->get(),
            ];

            foreach ($cuentas as $tipo => $cuentasTipo) {
                foreach ($cuentasTipo as $cuenta) {
                    $debe = $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
                    $haber = $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
                    $saldo_final = $debe - $haber;

                    $balanceGeneral->create([
                        'codigo' => $cuenta->codigo,
                        'nombre' => $cuenta->nombre,
                        'tipo' => $tipo,
                        'saldo_final' => $saldo_final,
                    ]);
                }
            }
        });
    }
}
