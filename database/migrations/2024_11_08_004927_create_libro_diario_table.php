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
        Schema::create('libro_diario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->foreignId('cuenta_contable_id')->constrained('cuentas_contables');
            $table->foreignId('transaccion_id')->constrained('transacciones');
            $table->decimal('debe', 10, 2);
            $table->decimal('haber', 10, 2);
            $table->decimal('saldo', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_diario');
    }
};