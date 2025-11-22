<?php

use App\Models\User;
use App\Events\NotifApproval;
use App\Http\Controllers\DinasLuar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\authController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\jabatanController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\PatroliController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\karyawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AutoShiftController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\RekapDataController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\StatusPtkpController;
use App\Http\Controllers\JenisKinerjaController;
use App\Http\Controllers\LaporanKerjaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PegawaiKeluarController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\TargetKinerjaController;
use App\Http\Controllers\KinerjaPegawaiController;
use App\Http\Controllers\LaporanKinerjaController;
use App\Http\Controllers\PengajuanKeuanganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [authController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login-admin', [authController::class, 'loginAdmin'])->name('loginAdmin')->middleware('guest');
Route::get('/get-started', [authController::class, 'getStarted'])->name('getStarted')->middleware('guest');
Route::get('/welcome', [authController::class, 'welcome'])->name('welcome')->middleware('guest');

Route::get('/forgot-password', [authController::class, 'forgotPassword']);
Route::post('/forgot-password/link', [authController::class, 'forgotPasswordLink']);

Route::get('reset-password/{token}', [authController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [authController::class, 'reset'])->name('password.update');

Route::get('/qr-masuk', [authController::class, 'qrMasuk']);
Route::post('/qr-masuk/store', [authController::class, 'qrMasukStore']);

Route::get('/qr-pulang', [authController::class, 'qrPulang']);
Route::post('/qr-pulang/store', [authController::class, 'qrPulangStore']);

Route::get('/role', [RoleController::class, 'index'])->middleware('admin');
Route::get('/role/tambah', [RoleController::class, 'tambah'])->middleware('admin');
Route::post('/role/store', [RoleController::class, 'store'])->middleware('admin');
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->middleware('admin');
Route::put('/role/update/{id}', [RoleController::class, 'update'])->middleware('admin');
Route::delete('/role/delete/{id}', [RoleController::class, 'delete'])->middleware('admin');

Route::get('/switch/user', [karyawanController::class, 'switchUser'])->middleware('auth');
Route::get('/switch/admin', [karyawanController::class, 'switchAdmin'])->middleware('auth');

Route::get('/presensi', [authController::class, 'presensi']);
Route::get('/presensi-pulang', [authController::class, 'presensiPulang']);
Route::post('/presensi/store', [authController::class, 'presensiStore']);
Route::post('/presensi-pulang/store', [authController::class, 'presensiPulangStore']);
Route::get('/ajaxGetNeural', [authController::class, 'ajaxGetNeural']);
Route::get('/register', [authController::class, 'register'])->middleware('guest');
Route::post('/register-proses', [authController::class, 'registerProses'])->middleware('guest');
Route::post('/login-proses', [authController::class, 'loginProses'])->middleware('guest');
Route::post('/login-proses-user', [authController::class, 'loginProsesUser'])->middleware('guest');
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware('auth');
Route::get('/logout', [authController::class, 'logout'])->middleware('auth');
Route::get('/pegawai', [karyawanController::class, 'index'])->middleware('auth');
Route::get('/euforia', [karyawanController::class, 'euforia'])->middleware('auth');
Route::get('/pegawai/tambah-pegawai', [karyawanController::class, 'tambahKaryawan'])->middleware('admin');
Route::post('/pegawai/tambah-pegawai-proses', [karyawanController::class, 'tambahKaryawanProses'])->middleware('admin');
Route::post('/pegawai/face/ajaxPhoto', [karyawanController::class, 'ajaxPhoto'])->middleware('admin');
Route::post('/pegawai/face/ajaxDescrip', [karyawanController::class, 'ajaxDescrip'])->middleware('admin');
Route::post('/pegawai/import', [karyawanController::class, 'importUsers'])->middleware('admin');
Route::get('/pegawai/detail/{id}', [karyawanController::class, 'detail'])->middleware('admin');
Route::get('/pegawai/kontrak/{id}', [karyawanController::class, 'kontrak'])->middleware('admin');
Route::get('/pegawai/show/{id}', [karyawanController::class, 'show'])->middleware('auth');
Route::get('/pegawai/face/{id}', [karyawanController::class, 'face'])->middleware('admin');
Route::put('/pegawai/proses-edit/{id}', [karyawanController::class, 'editKaryawanProses'])->middleware('admin');
Route::delete('/pegawai/delete/{id}', [karyawanController::class, 'deleteKaryawan'])->middleware('admin');
Route::get('/pegawai/edit-password/{id}', [karyawanController::class, 'editPassword'])->middleware('admin');
Route::put('/pegawai/edit-password-proses/{id}', [karyawanController::class, 'editPasswordProses'])->middleware('admin');
Route::get('/pegawai/qrcode/{id}', [karyawanController::class, 'qrcode'])->middleware('admin');
Route::get('/pegawai/print/{id}', [karyawanController::class, 'print'])->middleware('auth');
Route::get('/kartu-pegawai', [karyawanController::class, 'kartuPegawai'])->middleware('auth');

Route::get('/pegawai/export', [karyawanController::class, 'export'])->middleware('admin');

Route::get('/exit', [PegawaiKeluarController::class, 'index'])->middleware('auth');
Route::get('/exit/tambah', [PegawaiKeluarController::class, 'tambah'])->middleware('auth');
Route::post('/exit/store', [PegawaiKeluarController::class, 'store'])->middleware('auth');
Route::get('/exit/edit/{id}', [PegawaiKeluarController::class, 'edit'])->middleware('auth');
Route::put('/exit/update/{id}', [PegawaiKeluarController::class, 'update'])->middleware('auth');
Route::delete('/exit/delete/{id}', [PegawaiKeluarController::class, 'delete'])->middleware('auth');
Route::post('/exit/approval/{id}', [PegawaiKeluarController::class, 'approval'])->middleware('auth');

Route::resource('/shift', ShiftController::class)->middleware('admin');

Route::get('/pegawai/shift/{id}', [karyawanController::class, 'shift'])->middleware('admin');
Route::get('/pegawai/dinas-luar/{id}', [karyawanController::class, 'dinasLuar'])->middleware('admin');

Route::post('/pegawai/shift/proses-tambah-shift', [karyawanController::class, 'prosesTambahShift'])->middleware('admin');
Route::post('/pegawai/dinas-luar/proses-tambah-shift', [karyawanController::class, 'prosesTambahDinas'])->middleware('admin');

Route::delete('/pegawai/delete-shift/{id}', [karyawanController::class, 'deleteShift'])->middleware('admin');
Route::delete('/pegawai/delete-dinas/{id}', [karyawanController::class, 'deleteDinas'])->middleware('admin');

Route::get('/pegawai/edit-shift/{id}', [karyawanController::class, 'editShift'])->middleware('admin');
Route::get('/pegawai/edit-dinas/{id}', [karyawanController::class, 'editDinas'])->middleware('admin');

Route::put('/pegawai/proses-edit-shift/{id}', [karyawanController::class, 'prosesEditShift'])->middleware('auth');
Route::put('/pegawai/proses-edit-dinas/{id}', [karyawanController::class, 'prosesEditDinas'])->middleware('auth');

Route::get('/kontrak', [KontrakController::class, 'index'])->middleware('admin');
Route::get('/kontrak/tambah', [KontrakController::class, 'tambah'])->middleware('admin');
Route::post('/kontrak/store', [KontrakController::class, 'store'])->middleware('admin');
Route::get('/kontrak/edit/{id}', [KontrakController::class, 'edit'])->middleware('admin');
Route::put('/kontrak/update/{id}', [KontrakController::class, 'update'])->middleware('admin');
Route::delete('/kontrak/delete/{id}', [KontrakController::class, 'delete'])->middleware('admin');
Route::get('/kontrak/export', [KontrakController::class, 'export'])->middleware('admin');

Route::get('/absen', [AbsenController::class, 'index'])->middleware('auth');
Route::get('/dinas-luar', [DinasLuar::class, 'index'])->middleware('auth');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth');
Route::get('/notifications/read', [NotificationController::class, 'read'])->middleware('auth');
Route::get('/notifications/unread', [NotificationController::class, 'unread'])->middleware('auth');
Route::get('/notifications/read-message/{id}', [NotificationController::class, 'readMessage'])->middleware('auth');

Route::get('/menu', [dashboardController::class, 'menu'])->middleware('auth');

Route::get('/my-location', [AbsenController::class, 'myLocation'])->middleware('auth');

Route::put('/absen/masuk/{id}', [AbsenController::class, 'absenMasuk'])->middleware('auth');
Route::put('/dinas-luar/masuk/{id}', [DinasLuar::class, 'absenMasukDinas'])->middleware('auth');

Route::put('/absen/pulang/{id}', [AbsenController::class, 'absenPulang'])->middleware('auth');
Route::put('/dinas-luar/pulang/{id}', [DinasLuar::class, 'absenPulangDinas'])->middleware('auth');

Route::get('/data-absen', [AbsenController::class, 'dataAbsen'])->middleware('admin');
Route::get('/data-dinas-luar', [DinasLuar::class, 'dataAbsenDinas'])->middleware('admin');

Route::get('/data-absen/{id}/edit-masuk', [AbsenController::class, 'editMasuk'])->middleware('admin');
Route::get('/maps/{lat}/{long}/{userid}', [AbsenController::class, 'maps'])->middleware('auth');
Route::put('/data-absen/{id}/proses-edit-masuk', [AbsenController::class, 'prosesEditMasuk'])->middleware('admin');
Route::get('/data-absen/{id}/edit-pulang', [AbsenController::class, 'editPulang'])->middleware('admin');
Route::put('/data-absen/{id}/proses-edit-pulang', [AbsenController::class, 'prosesEditPulang'])->middleware('admin');
Route::delete('/data-absen/{id}/delete', [AbsenController::class, 'deleteAdmin'])->middleware('admin');

Route::get('/my-absen', [AbsenController::class, 'myAbsen'])->middleware('auth');
Route::get('/my-absen/pengajuan/{id}', [AbsenController::class, 'pengajuan'])->middleware('auth');
Route::post('/my-absen/pengajuan-proses/{id}', [AbsenController::class, 'pengajuanProses'])->middleware('auth');
Route::get('/my-dinas-luar', [DinasLuar::class, 'myDinasLuar'])->middleware('auth');
Route::get('/pengajuan-absensi', [AbsenController::class, 'pengajuanAbsensi'])->middleware('auth');
Route::get('/pengajuan-absensi/edit/{id}', [AbsenController::class, 'editPengajuanAbsensi'])->middleware('auth');
Route::post('/pengajuan-absensi/update/{id}', [AbsenController::class, 'updatePengajuanAbsensi'])->middleware('auth');

Route::get('/lembur', [LemburController::class, 'index'])->middleware('auth');
Route::post('/lembur/masuk', [LemburController::class, 'masuk'])->middleware('auth');
Route::put('/lembur/pulang/{id}', [LemburController::class, 'pulang'])->middleware('auth');
Route::get('/data-lembur', [LemburController::class, 'dataLembur'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::post('/data-lembur/approval/{id}', [LemburController::class, 'approval'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::get('/my-lembur', [LemburController::class, 'myLembur'])->middleware('auth');

Route::get('/rekap-data', [RekapDataController::class, 'index'])->middleware('admin');
Route::get('/rekap-data/export', [RekapDataController::class, 'export'])->middleware('admin');
Route::get('/rekap-data/get-data', [RekapDataController::class, 'getData'])->middleware('admin');
Route::get('/rekap-data/detail-pdf', [RekapDataController::class, 'detailPdf'])->middleware('admin');
Route::get('/rekap-data/rekap-pdf', [RekapDataController::class, 'rekapPdf'])->middleware('admin');
Route::get('/rekap-data/payroll/{id}', [RekapDataController::class, 'payroll'])->middleware('admin');
Route::post('/rekap-data/payroll/tambah', [RekapDataController::class, 'tambahPayroll'])->middleware('admin');

Route::get('/cuti', [CutiController::class, 'index'])->middleware('auth');
Route::post('/cuti/tambah', [CutiController::class, 'tambah'])->middleware('auth');
Route::delete('/cuti/delete/{id}', [CutiController::class, 'delete'])->middleware('auth');
Route::get('/cuti/edit/{id}', [CutiController::class, 'edit'])->middleware('auth');
Route::put('/cuti/proses-edit/{id}', [CutiController::class, 'editProses'])->middleware('auth');
Route::get('/data-cuti', [CutiController::class, 'dataCuti'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::get('/data-cuti/tambah', [CutiController::class, 'tambahAdmin'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::post('/data-cuti/getuserid', [CutiController::class, 'getUserId'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::post('/data-cuti/proses-tambah', [CutiController::class, 'tambahAdminProses'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::delete('/data-cuti/delete/{id}', [CutiController::class, 'deleteAdmin'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::get('/data-cuti/edit/{id}', [CutiController::class, 'editAdmin'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::put('/data-cuti/edit-proses/{id}', [CutiController::class, 'editAdminProses'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::get('/my-profile', [KaryawanController::class, 'myProfile'])->middleware('auth');
Route::put('/my-profile/update/{id}', [KaryawanController::class, 'myProfileUpdate'])->middleware('auth');
Route::get('/my-profile/edit-password', [KaryawanController::class, 'editPassMyProfile'])->middleware('auth');
Route::put('/my-profile/edit-password-proses/{id}', [KaryawanController::class, 'editPassMyProfileProses'])->middleware('auth');

Route::get('/lokasi-kantor', [LokasiController::class, 'index'])->middleware('admin');
Route::get('/lokasi-kantor/tambah', [LokasiController::class, 'tambahLokasi'])->middleware('admin');
Route::post('/lokasi-kantor/tambah-proses', [LokasiController::class, 'prosesTambahLokasi'])->middleware('admin');
Route::get('/lokasi-kantor/edit/{id}', [LokasiController::class, 'editLokasi'])->middleware('admin');
Route::put('/lokasi-kantor/update/{id}', [LokasiController::class, 'updateLokasi'])->middleware('admin');
Route::put('/lokasi-kantor/radius/{id}', [LokasiController::class, 'updateRadiusLokasi'])->middleware('admin');
Route::delete('/lokasi-kantor/delete/{id}', [LokasiController::class, 'deleteLokasi'])->middleware('admin');
Route::get('/lokasi-kantor/pending-location', [LokasiController::class, 'pendingLocation'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::put('/lokasi-kantor/update-pending-location/{id}', [LokasiController::class, 'UpdatePendingLocation'])->middleware('role:admin|hrd|kepala_cabang|general_manager');
Route::get('/lokasi-kantor/qrcode/{id}', [LokasiController::class, 'qrcode'])->middleware('admin');
Route::get('/lokasi-kantor/print/{id}', [LokasiController::class, 'print'])->middleware('admin');

Route::get('/request-location', [LokasiController::class, 'requestLocation'])->middleware('auth');
Route::get('/request-location/tambah', [LokasiController::class, 'tambahRequestLocation'])->middleware('auth');
Route::post('/request-location/tambah-proses', [LokasiController::class, 'prosesTambahRequestLocation'])->middleware('auth');
Route::get('/request-location/edit/{id}', [LokasiController::class, 'editRequestLocation'])->middleware('auth');
Route::put('/request-location/update/{id}', [LokasiController::class, 'updateRequestLocation'])->middleware('auth');
Route::put('/request-location/radius/{id}', [LokasiController::class, 'updateRadiusRequestLocation'])->middleware('auth');
Route::delete('/request-location/delete/{id}', [LokasiController::class, 'deleteRequestLocation'])->middleware('auth');

Route::get('/reset-cuti', [KaryawanController::class, 'resetCuti'])->middleware('admin');
Route::put('/reset-cuti/{id}', [KaryawanController::class, 'resetCutiProses'])->middleware('admin');

Route::get('/jabatan', [jabatanController::class, 'index'])->middleware('admin');
Route::get('/jabatan/create', [jabatanController::class, 'create'])->middleware('admin');
Route::post('/jabatan/insert', [jabatanController::class, 'insert'])->middleware('admin');
Route::get('/jabatan/edit/{id}', [jabatanController::class, 'edit'])->middleware('admin');
Route::put('/jabatan/update/{id}', [jabatanController::class, 'update'])->middleware('admin');
Route::delete('/jabatan/delete/{id}', [jabatanController::class, 'delete'])->middleware('admin');

Route::get('/golongan', [GolonganController::class, 'index'])->middleware('admin');
Route::get('/golongan/tambah', [GolonganController::class, 'tambah'])->middleware('admin');
Route::post('/golongan/tambah-proses', [GolonganController::class, 'tambahProses'])->middleware('admin');
Route::get('/golongan/edit/{id}', [GolonganController::class, 'edit'])->middleware('admin');
Route::put('/golongan/update/{id}', [GolonganController::class, 'update'])->middleware('admin');
Route::delete('/golongan/delete/{id}', [GolonganController::class, 'delete'])->middleware('admin');

Route::get('/dokumen', [DokumenController::class, 'index'])->middleware('admin');
Route::get('/dokumen/tambah', [DokumenController::class, 'tambah'])->middleware('admin');
Route::post('/dokumen/tambah-proses', [DokumenController::class, 'tambahProses'])->middleware('admin');
Route::get('/dokumen/edit/{id}', [DokumenController::class, 'edit'])->middleware('admin');
Route::put('/dokumen/edit-proses/{id}', [DokumenController::class, 'editProses'])->middleware('admin');
Route::delete('/dokumen/delete/{id}', [DokumenController::class, 'delete'])->middleware('admin');
Route::get('/my-dokumen', [DokumenController::class, 'myDokumen'])->middleware('auth');
Route::get('/my-dokumen/tambah', [DokumenController::class, 'myDokumenTambah'])->middleware('auth');
Route::post('/my-dokumen/tambah-proses', [DokumenController::class, 'myDokumenTambahProses'])->middleware('auth');
Route::get('/my-dokumen/edit/{id}', [DokumenController::class, 'myDokumenEdit'])->middleware('auth');
Route::put('/my-dokumen/edit-proses/{id}', [DokumenController::class, 'myDokumenEditProses'])->middleware('auth');
Route::delete('/my-dokumen/delete/{id}', [DokumenController::class, 'myDokumenDelete'])->middleware('auth');

Route::get('/auto-shift', [AutoShiftController::class, 'index'])->middleware('admin');
Route::get('/auto-shift/tambah', [AutoShiftController::class, 'tambah'])->middleware('admin');
Route::post('/auto-shift/store', [AutoShiftController::class, 'store'])->middleware('admin');
Route::get('/auto-shift/{id}/edit', [AutoShiftController::class, 'edit'])->middleware('admin');
Route::put('/auto-shift/update/{id}', [AutoShiftController::class, 'update'])->middleware('admin');
Route::delete('/auto-shift/delete/{id}', [AutoShiftController::class, 'delete'])->middleware('admin');

Route::get('/file', [FileController::class, 'index'])->middleware('admin');
Route::get('/file/upload', [FileController::class, 'upload'])->middleware('admin');
Route::post('/file/upload-proses', [FileController::class, 'uploadProses'])->middleware('admin');
Route::get('/file/edit/{id}', [FileController::class, 'edit'])->middleware('admin');
Route::put('/file/update/{id}', [FileController::class, 'update'])->middleware('admin');
Route::delete('/file/delete/{id}', [FileController::class, 'delete'])->middleware('admin');

Route::get('/my-file', [FileController::class, 'myFile'])->middleware('auth');
Route::get('/my-file/upload', [FileController::class, 'myFileUpload'])->middleware('auth');
Route::post('/my-file/upload-proses', [FileController::class, 'myFileUploadProses'])->middleware('auth');
Route::get('/my-file/edit/{id}', [FileController::class, 'myFileEdit'])->middleware('auth');
Route::put('/my-file/update/{id}', [FileController::class, 'myFileUpdate'])->middleware('auth');
Route::delete('/my-file/delete/{id}', [FileController::class, 'myFileDelete'])->middleware('auth');

Route::get('/tunjangan', [TunjanganController::class, 'index'])->middleware('admin');
Route::get('/tunjangan/tambah', [TunjanganController::class, 'tambah'])->middleware('admin');
Route::post('/tunjangan/tambah-proses', [TunjanganController::class, 'tambahProses'])->middleware('admin');
Route::get('/tunjangan/{id}/edit', [TunjanganController::class, 'edit'])->middleware('admin');
Route::put('/tunjangan/{id}/update', [TunjanganController::class, 'update'])->middleware('admin');
Route::delete('/tunjangan/{id}/delete', [TunjanganController::class, 'delete'])->middleware('admin');

Route::get('/payroll', [PayrollController::class, 'index'])->middleware('auth');
Route::get('/payroll/tambah', [PayrollController::class, 'tambah'])->middleware('admin');
Route::post('/payroll/tambah-proses', [PayrollController::class, 'tambahProses'])->middleware('admin');
Route::get('/payroll/{id}/edit', [PayrollController::class, 'edit'])->middleware('admin');
Route::get('/payroll/{id}/download', [PayrollController::class, 'download'])->middleware('auth');
Route::put('/payroll/{id}/update', [PayrollController::class, 'update'])->middleware('admin');
Route::delete('/payroll/{id}/delete', [PayrollController::class, 'delete'])->middleware('admin');

Route::get('/kasbon', [KasbonController::class, 'index'])->middleware('auth');
Route::get('/kasbon/tambah', [KasbonController::class, 'tambah'])->middleware('auth');
Route::post('/kasbon/tambah-proses', [KasbonController::class, 'tambahProses'])->middleware('auth');
Route::get('/kasbon/edit/{id}', [KasbonController::class, 'edit'])->middleware('auth');
Route::put('/kasbon/update/{id}', [KasbonController::class, 'update'])->middleware('auth');
Route::delete('/kasbon/delete/{id}', [KasbonController::class, 'delete'])->middleware('auth');

Route::get('/status-ptkp', [StatusPtkpController::class, 'index'])->middleware('admin');
Route::get('/status-ptkp/tambah', [StatusPtkpController::class, 'tambah'])->middleware('admin');
Route::post('/status-ptkp/tambah-proses', [StatusPtkpController::class, 'tambahProses'])->middleware('admin');
Route::get('/status-ptkp/{id}/edit', [StatusPtkpController::class, 'edit'])->middleware('admin');
Route::put('/status-ptkp/{id}/update', [StatusPtkpController::class, 'update'])->middleware('admin');
Route::delete('/status-ptkp/{id}/delete', [StatusPtkpController::class, 'delete'])->middleware('admin');

Route::get('/pajak-pph21', [PajakController::class, 'index'])->middleware('admin');
Route::get('/pajak-pph21/tambah', [PajakController::class, 'tambah'])->middleware('admin');
Route::post('/pajak-pph21/tambah-proses', [PajakController::class, 'tambahProses'])->middleware('admin');
Route::get('/pajak-pph21/{id}/edit', [PajakController::class, 'edit'])->middleware('admin');
Route::put('/pajak-pph21/{id}/update', [PajakController::class, 'update'])->middleware('admin');
Route::delete('/pajak-pph21/{id}/delete', [PajakController::class, 'delete'])->middleware('admin');

Route::get('/data-absen/export', [AbsenController::class, 'exportDataAbsen'])->middleware('admin');

Route::get('/settings', [SettingsController::class, 'index'])->middleware('admin');
Route::post('/settings/store', [SettingsController::class, 'store'])->middleware('admin');

Route::get('/kategori', [KategoriController::class, 'index'])->middleware('admin');
Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->middleware('admin');
Route::post('/kategori/store', [KategoriController::class, 'store'])->middleware('admin');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->middleware('admin');
Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->middleware('admin');
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'delete'])->middleware('admin');

Route::get('/reimbursement', [ReimbursementController::class, 'index'])->middleware('auth');
Route::get('/reimbursement/tambah', [ReimbursementController::class, 'tambah'])->middleware('auth');
Route::post('/reimbursement/store', [ReimbursementController::class, 'store'])->middleware('auth');
Route::get('/reimbursement/edit/{id}', [ReimbursementController::class, 'edit'])->middleware('auth');
Route::put('/reimbursement/update/{id}', [ReimbursementController::class, 'update'])->middleware('auth');
Route::post('/reimbursement/approval/{id}', [ReimbursementController::class, 'approval'])->middleware('auth');
Route::delete('/reimbursement/delete/{id}', [ReimbursementController::class, 'delete'])->middleware('auth');
Route::post('/reimbursement/getKategori', [ReimbursementController::class, 'getKategori'])->middleware('auth');

Route::get('/kunjungan', [KunjunganController::class, 'index'])->middleware('auth');
Route::get('/kunjungan', [KunjunganController::class, 'index'])->middleware('auth');
Route::get('/kunjungan/tambah', [KunjunganController::class, 'tambah'])->middleware('auth');
Route::post('/kunjungan/store', [KunjunganController::class, 'store'])->middleware('auth');
Route::get('/kunjungan/edit/{id}', [KunjunganController::class, 'edit'])->middleware('auth');
Route::get('/kunjungan/visit-out/{id}', [KunjunganController::class, 'visitOut'])->middleware('auth');
Route::put('/kunjungan/visit-out/update/{id}', [KunjunganController::class, 'visitOutUpdate'])->middleware('auth');
Route::put('/kunjungan/update/{id}', [KunjunganController::class, 'update'])->middleware('auth');
Route::delete('/kunjungan/delete/{id}', [KunjunganController::class, 'delete'])->middleware('auth');
Route::get('/kunjungan/export', [KunjunganController::class, 'export'])->middleware('auth');

Route::get('/jenis-kinerja', [JenisKinerjaController::class, 'index'])->middleware('auth');
Route::get('/jenis-kinerja/tambah', [JenisKinerjaController::class, 'tambah'])->middleware('auth');
Route::post('/jenis-kinerja/store', [JenisKinerjaController::class, 'store'])->middleware('auth');
Route::get('/jenis-kinerja/edit/{id}', [JenisKinerjaController::class, 'edit'])->middleware('auth');
Route::put('/jenis-kinerja/update/{id}', [JenisKinerjaController::class, 'update'])->middleware('auth');

Route::get('/laporan-kinerja', [LaporanKinerjaController::class, 'index'])->middleware('auth');

Route::get('/kinerja-pegawai', [KinerjaPegawaiController::class, 'index'])->middleware('auth');
Route::get('/kinerja-pegawai-user', [KinerjaPegawaiController::class, 'indexUser'])->middleware('auth');

Route::get('/penugasan', [PenugasanController::class, 'index'])->middleware('admin');
Route::get('/penugasan/tambah', [PenugasanController::class, 'tambah'])->middleware('admin');
Route::post('/penugasan/store', [PenugasanController::class, 'store'])->middleware('admin');
Route::get('/penugasan/edit/{id}', [PenugasanController::class, 'edit'])->middleware('admin');
Route::put('/penugasan/update/{id}', [PenugasanController::class, 'update'])->middleware('admin');
Route::delete('/penugasan/delete/{id}', [PenugasanController::class, 'delete'])->middleware('admin');

Route::get('/penugasan-kerja', [PenugasanController::class, 'penugasanKerja'])->middleware('auth');
Route::get('/penugasan-kerja/show/{id}', [PenugasanController::class, 'penugasanKerjaShow'])->middleware('auth');
Route::get('/penugasan-kerja/process/{id}', [PenugasanController::class, 'penugasanKerjaProcess'])->middleware('auth');
Route::get('/penugasan-kerja/finish/{id}', [PenugasanController::class, 'penugasanKerjaFinish'])->middleware('auth');

Route::get('/rapat', [RapatController::class, 'index'])->middleware('admin');
Route::get('/rapat/tambah', [RapatController::class, 'tambah'])->middleware('admin');
Route::post('/rapat/store', [RapatController::class, 'store'])->middleware('admin');
Route::get('/rapat/edit/{id}', [RapatController::class, 'edit'])->middleware('admin');
Route::put('/rapat/update/{id}', [RapatController::class, 'update'])->middleware('admin');
Route::delete('/rapat/delete/{id}', [RapatController::class, 'delete'])->middleware('admin');

Route::get('/rapat-kerja', [RapatController::class, 'rapatKerja'])->middleware('auth');
Route::get('/rapat-kerja/show/{id}', [RapatController::class, 'rapatKerjaShow'])->middleware('auth');
Route::get('/rapat-kerja/hadir/{id}', [RapatController::class, 'rapatKerjaHadir'])->middleware('auth');
Route::post('/rapat-kerja/notulen/{id}', [RapatController::class, 'rapatKerjaNotulen'])->middleware('auth');

Route::get('/inventory', [InventoryController::class, 'index'])->middleware('auth');
Route::get('/inventory/tambah', [InventoryController::class, 'tambah'])->middleware('auth');
Route::post('/inventory/store', [InventoryController::class, 'store'])->middleware('auth');
Route::get('/inventory/edit/{id}', [InventoryController::class, 'edit'])->middleware('auth');
Route::put('/inventory/update/{id}', [InventoryController::class, 'update'])->middleware('auth');
Route::delete('/inventory/delete/{id}', [InventoryController::class, 'delete'])->middleware('auth');

Route::get('/patroli', [PatroliController::class, 'index'])->middleware('auth');
Route::post('/patroli/store', [PatroliController::class, 'store'])->middleware('auth');
Route::get('/patroli/maps/{lat}/{long}/{lokasi_id}', [PatroliController::class, 'maps'])->middleware('auth');
Route::get('/data-patroli', [PatroliController::class, 'data'])->middleware('auth');
Route::delete('/data-patroli/delete/{id}', [PatroliController::class, 'delete'])->middleware('auth');
Route::get('/data-patroli/export-excel', [PatroliController::class, 'excel'])->middleware('auth');
Route::get('/data-patroli/export-pdf', [PatroliController::class, 'pdf'])->middleware('auth');

Route::get('/target-kinerja', [TargetKinerjaController::class, 'index'])->middleware('auth');
Route::get('/detail-target-kinerja', [TargetKinerjaController::class, 'detail'])->middleware('auth');
Route::get('/target-kinerja/tambah', [TargetKinerjaController::class, 'tambah'])->middleware('auth');
Route::post('/target-kinerja/store', [TargetKinerjaController::class, 'store'])->middleware('auth');
Route::get('/target-kinerja/edit/{id}', [TargetKinerjaController::class, 'edit'])->middleware('auth');
Route::put('/target-kinerja/update/{id}', [TargetKinerjaController::class, 'update'])->middleware('auth');
Route::delete('/target-kinerja/delete/{id}', [TargetKinerjaController::class, 'delete'])->middleware('auth');
Route::get('/target-kinerja/list/{id}', [TargetKinerjaController::class, 'list'])->middleware('auth');
Route::get('/target-kinerja/show/{tkt_id}/{tk_id}', [TargetKinerjaController::class, 'show'])->middleware('auth');
Route::get('/target-kinerja/edit-user/{tkt_id}/{tk_id}', [TargetKinerjaController::class, 'editUser'])->middleware('auth');
Route::put('/target-kinerja/update-user/{tkt_id}/{tk_id}', [TargetKinerjaController::class, 'updateUser'])->middleware('auth');
Route::post('/target-kinerja/ajaxUserJabatan', [TargetKinerjaController::class, 'ajaxUserJabatan'])->middleware('auth');

Route::get('/laporan-kerja', [LaporanKerjaController::class, 'index'])->middleware('auth');
Route::get('/laporan-kerja/tambah', [LaporanKerjaController::class, 'tambah'])->middleware('auth');
Route::post('/laporan-kerja/store', [LaporanKerjaController::class, 'store'])->middleware('auth');
Route::get('/laporan-kerja/show/{id}', [LaporanKerjaController::class, 'show'])->middleware('auth');
Route::get('/laporan-kerja/edit/{id}', [LaporanKerjaController::class, 'edit'])->middleware('auth');
Route::put('/laporan-kerja/update/{id}', [LaporanKerjaController::class, 'update'])->middleware('auth');
Route::delete('/laporan-kerja/delete/{id}', [LaporanKerjaController::class, 'delete'])->middleware('auth');

Route::get('/pengajuan-keuangan', [PengajuanKeuanganController::class, 'index'])->middleware('auth');
Route::get('/pengajuan-keuangan/tambah', [PengajuanKeuanganController::class, 'tambah'])->middleware('auth');
Route::post('/pengajuan-keuangan/store', [PengajuanKeuanganController::class, 'store'])->middleware('auth');
Route::get('/pengajuan-keuangan/show/{id}', [PengajuanKeuanganController::class, 'show'])->middleware('auth');
Route::get('/pengajuan-keuangan/edit/{id}', [PengajuanKeuanganController::class, 'edit'])->middleware('auth');
Route::put('/pengajuan-keuangan/update/{id}', [PengajuanKeuanganController::class, 'update'])->middleware('auth');
Route::get('/pengajuan-keuangan/delete/{id}', [PengajuanKeuanganController::class, 'delete'])->middleware('auth');
Route::get('/pengajuan-keuangan/accept/{id}', [PengajuanKeuanganController::class, 'accept'])->middleware('auth');
Route::post('/pengajuan-keuangan/nota/{id}', [PengajuanKeuanganController::class, 'nota'])->middleware('auth');

Route::get('/list-pengajuan-keuangan', [PengajuanKeuanganController::class, 'list'])->middleware('auth');
Route::get('/list-pengajuan-keuangan/excel', [PengajuanKeuanganController::class, 'excel'])->middleware('auth');
Route::post('/list-pengajuan-keuangan/approval/{id}', [PengajuanKeuanganController::class, 'approval'])->middleware('auth');
Route::get('/list-pengajuan-keuangan/close/{id}', [PengajuanKeuanganController::class, 'close'])->middleware('auth');
Route::get('/list-pengajuan-keuangan/pdf/{id}', [PengajuanKeuanganController::class, 'pdf'])->middleware('auth');

Route::get('/berita', [BeritaController::class, 'index'])->middleware('auth');
Route::get('/berita/tambah', [BeritaController::class, 'tambah'])->middleware('auth');
Route::post('/berita/store', [BeritaController::class, 'store'])->middleware('auth');
Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->middleware('auth');
Route::put('/berita/update/{id}', [BeritaController::class, 'update'])->middleware('auth');
Route::delete('/berita/delete/{id}', [BeritaController::class, 'delete'])->middleware('auth');

Route::get('/berita-user', [BeritaController::class, 'beritaUser'])->middleware('auth');
Route::get('/berita-user/show/{id}', [BeritaController::class, 'beritaUserShow'])->middleware('auth');
Route::get('/informasi-user', [BeritaController::class, 'informasiUser'])->middleware('auth');
Route::get('/informasi-user/show/{id}', [BeritaController::class, 'informasiUserShow'])->middleware('auth');

Route::get('/switch/{id}', [authController::class, 'switch'])->middleware('auth');

Route::get('/reset', function () {
    Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('migrate:fresh --seed');
    Artisan::call('storage:link');
});
