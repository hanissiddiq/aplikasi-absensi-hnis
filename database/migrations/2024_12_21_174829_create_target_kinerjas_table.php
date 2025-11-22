<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->nullable();
            $table->bigInteger('target_team')->nullable();
            $table->bigInteger('jumlah_persen_team')->nullable();
            $table->bigInteger('bonus_team')->nullable();
            $table->bigInteger('jackpot')->nullable();
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal_akhir')->nullable();
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
        Schema::dropIfExists('target_kinerjas');
    }
}
