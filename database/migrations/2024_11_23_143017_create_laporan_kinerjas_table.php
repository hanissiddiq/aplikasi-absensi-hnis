<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->foreignId('jenis_kinerja_id')->nullable();
            $table->bigInteger('nilai')->nullable();
            $table->bigInteger('penilaian_berjalan')->nullable();
            $table->string('reference')->nullable();
            $table->integer('reference_id')->nullable();
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
        Schema::dropIfExists('laporan_kinerjas');
    }
}
