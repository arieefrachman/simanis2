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
        Schema::create('request_perbaikan', function (Blueprint $table) {
            $table->id();
            $table->integer('alat_ruangan_id')->nullable(true);
            $table->integer('hasil')->nullable(true);
            $table->date('tanggal_kerusakan')->nullable(true);
            $table->date('tanggal_perbaikan')->nullable(true);
            $table->string('catatan')->nullable(true);
            $table->string('catatan_perbaikan')->nullable(true);
            $table->integer('biaya')->nullable(true);
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
        Schema::dropIfExists('request_perbaikan');
    }
};
