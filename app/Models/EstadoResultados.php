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
        $totalIngresos = CuentasContables::where('tipo', 'Ingreso')
            ->join('transacciones', 'cuentas_contables.id', '=', 'transacciones.id_cuenta_contable')
            ->where('transacciones.tipo_movimiento', 'haber')
            ->sum('transacciones.monto');

        $totalGastos = CuentasContables::whereIn('tipo', ['costo', 'Gasto'])
            ->join('transacciones', 'cuentas_contables.id', '=', 'transacciones.id_cuenta_contable')
            ->where('transacciones.tipo_movimiento', 'debe')
            ->sum('transacciones.monto');

        $utilidadNeta = $totalIngresos - $totalGastos;

        // Limpiar la tabla y agregar registros actualizados
        self::truncate();

        self::insert([
            [
                'nombre' => 'Ingresos',
                'tipo' => 'ingreso',
                'monto' => $totalIngresos,
            ],
            [
                'nombre' => 'Gastos',
                'tipo' => 'gasto',
                'monto' => $totalGastos,
            ],
            [
                'nombre' => 'Utilidad Neta',
                'tipo' => 'resultado',
                'monto' => $utilidadNeta,
            ],
        ]);
    }
}
