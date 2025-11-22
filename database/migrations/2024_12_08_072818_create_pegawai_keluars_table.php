<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('tanggal')->nullable();
            $table->string('jenis')->nullable();
            $table->text('alasan')->nullable();
            $table->string('pegawai_keluar_file_path')->nullable();
            $table->string('pegawai_keluar_file_name')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->date('tanggal_approval')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pegawai_keluars');
    }
}
