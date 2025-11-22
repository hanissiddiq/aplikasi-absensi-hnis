<?php

namespace App\Http\Controllers;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Berita;
use App\Models\Kasbon;
use App\Models\Lembur;
use App\Models\Payroll;
use App\Models\ResetCuti;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use App\Models\Reimbursement;

class dashboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg = date("Y-m-d");
        $tahun_skrg = date('Y');
        $bulan_skrg = date('m');
        $jmlh_bulan = cal_days_in_month(CAL_GREGORIAN,$bulan_skrg,$tahun_skrg);
        $tgl_mulai = date('Y-m-01');
        $tgl_akhir = date('Y-m-'.$jmlh_bulan);

        if(auth()->user()->is_admin == "admin"){
            return view('dashboard.index', [
                'title' => 'Dashboard',
                'jumlah_user' => User::count(),
                'jumlah_masuk' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Masuk')->count(),
                'jumlah_libur' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Libur')->count(),
                'jumlah_cuti' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Cuti')->count(),
                'jumlah_sakit' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Sakit')->count(),
                'jumlah_izin_masuk' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Masuk')->count(),
                'jumlah_izin_telat' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Telat')->count(),
                'jumlah_izin_pulang_cepat' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Pulang Cepat')->count(),
                'jumlah_karyawan_lembur' => Lembur::where('tanggal', $tgl_skrg)->count(),
                'payroll' => Payroll::where('bulan', date('m'))->where('tahun', date('Y'))->sum('grand_total'),
                'kasbon' => Kasbon::whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->where('status', 'Acc')->sum('nominal'),
                'reimbursement' => Reimbursement::whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->where('status', 'Approved')->sum('total')
            ]);
        } else {
            $user_login = auth()->user()->id;
            $tanggal = "";
            $tglskrg = date('Y-m-d');
            $tglkmrn = date('Y-m-d', strtotime('-1 days'));
            $mapping_shift = MappingShift::where('user_id', $user_login)->where('tanggal', $tglkmrn)->get();
            if($mapping_shift->count() > 0) {
                foreach($mapping_shift as $mp) {
                    $jam_absen = $mp->jam_absen;
                    $jam_pulang = $mp->jam_pulang;
                }
            } else {
                $jam_absen = "-";
                $jam_pulang = "-";
            }
            if($jam_absen != null && $jam_pulang == null) {
                $tanggal = $tglkmrn;
            } else {
                $tanggal = $tglskrg;
            }

            $berita = Berita::where('tipe', 'Berita')->orderBy('id', 'DESC')->limit(4)->get();
            $informasi = Berita::where('tipe', 'Informasi')->orderBy('id', 'DESC')->limit(4)->get();
            return view('dashboard.indexUser', [
                'title' => 'Dashboard',
                'berita' => $berita,
                'informasi' => $informasi,
                'shift_karyawan' => MappingShift::where('user_id', $user_login)->where('tanggal', $tanggal)->first()
            ]);
        }
    }

    public function menu()
    {
        return view('dashboard.menu', [
            'title' => 'All Menu',
        ]);
    }
}
