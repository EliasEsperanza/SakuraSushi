<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Entrada_libro_mayor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cuentas_contables')->default(0)->constrained('cuentas_contables')->onDelete('cascade');
            $table->string('cuenta_contable_nombre');
            
            $table->decimal('monto', 10, 2)->default(0);
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Entrada_libro_mayor');
    }
};
