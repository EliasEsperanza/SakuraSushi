<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class BalanceComprobacion extends Model
{
    use HasFactory; 
    protected $table = 'balance_comprobacions';

    protected $fillable = ['codigo', 'nombre', 'tipo', 'saldo_debe', 'saldo_haber'];
    
    public function cuentaContable()
{
    return $this->belongsTo(CuentasContables::class, 'id_cuenta_contable');
}

    public static function booted()
    {
        static::creating(function ($balanceComprobacion) {
            $cuentas = CuentasContables::with('transacciones')->get();

            foreach ($cuentas as $cuenta) {
                $debe = $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
                $haber = $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');

                $balanceComprobacion->create([
                    'codigo' => $cuenta->codigo,
                    'nombre' => $cuenta->nombre,
                    'tipo' => $cuenta->tipo,
                    'saldo_debe' => $debe,
                    'saldo_haber' => $haber,
                ]);
            }
        });
    }
}
