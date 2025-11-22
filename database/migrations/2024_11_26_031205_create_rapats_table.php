<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapats', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nulllable();
            $table->date('tanggal')->nulllable();
            $table->string('jam_mulai')->nulllable();
            $table->string('jam_selesai')->nulllable();
            $table->string('lokasi')->nulllable();
            $table->text('detail')->nulllable();
            $table->string('jenis')->nulllable();
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
        Schema::dropIfExists('rapats');
    }
}
