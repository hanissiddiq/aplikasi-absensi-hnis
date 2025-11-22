<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use App\Exports\KunjunganExport;

class KunjunganController extends Controller
{
    public function index()
    {
        $title = 'Kunjungan';
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $user_id = request()->input('user_id');
        $users = User::orderBy('name')->get();
        $kunjungan = Kunjungan::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                    })
                    ->when($user_id, function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    })
                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->orderBy('tanggal', 'DESC')
                    ->paginate(10)
                    ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.index', compact(
                'title',
                'kunjungan',
                'users',
            ));
        } else {
            return view('kunjungan.indexUser', compact(
                'title',
                'kunjungan'
            ));
        }
    }

    public function tambah()
    {
        $title = 'Visit In';
        $user = User::orderBy('name', 'ASC')->get();
        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.tambah', compact(
                'title',
                'user',
            ));
        } else {
            return view('kunjungan.tambahUser', compact(
                'title',
                'user',
            ));
        }
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validated = $request->validate([
            'user_id' => 'required',
            'lat_in' => 'required',
            'long_in' => 'required',
            'keterangan_in' => 'required',
            'foto_in' => 'required|max:10240',
        ]);

        $validated['tanggal'] = date('Y-m-d');
        $validated['visit_in'] = date('Y-m-d H:i:s');
        if ($request->file('foto_in')) {
            $validated['foto_in'] = $request->file('foto_in')->store('foto_in');
        }

        Kunjungan::create($validated);
        return redirect('/kunjungan')->with('success', 'Data Berhasil Disimpan');
    }

    public function visitOut($id)
    {
        $title = 'Visit Out';
        $user = User::orderBy('name', 'ASC')->get();
        $kunjungan = Kunjungan::find($id);
        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.visitOut', compact(
                'title',
                'user',
                'kunjungan',
            ));
        } else {
            return view('kunjungan.visitOutUser', compact(
                'title',
                'user',
                'kunjungan',
            ));
        }
    }

    public function visitOutUpdate(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $kunjungan = Kunjungan::find($id);
        $validated = $request->validate([
            'lat_out' => 'required',
            'long_out' => 'required',
            'keterangan_out' => 'required',
            'foto_out' => 'required|max:10240',
            'status' => 'nullable',
        ]);

        $validated['visit_out'] = date('Y-m-d H:i:s');
        if ($request->file('foto_out')) {
            $validated['foto_out'] = $request->file('foto_out')->store('foto_out');
        }

        $kunjungan->update($validated);
        return redirect('/kunjungan')->with('success', 'Data Berhasil Diupdate');
    }

    public function edit($id)
    {
        $title = 'Kunjungan';
        $user = User::orderBy('name', 'ASC')->get();
        $kunjungan = Kunjungan::find($id);
        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.edit', compact(
                'title',
                'user',
                'kunjungan',
            ));
        } else {
            return view('kunjungan.editUser', compact(
                'title',
                'user',
                'kunjungan',
            ));
        }
    }

    public function update(Request $request, $id)
    {
        $kunjungan = Kunjungan::find($id);
        $validated = $request->validate([
            'user_id' => 'required',
            'foto_in' => 'max:10240',
            'foto_out' => 'max:10240',
            'keterangan_in' => 'nullable',
            'keterangan_out' => 'nullable',
            'status' => 'nullable',
        ]);

        if ($request->file('foto_in')) {
            $validated['foto_in'] = $request->file('foto_in')->store('foto_in');
        }

        if ($request->file('foto_out')) {
            $validated['foto_out'] = $request->file('foto_out')->store('foto_out');
        }

        $kunjungan->update($validated);
        return redirect('/kunjungan')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $kunjungan = Kunjungan::find($id);
        $kunjungan->delete();
        return redirect('/kunjungan')->with('success', 'Data Berhasil Dihapus');
    }

    public function export()
    {
        return (new KunjunganExport($_GET))->download('List Kunjungan.xlsx');
    }

}
