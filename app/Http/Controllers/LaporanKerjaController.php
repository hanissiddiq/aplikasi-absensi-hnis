<?php

namespace App\Http\Controllers;

use App\Models\LaporanKerja;
use Illuminate\Http\Request;

class LaporanKerjaController extends Controller
{
    public function index()
    {
        $title = 'Laporan Kerja';
        $search = request()->input('search');

        $laporan_kerjas = LaporanKerja::when($search, function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%'.$search.'%');
                })
                ->orWhere('informasi_umum', 'LIKE', '%'.$search.'%');
            });

        })
        ->when(auth()->user()->is_admin == 'user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
        ->orderBy('id', 'DESC')
        ->paginate(10)
        ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('laporan-kerja.index', compact(
                'title',
                'laporan_kerjas'
            ));
        } else {
            return view('laporan-kerja.indexUser', compact(
                'title',
                'laporan_kerjas'
            ));
        }
    }

    public function tambah()
    {
        $title = 'Laporan Kerja';
        return view('laporan-kerja.tambah' , compact('title'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validated = $request->validate([
            'informasi_umum' => 'required',
            'pekerjaan_dilaksanakan' => 'required',
            'pekerjaan_belum_selesai' => 'required',
            'catatan' => 'required',
        ]);

        $validated['tanggal'] = date('Y-m-d');
        $validated['user_id'] = auth()->user()->id;
        $laporan_kerja = LaporanKerja::create($validated);

        return redirect('/laporan-kerja/show/'.$laporan_kerja->id)->with('success', 'Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $title = 'Laporan Kerja';
        $laporan_kerja = LaporanKerja::find($id);
        return view('laporan-kerja.show' , compact(
            'title',
            'laporan_kerja',
        ));
    }

    public function edit($id)
    {
        $title = 'Laporan Kerja';
        $laporan_kerja = LaporanKerja::find($id);
        return view('laporan-kerja.edit' , compact(
            'title',
            'laporan_kerja',
        ));
    }

    public function update(Request $request, $id)
    {
        $laporan_kerja = LaporanKerja::find($id);

        $validated = $request->validate([
            'informasi_umum' => 'required',
            'pekerjaan_dilaksanakan' => 'required',
            'pekerjaan_belum_selesai' => 'required',
            'catatan' => 'required',
        ]);

        $laporan_kerja->update($validated);

        return redirect('/laporan-kerja/show/'.$laporan_kerja->id)->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $laporan_kerja = LaporanKerja::find($id);
        $laporan_kerja->delete();
        return redirect('/laporan-kerja')->with('success', 'Data Berhasil Didelete');
    }
}
