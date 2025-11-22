<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_keuangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('nomor')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('pk_file_path')->nullable();
            $table->string('pk_file_name')->nullable();
            $table->string('status')->nullable();
            $table->string('nota_file_path')->nullable();
            $table->string('nota_file_name')->nullable();
            $table->unsignedBigInteger('user_approval')->nullable();
            $table->foreign('user_approval')->references('id')->on('users');
            $table->string('note_approval')->nullable();
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
        Schema::dropIfExists('pengajuan_keuangans');
    }
}
