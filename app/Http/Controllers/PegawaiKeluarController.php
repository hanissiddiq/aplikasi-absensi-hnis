<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use App\Models\PegawaiKeluar;

class PegawaiKeluarController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Pegawai Keluar';
        $nama = request()->input('nama');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $pegawai_keluars = PegawaiKeluar::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                $query->whereBetween('tanggal', [$mulai, $akhir]);
                            })
                            ->when($nama, function ($query) use ($nama) {
                                $query->whereHas('user', function ($q) use ($nama) {
                                    $q->where('name', 'LIKE', '%' . $nama . '%');
                                });
                            })
                            ->when(auth()->user() && auth()->user()->Jabatan && auth()->user()->Jabatan->manager != auth()->user()->id && auth()->user()->is_admin == 'user', function ($query) {
                                $query->where('user_id', auth()->user()->id);
                            })
                            ->when(auth()->user() && auth()->user()->Jabatan && auth()->user()->Jabatan->manager == auth()->user()->id && auth()->user()->is_admin == 'user', function ($query) {
                                $query->whereHas('user', function ($q) {
                                    $q->where('jabatan_id', auth()->user()->jabatan_id);
                                });
                            })
                            ->orderBy('tanggal', 'DESC')
                            ->paginate(10)
                            ->withQueryString();



        if (auth()->user()->is_admin == 'admin') {
            return view('pegawai-keluar.index', compact(
                'title',
                'pegawai_keluars'
            ));
        } else {
            return view('pegawai-keluar.indexUser', compact(
                'title',
                'pegawai_keluars'
            ));
        }

    }

    public function tambah()
    {
        $title = 'Pegawai Keluar';
        $users = User::orderBy('name')->get();

        if (auth()->user()->is_admin == 'admin') {
            return view('pegawai-keluar.tambah', compact(
                'title',
                'users',
            ));
        } else {
            return view('pegawai-keluar.tambahUser', compact(
                'title',
                'users',
            ));
        }

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'jenis' => 'required',
            'alasan' => 'required',
            'tanggal' => 'required',
            'pegawai_keluar_file_path' => 'nullable',
        ]);

        if ($request->file('pegawai_keluar_file_path')) {
            $validated['pegawai_keluar_file_path'] = $request->file('pegawai_keluar_file_path')->store('pegawai_keluar_file_path');
            $validated['pegawai_keluar_file_name'] = $request->file('pegawai_keluar_file_path')->getClientOriginalName();
        }

        $validated['status'] = 'PENDING';

        $pegawai_keluar = PegawaiKeluar::create($validated);

        $user = $pegawai_keluar->user->Jabatan->man ?? null;
        if ($user) {
            $type = 'Approval';
            $notif = 'Pengajuan Pegawai Keluar Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/exit?nama='.$pegawai_keluar->user->name.'&mulai='.$request->tanggal.'&akhir='.$request->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   => '/exit?nama='.$pegawai_keluar->user->name.'&mulai='.$request->tanggal.'&akhir='.$request->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        return redirect('/exit')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Pegawai Keluar';
        $users = User::orderBy('name')->get();
        $pegawai_keluar = PegawaiKeluar::find($id);

        if (auth()->user()->is_admin == 'admin') {
            return view('pegawai-keluar.edit', compact(
                'title',
                'users',
                'pegawai_keluar',
            ));
        } else {
            return view('pegawai-keluar.editUser', compact(
                'title',
                'users',
                'pegawai_keluar',
            ));
        }

    }

    public function update(Request $request, $id)
    {
        $pegawai_keluar = PegawaiKeluar::find($id);

        $validated = $request->validate([
            'user_id' => 'required',
            'jenis' => 'required',
            'alasan' => 'required',
            'tanggal' => 'required',
            'pegawai_keluar_file_path' => 'nullable',
        ]);

        if ($request->file('pegawai_keluar_file_path')) {
            $validated['pegawai_keluar_file_path'] = $request->file('pegawai_keluar_file_path')->store('pegawai_keluar_file_path');
            $validated['pegawai_keluar_file_name'] = $request->file('pegawai_keluar_file_path')->getClientOriginalName();
        }

        $pegawai_keluar->update($validated);

        $user = $pegawai_keluar->user->Jabatan->man ?? null;
        if ($user) {
            $type = 'Approval';
            $notif = 'Pengajuan Pegawai Keluar Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/exit?nama='.$pegawai_keluar->user->name.'&mulai='.$request->tanggal.'&akhir='.$request->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   => '/exit?nama='.$pegawai_keluar->user->name.'&mulai='.$request->tanggal.'&akhir='.$request->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        return redirect('/exit')->with('success', 'Data Berhasil Diupdate');
    }

    public function approval(Request $request, $id)
    {
        $pegawai_keluar = PegawaiKeluar::find($id);

        $validated = $request->validate([
            'status' => 'required',
            'notes' => 'nullable',
            'approved_by' => 'required',
        ]);

        $pegawai_keluar->update($validated);

        if ($pegawai_keluar->status == 'APPROVED') {
            $pegawai_keluar->user->update([
                'masa_berlaku' => $pegawai_keluar->tanggal
            ]);
        }

        return redirect('/exit')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $pegawai_keluar = PegawaiKeluar::find($id);
        $pegawai_keluar->delete();
        return redirect('/exit')->with('success', 'Data Berhasil Didelete');
    }
}
