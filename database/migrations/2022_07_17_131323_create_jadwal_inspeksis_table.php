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
        Schema::create('jadwal_inspeksi', function (Blueprint $table) {
            $table->id();
            $table->integer('alat_ruangan_id')->nullable(false);
            $table->date('tanggal')->nullable(false);
            $table->boolean('checked')->nullable(false);
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
        Schema::dropIfExists('jadwal_inspeksi');
    }
};
