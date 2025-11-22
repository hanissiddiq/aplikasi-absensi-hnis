<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LaporanKinerja;

class KinerjaPegawaiController extends Controller
{
    public function index()
    {
        $title = 'Laporan Kinerja';
        $search = request()->input('search');
        $users = User::when($search, function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('name', 'ASC')
                    ->paginate(10)
                    ->withQueryString();

        return view('kinerja-pegawai.index', compact(
            'title',
            'users'
        ));
    }

    public function indexUser()
    {
        $title = 'Laporan Kinerja';
        $skor_akhir = LaporanKinerja::where('user_id', auth()->user()->id)->latest()->first();
        $list_penilaian = LaporanKinerja::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        $data_penilaian = LaporanKinerja::selectRaw('jenis_kinerjas.nama AS nama, COALESCE(SUM(laporan_kinerjas.nilai), 0) AS total_penilaian')
                                        ->rightJoin('jenis_kinerjas', function($join) {
                                            $join->on('jenis_kinerjas.id', '=', 'laporan_kinerjas.jenis_kinerja_id')
                                                ->where('user_id', auth()->user()->id);
                                        })
                                        ->groupBy('nama')
                                        ->get();

        return view('kinerja-pegawai.indexUser', compact(
            'title',
            'skor_akhir',
            'list_penilaian',
            'data_penilaian',
        ));
    }

}
