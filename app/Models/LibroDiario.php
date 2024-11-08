<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;
use App\Models\Transacciones;

class LibroDiario extends Model
{
    use HasFactory;

    protected $table = 'libro_diario';

    protected $fillable = [
        'fecha',
        'cuenta_contable_id',
        'transaccion_id',
        'debe',
        'haber',
        'saldo',
    ];

    public function cuentaContable()
    {
        return $this->belongsTo(CuentasContables::class, 'cuenta_contable_id');
    }

    public function transaccion()
    {
        return $this->belongsTo(Transacciones::class, 'transaccion_id');
    }
}
