<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entrada_libro_mayor;

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
            // **Actualizar el saldo de la cuenta de débito**
            $debitEntry = Entrada_libro_mayor::firstOrCreate(
                ['id_cuentas_contables' => $transaction->debit_account_id],
                ['balance' => 0]
            );
            $debitEntry->balance += $transaction->amount;
            $debitEntry->save();

            // **Actualizar el saldo de la cuenta de crédito**
            $creditEntry = Entrada_libro_mayor::firstOrCreate(
                ['id_cuentas_contables' => $transaction->credit_account_id],
                ['balance' => 0]
            );
            $creditEntry->balance -= $transaction->amount;
            $creditEntry->save();
        });
    }
}
