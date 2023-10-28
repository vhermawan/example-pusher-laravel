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
        Schema::create('data_kematian', function (Blueprint $table) {
            $table->integer('id_data_kematian', true);
            $table->integer('kematian_terbaru');
            $table->integer('jumlah_kematian');
            $table->integer('jam');
            $table->date('hari');
            $table->integer('id_data_kandang')->index('id_data_kandang_kematian');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_kematian');
    }
};
