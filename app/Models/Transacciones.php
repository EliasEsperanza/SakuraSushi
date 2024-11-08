<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LibroDiario;
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
            // Crear entrada en el Libro Diario
            LibroDiario::create([
                'fecha' => $transaction->fecha,
                'cuenta_contable_id' => $transaction->id_cuenta_contable,
                'debe' => $transaction->tipo_movimiento === 'debe' ? $transaction->monto : null,
                'haber' => $transaction->tipo_movimiento === 'haber' ? $transaction->monto : null,
                'descripcion' => $transaction->descripcion,
            ]);

            // Crear o actualizar la entrada en Entrada_libro_mayor
            if ($transaction->id_cuenta_contable) {
                $entry = Entrada_libro_mayor::firstOrCreate(
                    ['id_cuentas_contables' => $transaction->id_cuenta_contable],
                    ['monto' => 0] // Inicializa el monto a 0 si no existe la entrada
                );

                // Ajusta el balance basado en el tipo de movimiento
                if (strtolower($transaction->tipo_movimiento) === 'debe') {
                    $entry->monto += $transaction->monto;
                } elseif (strtolower($transaction->tipo_movimiento) === 'haber') {
                    $entry->monto -= $transaction->monto;
                }

                $entry->save();
            } else {
                throw new \Exception("El campo 'id_cuenta_contable' es requerido para crear una entrada en el libro mayor.");
            }
        });
    }
}

