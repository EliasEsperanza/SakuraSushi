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
            if ($transaction->id_cuenta_contable) {
                // Busca o crea la entrada en `entrada_libro_mayor` usando el ID de la cuenta contable
                $entry = Entrada_libro_mayor::firstOrCreate(
                    ['id_cuentas_contables' => $transaction->id_cuenta_contable], // Cambiado a `id_cuenta_contable`
                    ['monto' => 0]
                );
    
                // Ajusta el balance basado en el tipo de movimiento
                if ($transaction->tipo_movimiento === 'Debe' || $transaction->tipo_movimiento === 'debe') {
                    $entry->monto += $transaction->monto;
                } elseif ($transaction->tipo_movimiento === 'Haber' || $transaction->tipo_movimiento === 'haber' ) {
                    $entry->monto -= $transaction->monto;
                }
    
                $entry->save();
            } else {
                // Si `id_cuenta_contable` es NULL, muestra un mensaje de error o maneja el caso
                throw new \Exception("El campo 'id_cuenta_contable' es requerido para crear una entrada en el libro mayor.");
            }
    
        });
    }
}
