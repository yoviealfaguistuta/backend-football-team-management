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
        Schema::create('tim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan')->references('id')->on('perusahaan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->text('logo')->default('default.png');
            $table->string('tahun_berdiri')->default(date('Y'));
            $table->text('alamat_markas_tim');
            $table->string('kota_markas_tim', 100);
            $table->boolean('soft_delete')->default(false);
            $table->timestamps();

            $table->index(['nama', 'tahun_berdiri']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tim');
    }
};
