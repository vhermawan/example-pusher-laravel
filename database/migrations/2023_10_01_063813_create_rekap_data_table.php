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
        Schema::create('rekap_data', function (Blueprint $table) {
            $table->integer('id_rekap_data', true);
            $table->integer('id_kandang')->index('id_kandang_rekap');
            $table->date('hari');
            $table->integer('rata_rata_amoniak');
            $table->integer('rata_rata_suhu');
            $table->integer('kelembapan');
            $table->integer('pakan');
            $table->integer('minum');
            $table->integer('jumlah_kematian');
            $table->integer('jumlah_kematian_harian');
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
        Schema::dropIfExists('rekap_data');
    }
};
