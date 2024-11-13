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
        $cuentas = [
            'activo' => CuentasContables::where('tipo', 'Activo')->with('transacciones')->get(),
            'pasivo' => CuentasContables::where('tipo', 'Pasivo')->with('transacciones')->get(),
            'patrimonio' => CuentasContables::whereIn('tipo', ['Patrimonio', 'Capital'])->with('transacciones')->get(),
        ];
        self::truncate();
        foreach ($cuentas as $tipo => $cuentasTipo) {
            foreach ($cuentasTipo as $cuenta) {
                $debe = $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
                $haber = $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
                $saldo_final = $debe - $haber;

                self::insert([
                    'codigo' => $cuenta->codigo,
                    'nombre' => $cuenta->nombre,
                    'tipo' => $tipo,
                    'saldo_final' => $saldo_final,
                ]);
            }
        }
    }
}
