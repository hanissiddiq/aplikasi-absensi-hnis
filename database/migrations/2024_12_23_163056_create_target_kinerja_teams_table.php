<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetKinerjaTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_kinerja_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('target_kinerja_id')->nullable();
            $table->foreign('target_kinerja_id')->references('id')->on('target_kinerjas');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->foreign('jabatan_id')->references('id')->on('jabatans');
            $table->bigInteger('target_pribadi')->nullable();
            $table->bigInteger('jumlah_persen_pribadi')->nullable();
            $table->bigInteger('bonus_pribadi')->nullable();

            $table->string('judul')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->double('capai')->nullable();
            $table->string('nilai')->nullable();
            $table->bigInteger('bonus_p')->nullable();
            $table->bigInteger('bonus_t')->nullable();
            $table->bigInteger('bonus_j')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('target_kinerja_teams');
    }
}
