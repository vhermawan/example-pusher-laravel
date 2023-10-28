<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_kandang', function (Blueprint $table) {
            $table->foreign(['id_kandang'], 'id_kandang_data')->references(['id_kandang'])->on('kandang')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kandang', function (Blueprint $table) {
            $table->dropForeign('id_kandang_data');
        });
    }
};
