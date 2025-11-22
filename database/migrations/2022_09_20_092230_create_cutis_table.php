<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('nama_cuti')->nullable();
            $table->string('tanggal')->nullable();
            $table->text('alasan_cuti')->nullable();
            $table->string('foto_cuti')->nullable();
            $table->string('status_cuti')->nullable();
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('user_approval')->nullable();
            $table->foreign('user_approval')->references('id')->on('users');
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
        Schema::dropIfExists('cutis');
    }
}
