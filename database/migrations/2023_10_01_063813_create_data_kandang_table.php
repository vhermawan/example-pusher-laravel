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
        Schema::create('data_kandang', function (Blueprint $table) {
            $table->integer('id_data_kandang', true);
            $table->integer('id_kandang')->index('id_kandang_data');
            $table->integer('hari_ke');
            $table->integer('pakan');
            $table->integer('bobot');
            $table->integer('minum');
            $table->timestamp('date')->useCurrentOnUpdate()->useCurrent();
            $table->enum('classification', ['normal', 'abnormal'])->default('normal');
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
        Schema::dropIfExists('data_kandang');
    }
};
