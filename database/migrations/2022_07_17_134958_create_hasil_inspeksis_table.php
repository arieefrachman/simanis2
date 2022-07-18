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
        Schema::create('hasil_inspeksi', function (Blueprint $table) {
            $table->id();
            $table->integer('jadwal_id')->nullable(true);
            $table->integer('hasil')->nullable(true);
            $table->string('catatan')->nullable(true);
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
        Schema::dropIfExists('hasil_inspeksi');
    }
};
