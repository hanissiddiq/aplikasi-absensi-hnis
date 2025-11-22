<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Counter;
use App\Models\settings;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use App\Models\PengajuanKeuangan;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanKeuanganItem;
use App\Exports\PengajuanKeuanganExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanKeuanganController extends Controller
{
    public function index()
    {
        $title = 'Pengajuan Keuangan';
        $search = request()->input('search');

        $pengajuan_keuangans = PengajuanKeuangan::when($search, function ($query) use ($search) {
                                        $query->where('nomor', 'LIKE', '%' . $search . '%')
                                        ->whereHas('user', function ($q) use ($search) {
                                            $q->where('name', 'LIKE', '%' . $search . '%');
                                        });
                                    })
                                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                                        $query->where('user_id', auth()->user()->id);
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('pengajuan-keuangan.index', compact(
            'title',
            'pengajuan_keuangans'
        ));
    }

    public function tambah()
    {
        $title = 'Pengajuan Keuangan';

        if (!old('nomor')) {
            $counter = Counter::where('name', 'Pengajuan Keuangan')->first();
            $counter->update(['counter' => $counter->counter + 1]);
            $next_number = str_pad($counter->counter, 6, '0', STR_PAD_LEFT);
            $nomor = $counter->text . '/' . $next_number;
        } else {
            $nomor = old('nomor');
        }

        return view('pengajuan-keuangan.tambah', compact(
            'title',
            'nomor'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
            'total_harga' => 'required',
            'keterangan' => 'nullable',
            'pk_file_path' => 'nullable',
        ]);

        $validated['total_harga'] = str_replace(',', '', $validated['total_harga']);
        $validated['status'] = 'PENDING';

        if ($request->file('pk_file_path')) {
            $validated['pk_file_path'] = $request->file('pk_file_path')->store('pk_file_path');
            $validated['pk_file_name'] = $request->file('pk_file_path')->getClientOriginalName();
        }

        $pk = PengajuanKeuangan::create($validated);

        $nama = $request->input('nama', []);
        $qty = $request->input('qty', []);
        $harga = $request->input('harga', []);
        $total = $request->input('total', []);

        for ($i = 0; $i < count($nama); $i++) {
            PengajuanKeuanganItem::create([
                'pengajuan_keuangan_id' => $pk->id,
                'nama' => $nama[$i],
                'qty' => $qty[$i],
                'harga' => $harga[$i] ? str_replace(',', '', $harga[$i]) : 0,
                'total' => $total[$i] ? str_replace(',', '', $total[$i]) : 0,
            ]);
        }

        $users = User::whereHas('roles', function ($query) use ($pk) {
            $query->where('name', 'admin')
            ->when($pk->total_harga <= 1000000, function ($q) {
                $q->orWhere('name', 'finance');
            })
            ->orWhere('name', 'regional_manager')
            ->orWhere('name', 'general_manager');
        })->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan Keuangan Nomor ' . $pk->nomor . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('list-pengajuan-keuangan?pk_id='.$pk->id);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  'list-pengajuan-keuangan?pk_id='.$pk->id
            ];
            $user->notify(new \App\Notifications\UserNotification);

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
        }

        return redirect('/pengajuan-keuangan/show/'.$pk->id)->with('success', 'Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $title = 'Pengajuan Keuangan';
        $pk = PengajuanKeuangan::find($id);

        return view('pengajuan-keuangan.show', compact(
            'title',
            'pk'
        ));
    }

    public function edit($id)
    {
        $title = 'Pengajuan Keuangan';
        $pk = PengajuanKeuangan::find($id);

        return view('pengajuan-keuangan.edit', compact(
            'title',
            'pk'
        ));
    }

    public function update(Request $request, $id)
    {
        $pk = PengajuanKeuangan::find($id);

        $validated = $request->validate([
            'user_id' => 'required',
            'nomor' => 'required',
            'tanggal' => 'required',
            'total_harga' => 'required',
            'keterangan' => 'nullable',
            'pk_file_path' => 'nullable',
        ]);

        $validated['total_harga'] = str_replace(',', '', $validated['total_harga']);

        if ($request->file('pk_file_path')) {
            $validated['pk_file_path'] = $request->file('pk_file_path')->store('pk_file_path');
            $validated['pk_file_name'] = $request->file('pk_file_path')->getClientOriginalName();
        }

        $pk->update($validated);

        $nama = $request->input('nama', []);
        $qty = $request->input('qty', []);
        $harga = $request->input('harga', []);
        $total = $request->input('total', []);

        PengajuanKeuanganItem::where('pengajuan_keuangan_id', $pk->id)->delete();
        for ($i = 0; $i < count($nama); $i++) {
            PengajuanKeuanganItem::create([
                'pengajuan_keuangan_id' => $pk->id,
                'nama' => $nama[$i],
                'qty' => $qty[$i],
                'harga' => $harga[$i] ? str_replace(',', '', $harga[$i]) : 0,
                'total' => $total[$i] ? str_replace(',', '', $total[$i]) : 0,
            ]);
        }

        $users = User::whereHas('roles', function ($query) use ($pk) {
            $query->where('name', 'admin')
            ->when($pk->total_harga <= 1000000, function ($q) {
                $q->orWhere('name', 'finance');
            })
            ->orWhere('name', 'regional_manager')
            ->orWhere('name', 'general_manager');
        })->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan Keuangan Nomor ' . $pk->nomor . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('list-pengajuan-keuangan?pk_id='.$pk->id);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  'list-pengajuan-keuangan?pk_id='.$pk->id
            ];
            $user->notify(new \App\Notifications\UserNotification);

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
        }

        return redirect('/pengajuan-keuangan/show/'.$pk->id)->with('success', 'Data Berhasil Disimpan');
    }

    public function list()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'admin'
        ]);

        $title = 'Pengajuan Keuangan';
        $search = request()->input('search');
        $status = request()->input('status');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $pk_id = request()->input('pk_id');

        $pengajuan_keuangans = PengajuanKeuangan::when($search, function ($query) use ($search) {
                                        $query->where('nomor', 'LIKE', '%' . $search . '%')
                                        ->whereHas('user', function ($q) use ($search) {
                                            $q->where('name', 'LIKE', '%' . $search . '%');
                                        });
                                    })
                                    ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                                    })
                                    ->when($status, function ($query) use ($status) {
                                        $query->where('status', $status);
                                    })
                                    ->when($pk_id, function ($query) use ($pk_id) {
                                        $query->where('id', $pk_id);
                                    })
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();

        return view('pengajuan-keuangan.list', compact(
            'title',
            'pengajuan_keuangans'
        ));
    }

    public function approval(Request $request, $id)
    {
        $pk = PengajuanKeuangan::find($id);

        $validated = $request->validate([
            'status' => 'required',
            'note_approval' => 'nullable',
        ]);

        $validated['user_approval'] = auth()->user()->id;

        $pk->update($validated);

        $user = User::find($pk->user_id);
        $type = 'Approval';
        if ($pk->status == 'APPROVED') {
            $notif = 'Pengajuan Keuangan Nomor ' . $pk->nomor . ' Telah Di Approve Oleh ' . auth()->user()->name;
        } else {
            $notif = 'Pengajuan Keuangan Nomor ' . $pk->nomor . ' Telah Di Reject Oleh ' . auth()->user()->name;
        }

        $url = url('pengajuan-keuangan/show/'.$pk->id);

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  auth()->user()->name,
            'message'   =>  $notif,
            'action'   =>  'pengajuan-keuangan/show/'.$pk->id
        ];
        $user->notify(new \App\Notifications\UserNotification);

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

        return back()->with('success', 'Data Berhasil Diupdate');
    }

    public function accept($id)
    {
        $pk = PengajuanKeuangan::find($id);
        $pk->update([
            'status' => 'ON GOING'
        ]);
        return back()->with('success', 'Uang Sudah Di Terima');
    }

    public function delete($id)
    {
        $pk = PengajuanKeuangan::find($id);
        PengajuanKeuanganItem::where('pengajuan_keuangan_id', $id)->delete();
        $pk->delete();
        return redirect('/pengajuan-keuangan')->with('success', 'Data Berhasil Dihapus');
    }

    public function nota(Request $request, $id)
    {
        $pk = PengajuanKeuangan::find($id);
        $validated = $request->validate([
            'nota_file_path' => 'nullable',
        ]);

        $validated['nota_file_path'] = $request->file('nota_file_path')->store('nota_file_path');
        $validated['nota_file_name'] = $request->file('nota_file_path')->getClientOriginalName();

        $pk->update($validated);

        $users = User::whereHas('roles', function ($query) use ($pk) {
            $query->where('name', 'admin')
            ->orWhere('name', 'finance');
        })->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan Keuangan Nomor ' . $pk->nomor . ' Dari ' . auth()->user()->name . ' Berhasil Upload Nota, Harap Di cek';
            $url = url('list-pengajuan-keuangan?pk_id='.$pk->id);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  'list-pengajuan-keuangan?pk_id='.$pk->id
            ];
            $user->notify(new \App\Notifications\UserNotification);

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
        }
        return back()->with('success', 'Berhasil Upload');
    }

    public function close($id)
    {
        $pk = PengajuanKeuangan::find($id);
        $pk->update([
            'status' => 'COMPLETED'
        ]);
        return back()->with('success', 'Pengajuan Telah Selsai');
    }

    public function pdf($id)
    {
        $pk = PengajuanKeuangan::find($id);
        $pdf = Pdf::loadView('pengajuan-keuangan.pdf', [
            'title' => 'Pengajuan Keuangan',
            'pk' => $pk
        ]);

        return $pdf->stream();
    }

    public function excel()
    {
        return (new PengajuanKeuanganExport($_GET))->download('List Pengajuan Keuangan.xlsx');
    }

}
