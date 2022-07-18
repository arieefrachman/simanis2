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
        Schema::create('alat', function (Blueprint $table) {
            $table->id();
            $table->integer('kode')->nullable(false);
            $table->string('nama')->nullable(false);
            $table->string('type')->nullable(false);
            $table->integer('tahun_pengadaan')->nullable(true);
            $table->integer('harga')->nullable(false);
            $table->integer('usia_teknis')->nullable(true);
            $table->string('frek_inspeksi')->nullable(true);
            $table->integer('frek_kalibrasi')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat');
    }
};
