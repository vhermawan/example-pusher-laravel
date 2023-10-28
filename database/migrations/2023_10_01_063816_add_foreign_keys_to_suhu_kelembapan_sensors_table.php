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
        Schema::table('suhu_kelembapan_sensors', function (Blueprint $table) {
            $table->foreign(['id_kandang'], 'id_suhu_kelembapan_sensors')->references(['id_kandang'])->on('kandang')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suhu_kelembapan_sensors', function (Blueprint $table) {
            $table->dropForeign('id_suhu_kelembapan_sensors');
        });
    }
};
