<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Shift;
use App\Models\Berita;
use App\Models\Lokasi;
use App\Models\Counter;
use App\Models\Jabatan;
use App\Models\Payroll;
use App\Models\Golongan;
use App\Models\Kategori;
use App\Models\settings;
use App\Models\ResetCuti;
use App\Models\Tunjangan;
use App\Models\StatusPtkp;
use App\Models\JenisKinerja;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');

        Kategori::create([
            'name' => 'Bensin Pertalite (Mobil)',
            'jumlah' => 200000,
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Bensin Pertalite (Motor)',
            'jumlah' => 100000,
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Biaya Jasa Pasang PSB (50.000)',
            'jumlah' => 50000,
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Pasang ODP (200.000)',
            'jumlah' => 200000,
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Tarik Kabel DC Backbone (500/m)',
            'jumlah' => 2000000,
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Lain-lain',
            'active' => 1,
        ]);

        Kategori::create([
            'name' => 'Pelatihan Olahraga',
            'jumlah' => 1000000,
        ]);

        settings::create([
            'name' => 'Absensi',
            'logo' => 'logo/absensi.png',
            'alamat' => 'jln. akasia 1 c.221, purwakarta, aceh',
            'phone' => '6281212099664',
            'whatsapp' => '6285183397739',
            'api_url' => 'https://wa.haihalo.com/send-message',
            'api_whatsapp' => 'AI3BsRRM9bVwBZB5zHhDjoq4SLBFBkNj',
            'email' => 'absensi@gmail.com',
        ]);

        Berita::create([
            'tipe' => 'Berita',
            'judul' => 'Berita 1',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/banner.jpg',
        ]);

        Berita::create([
            'tipe' => 'Berita',
            'judul' => 'Berita 2',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/banner2.jpg',
        ]);

        Berita::create([
            'tipe' => 'Berita',
            'judul' => 'Berita 3',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/banner3.jpg',
        ]);

        Berita::create([
            'tipe' => 'Berita',
            'judul' => 'Berita 4',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/banner4.jpg',
        ]);

        Berita::create([
            'tipe' => 'Berita',
            'judul' => 'Berita 5',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/banner5.jpg',
        ]);

        Berita::create([
            'tipe' => 'Informasi',
            'judul' => 'Informasi 1',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/informasi.png',
        ]);
        Berita::create([
            'tipe' => 'Informasi',
            'judul' => 'Informasi 2',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/informasi.png',
        ]);
        Berita::create([
            'tipe' => 'Informasi',
            'judul' => 'Informasi 3',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/informasi.png',
        ]);
        Berita::create([
            'tipe' => 'Informasi',
            'judul' => 'Informasi 4',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/informasi.png',
        ]);
        Berita::create([
            'tipe' => 'Informasi',
            'judul' => 'Informasi 5',
            'isi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi provident sed, corporis amet sint ratione tenetur rerum non repudiandae. Voluptatibus pariatur facere voluptate neque aliquid doloribus corrupti natus. Blanditiis dolore, saepe debitis autem enim molestias? Neque dicta officia officiis ut sit! Iste dolor excepturi atque quidem ipsum quam dignissimos eum neque rem. Assumenda saepe eligendi amet? Iste earum soluta deleniti facilis odio! Temporibus ut veniam minima modi voluptatibus, consequatur quidem voluptates provident ratione eaque totam similique et in perferendis molestiae incidunt aut voluptatem ad, quisquam praesentium ex beatae, fugit aperiam. Quos sit ad est aspernatur in eum accusamus, asperiores voluptatum.',
            'berita_file_path' => 'berita_file_path/informasi.png',
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'hrd',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'general_manager',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'finance',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'kepala_cabang',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'regional_manager',
            'guard_name' => 'web'
        ]);


        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'telepon' => '085171744592',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '1998-01-26',
            'status_nikah' => 'TK/1',
            'alamat' => 'jl. admin test',
            'izin_cuti' => '12',
            'izin_lainnya' => '6',
            'izin_telat' => '16',
            'izin_pulang_cepat' => '9',
            'is_admin' => 'admin',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'ktp' => 3375212601981211,
            'kartu_keluarga' => 2311876775523112,
            'bpjs_kesehatan' => 1627789654371789,
            'bpjs_ketenagakerjaan' => 2312342432556232,
            'npwp' => 2312242432556232,
            'sim' => 2312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 1255342433356232,
            'nama_rekening' => 'Ricky Ramadhan',
            'gaji_pokok' => 7000000,
            'makan_transport' => 800000,
            'lembur' => 20000,
            'kehadiran' => 300000,
            'thr' => 200000,
            'bonus_pribadi' => 200000,
            'bonus_team' => 2000000,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 220000,
        ]);

        $super_admin->assignRole('admin');

        $user1 = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'telepon' => '123456789',
            'username' => 'user',
            'password' => Hash::make('user123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'TK/0',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'User Ramadhan',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user1->assignRole('user');

        $user2 = User::create([
            'name' => 'User HRD',
            'email' => 'baim@gmail.com',
            'telepon' => '123456789',
            'username' => 'baim',
            'password' => Hash::make('baim123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'K/0',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '2',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'User Ramadhan',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user2->assignRole('hrd');

        $user3 = User::create([
            'name' => 'User GM',
            'email' => 'fauzan@gmail.com',
            'telepon' => '123456789',
            'username' => 'fauzan',
            'password' => Hash::make('fauzan123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'K/0',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '2',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'Fauzan Arya',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user3->assignRole('general_manager');

        $user4 = User::create([
            'name' => 'User Finance',
            'email' => 'Pandu@gmail.com',
            'telepon' => '123456789',
            'username' => 'pandu',
            'password' => Hash::make('pandu123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'K/0',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'Pandu Arya',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user4->assignRole('finance');

        $user5 = User::create([
            'name' => 'User Kep.Cabang',
            'email' => 'zhafira@gmail.com',
            'telepon' => '6281818607319',
            'username' => 'zhafira',
            'password' => Hash::make('zhafira123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'K/0',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'Zhafira Salsabil',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user5->assignRole('kepala_cabang');

        $user6 = User::create([
            'name' => 'User Reg.Manager',
            'email' => 'yahya@gmail.com',
            'telepon' => '081818607319',
            'username' => 'yahya',
            'password' => Hash::make('yahya123'),
            'tgl_lahir' => date('Y-m-d'),
            'gender' => 'Laki-Laki',
            'tgl_join' => '2022-01-28',
            'status_nikah' => 'K/1',
            'alamat' => 'jl. user test',
            'izin_cuti' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
            'is_admin' => 'user',
            'jabatan_id' => '1',
            'lokasi_id' => '1',
            'ktp' => 4575212601981211,
            'kartu_keluarga' => 5311876775523112,
            'bpjs_kesehatan' => 6227789654371789,
            'bpjs_ketenagakerjaan' => 9712342432556232,
            'npwp' => 7712242432556232,
            'sim' => 8312342433356232,
            'no_pkwt' => 8312342433356232,
            'no_kontrak' => 8312342433356232,
            'tanggal_mulai_pkwt' => date('Y-m-d'),
            'tanggal_berakhir_pkwt' => date('2028-10-10'),
            'rekening' => 9255342433356232,
            'nama_rekening' => 'Yahya',
            'gaji_pokok' => 10000000,
            'makan_transport' => 900000,
            'lembur' => 20000,
            'kehadiran' => 800000,
            'thr' => 700000,
            'bonus_pribadi' => 0,
            'bonus_team' => 0,
            'bonus_jackpot' => 0,
            'izin' => 100000,
            'terlambat' => 100000,
            'mangkir' => 200000,
            'saldo_kasbon' => 4000000,
        ]);

        $user6->assignRole('regional_manager');

        Jabatan::create([
            'nama_jabatan' => 'Teknologi Informasi',
            'manager' => '1'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Keuangan dan Akutansi'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Administrasi & Umum'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Humas & Pemasaran'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Sekretariat'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Direktur'
        ]);

        Golongan::create([
            'name' => 'DIREKSI'
        ]);

        Golongan::create([
            'name' => 'KABAG'
        ]);

        Golongan::create([
            'name' => 'STAFF'
        ]);

        Golongan::create([
            'name' => 'PELAKSANA'
        ]);


        Shift::create([
            'nama_shift' => "Libur",
            'jam_masuk' => "00:00",
            'jam_keluar' => "00:00",
        ]);

        Shift::create([
            'nama_shift' => "Office",
            'jam_masuk' => "08:00",
            'jam_keluar' => "17:00",
        ]);

        Shift::create([
            'nama_shift' => "Siang",
            'jam_masuk' => "13:00",
            'jam_keluar' => "21:00",
        ]);

        Shift::create([
            'nama_shift' => "Malam",
            'jam_masuk' => "21:00",
            'jam_keluar' => "07:00",
        ]);

        Lokasi::create([
            'nama_lokasi' => 'Kantor Cabang A',
            'lat_kantor' => '-6.3707314',
            'long_kantor' => '106.8138057',
            'radius' => '200',
            'status' => 'approved',
            'keterangan' => 'Office',
            'created_by' => 1,
        ]);

        Lokasi::create([
            'nama_lokasi' => 'Kantor Cabang B',
            'lat_kantor' => '-6.3707314',
            'long_kantor' => '106.8138057',
            'radius' => '200',
            'status' => 'approved',
            'keterangan' => 'Office',
            'created_by' => 1,
        ]);

        Lokasi::create([
            'nama_lokasi' => 'Gedung A',
            'lat_kantor' => '-6.3707314',
            'long_kantor' => '106.8138057',
            'radius' => '200',
            'status' => 'approved',
            'keterangan' => 'Patroli',
            'created_by' => 1,
        ]);

        Lokasi::create([
            'nama_lokasi' => 'Gedung B',
            'lat_kantor' => '-6.3707332',
            'long_kantor' => '106.81380572',
            'radius' => '200',
            'status' => 'approved',
            'keterangan' => 'Patroli',
            'created_by' => 1,
        ]);

        ResetCuti::create([
            'izin_cuti' => '10',
            'izin_dinas_luar' => '10',
            'izin_sakit' => '10',
            'izin_cek_kesehatan' => '10',
            'izin_keperluan_pribadi' => '10',
            'izin_lainnya' => '10',
            'izin_telat' => '10',
            'izin_pulang_cepat' => '10',
        ]);

        Tunjangan::create([
            'golongan_id' => 1,
            'tunjangan_makan' => '20000.00',
            'tunjangan_transport' => '20000.00'
        ]);

        Tunjangan::create([
            'golongan_id' => 2,
            'tunjangan_makan' => '30000.00',
            'tunjangan_transport' => '20000.00'
        ]);

        Tunjangan::create([
            'golongan_id' => 3,
            'tunjangan_makan' => '30000.00',
            'tunjangan_transport' => '30000.00'
        ]);


        StatusPtkp::create([
            'name' => 'TK/0',
            'ptkp_2016' => '54000000',
            'ptkp_2015' => '36000000',
            'ptkp_2009_2012' => '15840000',
        ]);
        StatusPtkp::create([
            'name' => 'TK/1',
            'ptkp_2016' => '58500000',
            'ptkp_2015' => '39000000',
            'ptkp_2009_2012' => '17160000',
        ]);

        StatusPtkp::create([
            'name' => 'TK/2',
            'ptkp_2016' => '63000000',
            'ptkp_2015' => '42000000',
            'ptkp_2009_2012' => '18480000',
        ]);
        StatusPtkp::create([
            'name' => 'TK/3',
            'ptkp_2016' => '67500000',
            'ptkp_2015' => '45000000',
            'ptkp_2009_2012' => '19800000',
        ]);

        Counter::create([
            'name' => 'Gaji',
            'text' => 'GJ',
            'counter' => 0
        ]);

        Counter::create([
            'name' => 'Target Kinerja',
            'text' => 'TK',
            'counter' => 0
        ]);

        Counter::create([
            'name' => 'Pengajuan Keuangan',
            'text' => 'PK',
            'counter' => 0
        ]);

        Counter::create([
            'name' => 'Inventory',
            'text' => 'INV',
            'counter' => 0
        ]);

        Counter::create([
            'name' => 'Penugasan',
            'counter' => 0
        ]);

        JenisKinerja::create([
            'nama' => 'Menyelesaikan Penugasan Kerja',
            'bobot' => 20,
            'detail' => 'Jika pegawai menyelesaikan Penugasan Kerja yang diberikan pimpinan'
        ]);

        JenisKinerja::create([
            'nama' => 'Menghadiri Pertemuan',
            'bobot' => 5,
            'detail' => 'Jika pegawai melakukan melakukan presensi saat pertemuan/rapat'
        ]);

        JenisKinerja::create([
            'nama' => 'Laporan Kerja',
            'bobot' => 10,
            'detail' => 'Jika pegawai melaporkan pekerjaan sesuai tugas kerjanya'
        ]);

        JenisKinerja::create([
            'nama' => 'Pulang tepat waktu',
            'bobot' => 10,
            'detail' => 'Jika pegawai tidak melakukan presensi pulang kerja'
        ]);

        JenisKinerja::create([
            'nama' => 'Pulang Sebelum waktunya',
            'bobot' => -5,
            'detail' => 'Jika pegawai melakukan melakukan presensi sebelum jam kerja selesai'
        ]);

        JenisKinerja::create([
            'nama' => 'Telat Presensi Masuk',
            'bobot' => -10,
            'detail' => 'Jika pegawai telat melakukan presensi masuk kerja'
        ]);

        JenisKinerja::create([
            'nama' => 'Presensi Kehadiran Ontime',
            'bobot' => 10,
            'detail' => 'Jika pegawai melakukan presensi masuk kerja'
        ]);


    }
}
