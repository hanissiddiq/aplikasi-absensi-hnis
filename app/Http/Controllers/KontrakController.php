<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use App\Exports\KontrakExport;

class KontrakController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Kontrak Kerja';
        $nama = request()->input('nama');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $kontraks = Kontrak::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                $query->whereBetween('tanggal', [$mulai, $akhir]);
                            })
                            ->when($nama, function ($query) use ($nama) {
                                $query->whereHas('user', function ($q) use ($nama) {
                                    $q->where('name', 'LIKE', '%' . $nama . '%');
                                });
                            })
                            ->orderBy('tanggal', 'DESC')
                            ->paginate(10)
                            ->withQueryString();

        return view('kontrak.index', compact(
            'title',
            'kontraks'
        ));
    }

    public function tambah()
    {
        $title = 'Kontrak Kerja';
        $users = User::orderBy('name')->get();
        return view('kontrak.tambah', compact(
            'title',
            'users',
        ));
    }

    public function export()
    {
        return (new KontrakExport($_GET))->download('List Kontrak.xlsx');
    }

    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'tanggal' => 'required',
            'jenis_kontrak' => 'required',
            'tanggal_mulai' => 'required',
            'keterangan' => 'required',
            'kontrak_file_path' => 'nullable',
        ];

        if ($request->jenis_kontrak !== 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)') {
            $rules['tanggal_selesai'] = 'required';
        }

        $validated = $request->validate($rules);

        if ($request->file('kontrak_file_path')) {
            $validated['kontrak_file_path'] = $request->file('kontrak_file_path')->store('kontrak_file_path');
            $validated['kontrak_file_name'] = $request->file('kontrak_file_path')->getClientOriginalName();
        }

        $user = User::find($request->user_id);
        $validated['masa_berlaku_sebelumnya'] = $user->masa_berlaku;

        $kontrak = Kontrak::create($validated);

        $user->update([
            'masa_berlaku' => $kontrak->tanggal_selesai
        ]);

        return redirect('/kontrak')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Kontrak Kerja';
        $users = User::orderBy('name')->get();
        $kontrak = Kontrak::find($id);

        return view('kontrak.edit', compact(
            'title',
            'users',
            'kontrak',
        ));
    }

    public function update(Request $request, $id)
    {
        $kontrak = Kontrak::find($id);

        $rules = [
            'user_id' => 'required',
            'tanggal' => 'required',
            'jenis_kontrak' => 'required',
            'tanggal_mulai' => 'required',
            'keterangan' => 'required',
            'kontrak_file_path' => 'nullable',
        ];

        if ($request->jenis_kontrak !== 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)') {
            $rules['tanggal_selesai'] = 'required';
        }

        $validated = $request->validate($rules);

        if ($request->file('kontrak_file_path')) {
            $validated['kontrak_file_path'] = $request->file('kontrak_file_path')->store('kontrak_file_path');
            $validated['kontrak_file_name'] = $request->file('kontrak_file_path')->getClientOriginalName();
        }

        $kontrak->user->update([
            'masa_berlaku' => $kontrak->masa_berlaku_sebelumnya
        ]);

        $user = User::find($request->user_id);
        $validated['masa_berlaku_sebelumnya'] = $user->masa_berlaku;
        $kontrak->update($validated);

        $user->update([
            'masa_berlaku' => $kontrak->tanggal_selesai
        ]);

        return redirect('/kontrak')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $kontrak = Kontrak::find($id);
        $kontrak->user->update([
            'masa_berlaku' => $kontrak->masa_berlaku_sebelumnya
        ]);
        $kontrak->delete();
        return redirect('/kontrak')->with('success', 'Data Berhasil Didelete');
    }

}
