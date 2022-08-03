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
        Schema::create('jadwal_pertandingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tim_tuan_rumah')->references('id')->on('tim')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_tim_tamu')->references('id')->on('tim')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal')->default(date('Y-m-d'));
            $table->string('waktu');
            $table->boolean('soft_delete')->default(false);
            $table->timestamps();

            $table->index(['tanggal', 'waktu']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_pertandingan');
    }
};
