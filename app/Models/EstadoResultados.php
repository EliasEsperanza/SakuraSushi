<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
class EstadoResultados extends Model
{
    use HasFactory;

    protected $table = 'estado_resultados'; 
    protected $fillable = [
        'nombre',
        'tipo',
        'monto',
    ];

    public static function booted()
    {
        static::creating(function ($estadoResultados) {
            $ingresos = CuentasContables::where('tipo', 'ingreso')->with('transacciones')->get();
            $gastos = CuentasContables::whereIn('tipo', ['costo', 'gasto'])->with('transacciones')->get();

            $totalIngresos = $ingresos->sum(function ($cuenta) {
                return $cuenta->transacciones()->where('tipo_movimiento', 'haber')->sum('monto');
            });

            $totalGastos = $gastos->sum(function ($cuenta) {
                return $cuenta->transacciones()->where('tipo_movimiento', 'debe')->sum('monto');
            });

            $utilidadNeta = $totalIngresos - $totalGastos;

            $estadoResultados->create([
                'nombre' => 'Ingresos',
                'tipo' => 'ingreso',
                'monto' => $totalIngresos,
            ]);

            $estadoResultados->create([
                'nombre' => 'Gastos',
                'tipo' => 'gasto',
                'monto' => $totalGastos,
            ]);

            $estadoResultados->create([
                'nombre' => 'Utilidad Neta',
                'tipo' => 'resultado',
                'monto' => $utilidadNeta,
            ]);
        });
    }
    
}
