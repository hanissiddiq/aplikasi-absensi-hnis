<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Counter;
use App\Models\settings;
use App\Models\Penugasan;
use App\Models\JenisKinerja;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use App\Models\PenugasanItem;
use App\Models\LaporanKinerja;
use Illuminate\Support\Facades\Http;
use App\Notifications\UserNotification;

class PenugasanController extends Controller
{
    public function index()
    {
        $title = 'Penugasan Kerja';
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $penugasans = Penugasan::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                        return $query->whereBetween('tanggal', [$mulai, $akhir]);
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('penugasan.index', compact(
            'title',
            'penugasans'
        ));
    }

    public function tambah()
    {
        $title = 'Penugasaan';
        $users = User::orderBy('name')->get();
        return view('penugasan.tambah', compact(
            'title',
            'users',
        ));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $validated = $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'rincian' => 'required',
        ]);

        $validated['tanggal'] = date('Y-m-d');
        $validated['status'] = 'PENDING';

        $user = User::find($request->user_id);
        $counter = Counter::where('name', 'Penugasan')->first();
        $counter->update(['counter' => $counter->counter + 1]);
        $next_number = str_pad($counter->counter, 8, '0', STR_PAD_LEFT);
        $format = collect(explode(' ', $user->name))
                    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                    ->implode('');
        $validated['nomor_penugasan'] = $format . '-' . $next_number;

        $penugasan = Penugasan::create($validated);

        PenugasanItem::create([
            'penugasan_id' => $penugasan->id,
            'user_id' => auth()->user()->id,
            'flow' => 'PENDING'
        ]);

        $user = User::find($penugasan->user_id);
        $type = 'Info';
        $notif = 'Anda Memiliki Tugas Kerja Dari ' . auth()->user()->name;
        $url = url('/penugasan-kerja');

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  auth()->user()->name,
            'message'   =>  $notif,
            'action'   =>  '/penugasan-kerja'
        ];
        $user->notify(new UserNotification);

        NotifApproval::dispatch($type, $user->id, $notif, $url);

        $settings = settings::first();
        if ($settings->api_url) {
            Http::post($settings->api_url, [
                'api_key' => $settings->api_whatsapp,
                'sender' => $settings->whatsapp,
                'number' => $user->telepon,
                'message' => $notif,
                'footer' => $url,
            ]);
        }

        return redirect('/penugasan')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Penugasaan';
        $users = User::orderBy('name')->get();
        $penugasan = Penugasan::find($id);

        return view('penugasan.edit', compact(
            'title',
            'users',
            'penugasan',
        ));
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $penugasan = Penugasan::find($id);

        $validated = $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'rincian' => 'required',
        ]);

        $validated['tanggal'] = date('Y-m-d');
        $validated['status'] = 'PENDING';

        if ($request->user_id != $penugasan->user_id) {
            $user = User::find($request->user_id);
            $counter = Counter::where('name', 'Penugasan')->first();
            $counter->update(['counter' => $counter->counter + 1]);
            $next_number = str_pad($counter->counter, 8, '0', STR_PAD_LEFT);
            $format = collect(explode(' ', $user->name))
                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                        ->implode('');
            $validated['nomor_penugasan'] = $format . '-' . $next_number;
        }

        $penugasan->update($validated);

        PenugasanItem::where('penugasan_id', $penugasan->id)->delete();
        PenugasanItem::create([
            'penugasan_id' => $penugasan->id,
            'user_id' => auth()->user()->id,
            'flow' => 'PENDING'
        ]);

        $user = User::find($penugasan->user_id);
        $type = 'Info';
        $notif = 'Anda Memiliki Tugas Kerja Dari ' . auth()->user()->name;
        $url = url('/penugasan-kerja');

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  auth()->user()->name,
            'message'   =>  $notif,
            'action'   =>  '/penugasan-kerja'
        ];
        $user->notify(new UserNotification);

        NotifApproval::dispatch($type, $user->id, $notif, $url);

        $settings = settings::first();
        if ($settings->api_url) {
            Http::post($settings->api_url, [
                'api_key' => $settings->api_whatsapp,
                'sender' => $settings->whatsapp,
                'number' => $user->telepon,
                'message' => $notif,
                'footer' => $url,
            ]);
        }

        return redirect('/penugasan')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $penugasan = Penugasan::find($id);
        $penugasan->delete();
        return redirect('/penugasan')->with('success', 'Data Berhasil Didelete');
    }

    public function penugasanKerja()
    {
        $title = 'Penugasan Kerja';

        $penugasan_pending = Penugasan::where('user_id', auth()->user()->id)->where('status', 'PENDING')->paginate(10, ['*'], 'pending_page');
        $penugasan_process = Penugasan::where('user_id', auth()->user()->id)->where('status', 'PROCESS')->paginate(10, ['*'], 'process_page');
        $penugasan_finish = Penugasan::where('user_id', auth()->user()->id)->where('status', 'FINISH')->paginate(10, ['*'], 'finish_page');

        if (request()->has('process_page')) {
            $active_tab = 'process';
        } elseif (request()->has('finish_page')) {
            $active_tab = 'finish';
        } else {
            $active_tab = 'new';
        }

        return view('penugasan.penugasanKerja', compact(
            'title',
            'penugasan_pending',
            'penugasan_process',
            'penugasan_finish',
            'active_tab',
        ));
    }

    public function penugasanKerjaShow($id)
    {
        $title = 'Penugasan Kerja';
        $penugasan = Penugasan::find($id);
        return view('penugasan.penugasanKerjaShow', compact(
            'title',
            'penugasan',
        ));
    }

    public function penugasanKerjaProcess($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $penugasan = Penugasan::find($id);
        $penugasan->update([
            'status' => 'PROCESS'
        ]);

        PenugasanItem::create([
            'penugasan_id' => $penugasan->id,
            'user_id' => auth()->user()->id,
            'flow' => 'PROCESS'
        ]);

        return redirect('/penugasan-kerja')->with('success', 'Pekerjaan Berhasil Di Proses');
    }

    public function penugasanKerjaFinish($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $penugasan = Penugasan::find($id);
        $penugasan->update([
            'status' => 'FINISH'
        ]);

        PenugasanItem::create([
            'penugasan_id' => $penugasan->id,
            'user_id' => auth()->user()->id,
            'flow' => 'FINISH'
        ]);

        $jenis_kinerja = JenisKinerja::where('nama', 'Menyelesaikan Penugasan Kerja')->first();
        $laporan_kinerja_before = LaporanKinerja::where('user_id', auth()->user()->id)->latest()->first();
        if ($laporan_kinerja_before) {
            LaporanKinerja::create([
                'user_id' => auth()->user()->id,
                'tanggal' => date('Y-m-d'),
                'jenis_kinerja_id' => $jenis_kinerja->id,
                'nilai' => $jenis_kinerja->bobot,
                'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                'reference' => 'App\Models\Penugasan',
                'reference_id' => $penugasan->id,
            ]);
        } else {
            LaporanKinerja::create([
                'user_id' => auth()->user()->id,
                'tanggal' => date('Y-m-d'),
                'jenis_kinerja_id' => $jenis_kinerja->id,
                'nilai' => $jenis_kinerja->bobot,
                'penilaian_berjalan' => $jenis_kinerja->bobot,
                'reference' => 'App\Models\Penugasan',
                'reference_id' => $penugasan->id,
            ]);
        }

        return redirect('/penugasan-kerja')->with('success', 'Pekerjaan Berhasil Diselesaikan');
    }



}
