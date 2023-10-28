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
        Schema::table('data_kematian', function (Blueprint $table) {
            $table->foreign(['id_data_kandang'], 'id_data_kandang_kematian')->references(['id_data_kandang'])->on('data_kandang')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_kematian', function (Blueprint $table) {
            $table->dropForeign('id_data_kandang_kematian');
        });
    }
};
