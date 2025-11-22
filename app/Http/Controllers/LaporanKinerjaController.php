<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKinerja;

class LaporanKinerjaController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Laporan Kinerja';
        $tglskrg = date('Y-m-d');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $laporan_kinerja = LaporanKinerja::when(!$mulai && !$akhir, function ($query) use ($tglskrg) {
                                        return $query->where('tanggal', '=', $tglskrg);
                                    })
                                    ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                        return $query->whereBetween('tanggal', [$mulai, $akhir]);
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('laporan-kinerja.index', compact(
            'title',
            'laporan_kinerja'
        ));
    }
}
