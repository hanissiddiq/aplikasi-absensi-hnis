<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKeuanganItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_keuangan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_keuangan_id')->nullable();
            $table->string('nama')->nullable();
            $table->double('qty')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('total')->nullable();
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
        Schema::dropIfExists('pengajuan_keuangan_items');
    }
}
