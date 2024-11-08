<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_libro_mayor extends Model
{
    use HasFactory;
    protected $table = 'Entrada_libro_mayor';
    protected $fillable =[ 'id_cuentas_contables','cuenta_contable_nombre' ,'monto'];

    public function cuentaContable(){
        return $this->belongsTo(CuentasContables::class, 'id_cuentas_contables');
    }
    protected static function booted()
    {
        static::creating(function ($entradaLibroMayor) {
            $cuenta = $entradaLibroMayor->cuentaContable;
            if ($cuenta) {
                $entradaLibroMayor->cuenta_contable_nombre = $cuenta->nombre;
            }
        });
    }
}

