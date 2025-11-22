<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $title = 'Berita & Informasi';
        $search = request()->input('search');
        $berita = Berita::when($search, function ($query) use ($search) {
                    $query->where('judul', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('id', 'DESC')
                ->paginate(10)
                ->withQueryString();

        return view('berita.index', compact(
            'title',
            'berita',
        ));
    }

    public function tambah()
    {
        $title = 'Berita & Informasi';

        return view('berita.tambah', compact(
            'title',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'berita_file_path' => 'required',
        ]);

        $validated['berita_file_path'] = $request->file('berita_file_path')->store('berita_file_path');
        $validated['berita_file_name'] = $request->file('berita_file_path')->getClientOriginalName();

        Berita::create($validated);

        return redirect('/berita')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Berita & Informasi';
        $berita = Berita::find($id);

        return view('berita.edit', compact(
            'title',
            'berita',
        ));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);

        $validated = $request->validate([
            'tipe' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'berita_file_path' => 'nullable',
        ]);

        if ($request->berita_file_path) {
            $validated['berita_file_path'] = $request->file('berita_file_path')->store('berita_file_path');
            $validated['berita_file_name'] = $request->file('berita_file_path')->getClientOriginalName();
        }

        $berita->update($validated);

        return redirect('/berita')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $berita = Berita::find($id);
        $berita->delete();
        return redirect('/berita')->with('success', 'Data Berhasil Didelete');
    }

    public function beritaUser()
    {
        $title = 'Berita';
        $berita = Berita::where('tipe', 'Berita')
                ->orderBy('id', 'DESC')
                ->paginate(10)
                ->withQueryString();

        return view('berita.beritaUser', compact(
            'title',
            'berita',
        ));
    }

    public function informasiUser()
    {
        $title = 'Informasi';
        $informasi = Berita::where('tipe', 'Informasi')
                ->orderBy('id', 'DESC')
                ->paginate(10)
                ->withQueryString();

        return view('berita.informasiUser', compact(
            'title',
            'informasi',
        ));
    }

    public function beritaUserShow($id)
    {
        $title = 'Berita';
        $berita = Berita::find($id);

        return view('berita.beritaUserShow', compact(
            'title',
            'berita',
        ));
    }

    public function informasiUserShow($id)
    {
        $title = 'Informasi';
        $berita = Berita::find($id);

        return view('berita.beritaUserShow', compact(
            'title',
            'berita',
        ));
    }
}
