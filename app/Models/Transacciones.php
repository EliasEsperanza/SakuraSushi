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
            self::actualizarLibroDiarioYMayor($transaction);
        });
    
        static::updated(function ($transaction) {
            self::actualizarLibroDiarioYMayor($transaction, true);
        });
    
        static::deleted(function ($transaction) {
            self::revertirMovimientoEnLibroMayor($transaction);
        });
    }
    
    protected static function actualizarLibroDiarioYMayor($transaction, $esActualizacion = false)
    {
        // Crear o actualizar entrada en el Libro Diario
        if (!$esActualizacion) {
            LibroDiario::create([
                'fecha' => $transaction->fecha,
                'cuenta_contable_id' => $transaction->id_cuenta_contable,
                'debe' => $transaction->tipo_movimiento === 'debe' ? $transaction->monto : null,
                'haber' => $transaction->tipo_movimiento === 'haber' ? $transaction->monto : null,
                'descripcion' => $transaction->descripcion,
            ]);
        }
    
        if ($transaction->id_cuenta_contable) {
            $cuentaContable = CuentasContables::find($transaction->id_cuenta_contable);
    
            if (!$cuentaContable) {
                throw new \Exception("La cuenta contable no existe.");
            }
    
            $entry = Entrada_libro_mayor::firstOrCreate(
                ['id_cuentas_contables' => $transaction->id_cuenta_contable],
                ['monto' => 0, 'nombre_cuenta_contable' => $cuentaContable->nombre]
            );
    
            // Si es una actualización, revertir el monto anterior antes de aplicar el nuevo
            if ($esActualizacion) {
                $montoAnterior = $transaction->getOriginal('monto');
                $tipoMovimientoAnterior = strtolower($transaction->getOriginal('tipo_movimiento'));
    
                if ($cuentaContable->tipo === 'activo') {
                    $entry->monto -= $tipoMovimientoAnterior === 'debe' ? $montoAnterior : -$montoAnterior;
                } elseif ($cuentaContable->tipo === 'pasivo' || $cuentaContable->tipo === 'capital') {
                    $entry->monto += $tipoMovimientoAnterior === 'debe' ? $montoAnterior : -$montoAnterior;
                } elseif ($cuentaContable->tipo === 'ingreso' && $tipoMovimientoAnterior === 'haber') {
                    $entry->monto -= $montoAnterior;
                } elseif ($cuentaContable->tipo === 'gastos' && $tipoMovimientoAnterior === 'debe') {
                    $entry->monto -= $montoAnterior;
                }
            }
    
            // Ajustar el balance basado en el tipo de cuenta y movimiento actual
            if (strtolower($cuentaContable->tipo) === 'activo') {
                $entry->monto += $transaction->tipo_movimiento === 'debe' ? $transaction->monto : -$transaction->monto;
            } elseif (strtolower($cuentaContable->tipo) === 'pasivo' || strtolower($cuentaContable->tipo) === 'capital') {
                $entry->monto += $transaction->tipo_movimiento === 'debe' ? -$transaction->monto : $transaction->monto;
            } elseif (strtolower($cuentaContable->tipo) === 'ingreso' && $transaction->tipo_movimiento === 'haber') {
                $entry->monto += $transaction->monto;
            } elseif (strtolower($cuentaContable->tipo) === 'gastos' && $transaction->tipo_movimiento === 'debe') {
                $entry->monto += $transaction->monto;
            }
    
            $entry->save();
        } else {
            throw new \Exception("El campo 'id_cuenta_contable' es requerido para crear una entrada en el libro mayor.");
        }
    }
    
    protected static function revertirMovimientoEnLibroMayor($transaction)
    {
        if ($transaction->id_cuenta_contable) {
            $cuentaContable = CuentasContables::find($transaction->id_cuenta_contable);
    
            if (!$cuentaContable) {
                throw new \Exception("La cuenta contable no existe.");
            }
    
            $entry = Entrada_libro_mayor::where('id_cuentas_contables', $transaction->id_cuenta_contable)->first();
    
            if ($entry) {
                // Revertir el impacto del movimiento eliminado en el balance de Entrada_libro_mayor
                if (strtolower($cuentaContable->tipo) === 'activo') {
                    $entry->monto -= $transaction->tipo_movimiento === 'debe' ? $transaction->monto : -$transaction->monto;
                } elseif (strtolower($cuentaContable->tipo) === 'pasivo' || strtolower($cuentaContable->tipo) === 'capital') {
                    $entry->monto += $transaction->tipo_movimiento === 'debe' ? $transaction->monto : -$transaction->monto;
                } elseif (strtolower($cuentaContable->tipo) === 'ingreso' && $transaction->tipo_movimiento === 'haber') {
                    $entry->monto -= $transaction->monto;
                } elseif (strtolower($cuentaContable->tipo) === 'gastos' && $transaction->tipo_movimiento === 'debe') {
                    $entry->monto -= $transaction->monto;
                }
    
                $entry->save();
            }
        } else {
            throw new \Exception("El campo 'id_cuenta_contable' es requerido para modificar una entrada en el libro mayor.");
        }
    }
    

}

