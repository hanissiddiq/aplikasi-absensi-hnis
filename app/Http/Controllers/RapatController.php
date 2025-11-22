<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Rapat;
use App\Models\RapatNotulen;
use App\Models\RapatPegawai;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use App\Notifications\UserNotification;

class RapatController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Rapat';
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $rapats = Rapat::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                        return $query->whereBetween('tanggal', [$mulai, $akhir]);
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('rapat.index', compact(
            'title',
            'rapats'
        ));
    }

    public function tambah()
    {
        $title = 'Rapat';
        $users = User::orderBy('name')->get();
        return view('rapat.tambah', compact(
            'title',
            'users',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required',
            'detail' => 'nullable',
            'jenis' => 'required',
        ]);

        $rapat = Rapat::create($validated);

        $user_id = $request->input('user_id', []);
        if (count($user_id) > 0) {
            $users = User::whereIn('id', $user_id)->get();
            foreach ($users as $user) {
                RapatPegawai::create([
                    'rapat_id' => $rapat->id,
                    'user_id' => $user->id,
                    'status' => 'Tidak Hadir',
                ]);

                if ($request->tanggal) {
                    Carbon::setLocale('id');
                    $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal);
                    $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                } else {
                    $new_tanggal = '-';
                }

                $type = 'Info';
                $notif = 'Undangan Rapat Pada Hari ' . $new_tanggal . ' ' . $request->jam_mulai;
                $url = url('/rapat-kerja');

                $user->messages = [
                    'user_id'   =>  auth()->user()->id,
                    'from'   =>  auth()->user()->name,
                    'message'   =>  $notif,
                    'action'   =>  '/rapat-kerja'
                ];
                $user->notify(new UserNotification);
                NotifApproval::dispatch($type, $user->id, $notif, $url);
            }
        }
        return redirect('/rapat')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Rapat';
        $users = User::orderBy('name')->get();
        $rapat = Rapat::find($id);
        $user_id = RapatPegawai::where('rapat_id', $rapat->id)->pluck('user_id')->toArray();

        return view('rapat.edit', compact(
            'title',
            'users',
            'rapat',
            'user_id',
        ));
    }

    public function update(Request $request, $id)
    {
        $rapat = Rapat::find($id);
        $validated = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'lokasi' => 'required',
            'detail' => 'nullable',
            'jenis' => 'required',
        ]);

        $rapat->update($validated);

        RapatPegawai::where('rapat_id', $rapat->id)->delete();
        $user_id = $request->input('user_id', []);
        if (count($user_id) > 0) {
            $users = User::whereIn('id', $user_id)->get();
            foreach ($users as $user) {
                RapatPegawai::create([
                    'rapat_id' => $rapat->id,
                    'user_id' => $user->id,
                    'status' => 'Tidak Hadir',
                ]);

                if ($request->tanggal) {
                    Carbon::setLocale('id');
                    $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal);
                    $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                } else {
                    $new_tanggal = '-';
                }

                $type = 'Info';
                $notif = 'Undangan Rapat Pada Hari ' . $new_tanggal . ' ' . $request->jam_mulai;
                $url = url('/rapat-kerja');

                $user->messages = [
                    'user_id'   =>  auth()->user()->id,
                    'from'   =>  auth()->user()->name,
                    'message'   =>  $notif,
                    'action'   =>  '/rapat-kerja'
                ];
                $user->notify(new UserNotification);
                NotifApproval::dispatch($type, $user->id, $notif, $url);
            }
        }
        return redirect('/rapat')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $rapat = Rapat::find($id);
        RapatPegawai::where('rapat_id', $rapat->id)->delete();
        RapatNotulen::where('rapat_id', $rapat->id)->delete();
        $rapat->delete();
        return redirect('/rapat')->with('success', 'Data Berhasil Didelete');
    }

    public function rapatKerja()
    {
        $title = 'Rapat Kerja';
        $rapats = Rapat::whereHas('pegawai', function ($query) {
                            return $query->where('user_id', auth()->user()->id);
                        })
                        ->orderBy('id', 'DESC')
                        ->paginate(10);

        return view('rapat.rapatKerja', compact(
            'title',
            'rapats',
        ));
    }

    public function rapatKerjaShow($id)
    {
        $title = 'Rapat Kerja';
        $rapat = Rapat::find($id);

        if (request()->has('hadir')) {
            $active_tab = 'hadir';
        } elseif (request()->has('notulen')) {
            $active_tab = 'notulen';
        } else {
            $active_tab = 'detail';
        }

        $mypegawai = RapatPegawai::where('rapat_id', $rapat->id)->where('user_id', auth()->user()->id)->first();

        return view('rapat.rapatKerjaShow', compact(
            'title',
            'rapat',
            'active_tab',
            'mypegawai',
        ));
    }

    public function rapatKerjaHadir($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $rapat = Rapat::find($id);
        $pegawai = RapatPegawai::where('rapat_id', $rapat->id)->where('user_id', auth()->user()->id)->first();
        if ($pegawai) {
            $pegawai->update([
                'hadir' => date('Y-m-d H:i:s'),
                'status' => 'Hadir'
            ]);
        }

        return redirect('/rapat-kerja/show/'.$rapat->id.'?hadir=yes')->with('success', 'Berhasil Hadir');
    }

    public function rapatKerjaNotulen(Request $request, $id)
    {
        $rapat = Rapat::find($id);
        $request->validate([
            'notulen' => 'required'
        ]);
        RapatNotulen::create([
            'rapat_id' => $rapat->id,
            'user_id' => auth()->user()->id,
            'notulen' => $request->notulen,
        ]);

        return redirect('/rapat-kerja/show/'.$rapat->id.'?notulen=yes')->with('success', 'Notulen Berhasil Disimpan');
    }


}
