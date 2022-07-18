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
        Schema::create('jadwal_kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->integer('alat_ruangan_id')->nullable(true);
            $table->date('tanggal')->nullable(true);
            $table->integer('biaya')->nullable(true);
            $table->boolean('checked')->nullable(true);
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
        Schema::dropIfExists('jadwal_kalibrasi');
    }
};
