<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('foto_karyawan')->nullable();
            $table->string('foto_face_recognition')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('tgl_join')->nullable();
            $table->string('status_nikah')->nullable();
            $table->text('alamat')->nullable();
            $table->bigInteger('izin_cuti')->default(0);
            $table->bigInteger('izin_lainnya')->default(0);
            $table->bigInteger('izin_telat')->default(0);
            $table->bigInteger('izin_pulang_cepat')->default(0);
            $table->string('is_admin')->nullable();
            $table->date('masa_berlaku')->nullable();
            $table->foreignId('jabatan_id')->nullable();
            $table->foreignId('lokasi_id')->nullable();
            $table->string('ktp')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('sim')->nullable();
            $table->string('no_pkwt')->nullable();
            $table->string('no_kontrak')->nullable();
            $table->date('tanggal_mulai_pkwt')->nullable();
            $table->date('tanggal_berakhir_pkwt')->nullable();
            $table->string('rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->bigInteger('gaji_pokok')->nullable();
            $table->bigInteger('makan_transport')->nullable();
            $table->bigInteger('lembur')->nullable();
            $table->bigInteger('kehadiran')->nullable();
            $table->bigInteger('thr')->nullable();
            $table->bigInteger('bonus_pribadi')->nullable();
            $table->bigInteger('bonus_team')->nullable();
            $table->bigInteger('bonus_jackpot')->nullable();
            $table->bigInteger('izin')->nullable();
            $table->bigInteger('terlambat')->nullable();
            $table->bigInteger('mangkir')->nullable();
            $table->bigInteger('saldo_kasbon')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
