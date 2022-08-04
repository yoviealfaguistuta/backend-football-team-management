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
        Schema::create('pemain', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tim')->references('id')->on('tim')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->float('tinggi_badan');
            $table->float('berat_badan');
            $table->enum('posisi_pemain', [1, 2, 3, 4])->default(1)->comment('1 = penyerang, 2 = gelandang, 3 = bertahan, 4 = penjaga gawang');
            $table->integer('nomor_punggung')->unique();
            $table->boolean('soft_delete')->default(false);
            $table->timestamps();

            $table->index(['nama', 'posisi_pemain', 'nomor_punggung']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemain');
    }
};
