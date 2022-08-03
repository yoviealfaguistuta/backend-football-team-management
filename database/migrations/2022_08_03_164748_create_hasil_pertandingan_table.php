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
        Schema::create('hasil_pertandingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal_pertandingan')->references('id')->on('jadwal_pertandingan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pemain')->references('id')->on('pemain')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipe', [1, 2, 3])->default(1)->comment('1 = mencetak gol', '2 = mendapat kartu kuning', '3 = mendapat kartu merah');
            $table->string('waktu');
            $table->boolean('soft_delete')->default(false);
            $table->timestamps();

            $table->index(['id_pemain', 'tipe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aktifitas_pertandingan');
    }
};
