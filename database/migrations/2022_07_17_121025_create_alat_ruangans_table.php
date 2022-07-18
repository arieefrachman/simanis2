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
        Schema::create('alat_ruangan', function (Blueprint $table) {
            $table->id();
            $table->integer('alat_id')->nullable(true);
            $table->integer('ruangan_id')->nullable(true);
            $table->string('serial_number')->nullable(true);
            $table->string('keterangan')->nullable(true);
            $table->date('last_inspection')->nullable(true);
            $table->date('last_calibration')->nullable(true);
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
        Schema::dropIfExists('alat_ruangan');
    }
};
