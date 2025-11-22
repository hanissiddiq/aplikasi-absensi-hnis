<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\Jabatan;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jabatan = Jabatan::where('nama_jabatan', $row['divisi'])->first();
        if ($jabatan) {
            $jabatan_id = $jabatan->id;
        } else {
            $jabatan_new = Jabatan::create([
                'nama_jabatan' => $row['divisi']
            ]);
            $jabatan_id = $jabatan_new->id;
        }

        $lokasi = Lokasi::where('nama_lokasi', $row['lokasi'])->first();
        if ($lokasi) {
            $lokasi_id = $lokasi->id;
        } else {
            $lokasi_new = Lokasi::create([
                'nama_lokasi' => $row['lokasi'],
                'created_by' => auth()->user()->id,
                'status' => 'approved',
            ]);

            $lokasi_id = $lokasi_new->id;
        }

        $role = Role::where('name', $row['role'])->first();
        if (!$role) {
            $role_new = Role::create([
                'name' => $row['role'],
                'guard' => 'web',
            ]);
        }

        if ($row['role'] == 'admin') {
            $is_admin = 'admin';
        } else {
            $is_admin = 'user';
        }

        $user = User::create([
            "name" => $row["nama"],
            "email" => $row["email"],
            "telepon" => $row["telepon"],
            "username" => $row["username"],
            "password" => Hash::make($row['password']),
            "tgl_lahir" => $row["tanggal_lahir"],
            "gender" => $row["gender"],
            "tgl_join" => $row["tanggal_masuk_perusahaan"],
            "status_nikah" => $row['status_pernikahan'],
            "alamat" => $row['alamat'],
            "izin_cuti" => $row["cuti"],
            "izin_lainnya" => $row["izin_masuk"],
            "izin_telat" => $row['izin_telat'],
            "izin_pulang_cepat" => $row['izin_pulang_cepat'],
            "is_admin" => $is_admin,
            "masa_berlaku" => $row['masa_berlaku'],
            "jabatan_id" => $jabatan_id,
            "lokasi_id" => $lokasi_id,
            "ktp" => $row['ktp'],
            "kartu_keluarga" => $row['kartu_keluarga'],
            "bpjs_kesehatan" => $row['bpjs_kesehatan'],
            "bpjs_ketenagakerjaan" => $row['bpjs_ketenagakerjaan'],
            "npwp" => $row['npwp'],
            "no_pkwt" => $row['nomor_pkwt'],
            "no_kontrak" => $row['nomor_kontrak'],
            "tanggal_mulai_pkwt" => $row['tanggal_mulai_pkwt'],
            "tanggal_berakhir_pkwt" => $row['tanggal_berakhir_pkwt'],
            "sim" => $row['sim'],
            "nama_rekening" => $row['nama_rekening'],
            "rekening" => $row['rekening'],
            "gaji_pokok" => $row['gaji_pokok'],
            "makan_transport" => $row['makan_dan_transport'],
            "lembur" => $row['lembur'],
            "kehadiran" => $row['kehadiran'],
            "thr" => $row['thr'],
            "bonus_pribadi" => $row['bonus_pribadi'],
            "bonus_team" => $row['bonus_team'],
            "bonus_jackpot" => $row['bonus_jackpot'],
            "izin" => $row['izin'],
            "terlambat" => $row['terlambat'],
            "mangkir" => $row['mangkir'],
            "saldo_kasbon" => $row['saldo_kasbon'],
        ]);

        $user->assignRole($row['role']);
    }
}
