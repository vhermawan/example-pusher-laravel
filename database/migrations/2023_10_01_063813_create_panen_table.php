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
        Schema::create('panen', function (Blueprint $table) {
            $table->integer('id_panen', true);
            $table->integer('id_kandang')->index('id_kandang');
            $table->date('tanggal_mulai');
            $table->timestamp('tanggal_panen')->useCurrentOnUpdate()->useCurrent();
            $table->integer('jumlah_panen');
            $table->integer('bobot_total');
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
        Schema::dropIfExists('panen');
    }
};
