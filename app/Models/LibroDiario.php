<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CuentasContables;

class LibroDiario extends Model
{
    use HasFactory;

    protected $table = 'libro_diario';

    protected $fillable = [
        'fecha',
        'cuenta_contable_id',
        'debe',
        'haber',
        'descripcion',
    ];

    public function cuentaContable()
    {
        return $this->belongsTo(CuentasContables::class, 'cuenta_contable_id');
    }
}
