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
        Schema::create('suhu_kelembapan_sensors', function (Blueprint $table) {
            $table->integer('id_suhu_kelembapan_sensor', true);
            $table->integer('id_kandang')->index('id_suhu_kelembapan_sensors');
            $table->integer('suhu');
            $table->date('date');
            $table->integer('kelembapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suhu_kelembapan_sensors');
    }
};
