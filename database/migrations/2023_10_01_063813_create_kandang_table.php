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
        Schema::create('kandang', function (Blueprint $table) {
            $table->integer('id_kandang', true);
            $table->integer('id_user')->index('id_user');
            $table->string('nama_kandang', 11)->unique('nama_kandang');
            $table->integer('populasi_awal');
            $table->string('alamat_kandang', 11);
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
        Schema::dropIfExists('kandang');
    }
};
