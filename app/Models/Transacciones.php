<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LibroDiario;

class Transacciones extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
        'id_cuenta_contable',
        'fecha',
        'descripcion',
        'monto',
        'tipo_movimiento',
    ];

    public function cuentaContable()
    {
        return $this->belongsTo(CuentasContables::class, 'id_cuenta_contable');
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            LibroDiario::create([
                'fecha' => $transaction->fecha,
                'cuenta_contable_id' => $transaction->id_cuenta_contable,
                'debe' => $transaction->tipo_movimiento === 'debe' ? $transaction->monto : null,
                'haber' => $transaction->tipo_movimiento === 'haber' ? $transaction->monto : null,
                'descripcion' => $transaction->descripcion,
            ]);
        });
    }
}
