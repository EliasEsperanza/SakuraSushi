<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentasContables extends Model
{
    use HasFactory;

    protected $table = 'cuentas_contables';

    protected $fillable = [
        'codigo',
        'nombre',
        'tipo',
    ];
}
