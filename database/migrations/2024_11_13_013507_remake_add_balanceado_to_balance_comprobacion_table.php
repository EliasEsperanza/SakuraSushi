<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Primero, nos aseguramos de que no exista la columna temporal
        if (Schema::hasColumn('balance_comprobacions', 'balanceado_temp')) {
            Schema::table('balance_comprobacions', function (Blueprint $table) {
                $table->dropColumn('balanceado_temp');
            });
        }

        // Creamos la columna temporal
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->string('balanceado_temp')->nullable();
        });

        // Copiamos los datos convirtiendo los valores booleanos a string
        DB::table('balance_comprobacions')
            ->orderBy('id')
            ->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('balance_comprobacions')
                        ->where('id', $row->id)
                        ->update([
                            'balanceado_temp' => $row->balanceado ? 'true' : 'false'
                        ]);
                }
            });

        // Eliminamos la columna original
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->dropColumn('balanceado');
        });

        // Renombramos la columna temporal
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->renameColumn('balanceado_temp', 'balanceado');
        });
    }

    public function down()
    {
        // Nos aseguramos de que no exista la columna temporal
        if (Schema::hasColumn('balance_comprobacions', 'balanceado_temp')) {
            Schema::table('balance_comprobacions', function (Blueprint $table) {
                $table->dropColumn('balanceado_temp');
            });
        }

        // Creamos la columna temporal booleana
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->boolean('balanceado_temp')->nullable();
        });

        // Convertimos los strings de vuelta a booleanos
        DB::table('balance_comprobacions')
            ->orderBy('id')
            ->chunk(100, function ($rows) {
                foreach ($rows as $row) {
                    DB::table('balance_comprobacions')
                        ->where('id', $row->id)
                        ->update([
                            'balanceado_temp' => $row->balanceado === 'true'
                        ]);
                }
            });

        // Eliminamos la columna original
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->dropColumn('balanceado');
        });

        // Renombramos la columna temporal
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->renameColumn('balanceado_temp', 'balanceado');
        });
    }
};