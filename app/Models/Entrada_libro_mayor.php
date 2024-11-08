<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_libro_mayor extends Model
{
    use HasFactory;
    protected $table = 'Entrada_libro_mayor';
    protected $fillable =[ 'id_cuentas_contables', 'monto'];

    public function cuentaContable(){
        return $this->belongsTo(CuentasContables::class, 'id_cuentas_contables');
    }
}
