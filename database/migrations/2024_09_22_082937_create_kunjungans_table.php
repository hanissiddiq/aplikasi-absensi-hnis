<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->date('tanggal')->nullable();
            $table->datetime('visit_in')->nullable();
            $table->string('foto_in')->nullable();
            $table->string('lat_in')->nullable();
            $table->string('long_in')->nullable();
            $table->text('keterangan_in')->nullable();
            $table->datetime('visit_out')->nullable();
            $table->string('foto_out')->nullable();
            $table->string('lat_out')->nullable();
            $table->string('long_out')->nullable();
            $table->text('keterangan_out')->nullable();
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
        Schema::dropIfExists('kunjungans');
    }
}
