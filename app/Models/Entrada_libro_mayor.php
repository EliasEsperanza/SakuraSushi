<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_libro_mayor extends Model
{
    use HasFactory;
    
    protected $fillable =[ 'cuenta_contable_id', 'balance'];

    public function Contable(){
        return $this->belongsTo(CuentasContables::class);
    }
}
