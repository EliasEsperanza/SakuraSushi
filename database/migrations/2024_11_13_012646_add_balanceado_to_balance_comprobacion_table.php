<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalanceadoToBalanceComprobacionTable extends Migration
{
    public function up()
    {
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->boolean('balanceado')->default(false)->after('saldo_haber');
        });
    }

    public function down()
    {
        Schema::table('balance_comprobacions', function (Blueprint $table) {
            $table->dropColumn('balanceado');
        });
    }
}
