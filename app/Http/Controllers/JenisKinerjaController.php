<?php

namespace App\Http\Controllers;

use App\Models\JenisKinerja;
use Illuminate\Http\Request;

class JenisKinerjaController extends Controller
{
    public function index()
    {
        $title = 'Jenis Kinerja';
        $search = request()->input('search');
        $jenis_kinerja = JenisKinerja::when($search, function ($query) use ($search) {
                                        $query->where('nama', 'LIKE', '%' . $search . '%')
                                            ->orWhere('bobot', 'LIKE', '%' . $search . '%')
                                            ->orWhere('detail', 'LIKE', '%' . $search . '%');
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('jenis-kinerja.index', compact(
            'title',
            'jenis_kinerja'
        ));
    }

    public function tambah()
    {
        $title = 'Jenis Kinerja';
        return view('jenis-kinerja.tambah', compact(
            'title',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'bobot' => 'required',
            'detail' => 'nullable',
        ]);

        JenisKinerja::create($validated);

        return redirect('/jenis-kinerja')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Jenis Kinerja';
        $jenis_kinerja = JenisKinerja::find($id);
        return view('jenis-kinerja.edit', compact(
            'title',
            'jenis_kinerja',
        ));
    }

    public function update(Request $request, $id)
    {
        $jenis_kinerja = JenisKinerja::find($id);
        $validated = $request->validate([
            'nama' => 'required',
            'bobot' => 'required',
            'detail' => 'nullable',
        ]);

        $jenis_kinerja->update($validated);

        return redirect('/jenis-kinerja')->with('success', 'Data Berhasil Di Update');
    }
}
