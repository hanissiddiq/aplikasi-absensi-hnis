<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\settings;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $lokasi = Lokasi::where('status', 'approved')
                    ->when($search, function ($query) use ($search) {
                        $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('nama_lokasi', 'ASC')
                    ->paginate(10)
                    ->withQueryString();

        return view('lokasi.index', [
            'title' => 'Lokasi Kantor',
            'data_lokasi' => $lokasi
        ]);
    }

    public function pendingLocation()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'admin'
        ]);

        $search = request()->input('search');
        $lokasi = Lokasi::where('status', 'pending')
                    ->when($search, function ($query) use ($search) {
                        $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('nama_lokasi', 'ASC')
                    ->paginate(10)
                    ->withQueryString();
        return view('lokasi.indexpending', [
            'title' => 'Pending Location',
            'data_lokasi' => $lokasi
        ]);
    }

    public function requestLocation()
    {
        $search = request()->input('search');
        $lokasi = Lokasi::where('created_by', auth()->user()->id)
                        ->when($search, function ($query) use ($search) {
                            $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                        })
                        ->paginate(10)
                        ->withQueryString();
        return view('lokasi.indexrequestuser', [
            'title' => 'Request Lokasi',
            'data_lokasi' => $lokasi
        ]);
    }

    public function tambahLokasi()
    {
        $title = "Tambah Lokasi Kantor";
        return view('lokasi.tambah', compact(
            'title',
        ));
    }

    public function tambahRequestLocation()
    {
        return view('lokasi.tambahrequestUser', [
            'title' => 'Tambah Lokasi Kantor',
        ]);

    }

    public function prosesTambahLokasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'radius' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'created_by' => 'required',
        ]);
        Lokasi::create($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Di Tambahkan');
    }

    public function prosesTambahRequestLocation(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'radius' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'created_by' => 'required',
        ]);

        $lokasi = Lokasi::create($validatedData);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'hrd')
                ->orWhere('name', 'general_manager')
                ->orWhere('name', 'kepala_cabang');
        })->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Request Lokasi Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/lokasi-kantor/pending-location');

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/lokasi-kantor/pending-location'
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

        return redirect('/request-location')->with('success', 'Lokasi Berhasil Di Tambahkan');
    }

    public function print($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $pdf = Pdf::loadView('lokasi.print', [
            'title' => 'Kartu',
            'lokasi' => $lokasi
        ]);

        $pdf->setPaper('A6', 'portrait');
        return $pdf->stream('kartu-pegawai.pdf');
    }

    public function editLokasi($id)
    {
        return view('lokasi.edit', [
            'title' => 'Edit Lokasi Kantor',
            'lokasi' => Lokasi::findOrFail($id),
        ]);
    }

    public function qrcode($id)
    {
        return view('lokasi.qrcode', [
            'title' => 'Qr Code Lokasi',
            'lokasi' => Lokasi::findOrFail($id)
        ]);
    }

    public function editRequestLocation($id)
    {
        return view('lokasi.editrequestuser', [
            'title' => 'Edit Lokasi Kantor',
            'lokasi' => Lokasi::findOrFail($id),
        ]);
    }

    public function UpdatePendingLocation(Request $request, $id)
    {
        $lokasi = Lokasi::find($id);

        $validatedData = $request->validate([
            'status' => 'required'
        ]);
        $validatedData['approved_by'] = auth()->user()->id;
        $lokasi->update($validatedData);

        if($validatedData["status"] == 'approved'){
            $user_id = $lokasi->created_by;
            User::where('id', $user_id)->update(['lokasi_id' => $lokasi->id]);

            $user = User::find($lokasi->created_by);
            $type = 'Approved';
            $notif = 'Request Lokasi Anda Telah Di Approve Oleh ' . auth()->user()->name;
            $url = url('/request-location');

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/request-location'
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

            return redirect('/lokasi-kantor/pending-location')->with('success', 'Lokasi Berhasil Di Approve');
        } else {
            $user = User::find($lokasi->created_by);
            $type = 'Rejected';
            $notif = 'Request Lokasi Anda Telah Di Reject Oleh ' . auth()->user()->name;
            $url = url('/request-location');

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/request-location'
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

            return redirect('/lokasi-kantor/pending-location')->with('success', 'Lokasi Berhasil Di Reject');
        }
    }

    public function updateLokasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'keterangan' => 'required',
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function updateRequestLocation(Request $request, $id)
    {
        $lokasi = Lokasi::find($id);
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        $lokasi->update($validatedData);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'hrd')
                ->orWhere('name', 'general_manager')
                ->orWhere('name', 'kepala_cabang');
        })->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Request Lokasi Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/lokasi-kantor/pending-location');

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/lokasi-kantor/pending-location'
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);

            $settings = settings::first();
            if ($settings->api_url && checkdnsrr($settings->api_url, 'A')) {
                Http::post($settings->api_url, [
                    'api_key' => $settings->api_whatsapp,
                    'sender' => $settings->whatsapp,
                    'number' => $user->telepon,
                    'message' => $notif,
                    'footer' => $url,
                ]);
            }
        }

        return redirect('/request-location')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function updateRadiusLokasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'radius' => 'required',
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function updateRadiusRequestLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'radius' => 'required',
            'status' => 'required'
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/request-location')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function deleteLokasi($id)
    {
        $check = User::where('lokasi_id', $id)->count();
        if ($check > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Lokasi Ini!');
            return back();
        } else {
            $lokasi = Lokasi::findOrFail($id);
            $lokasi->delete();
        }
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Di Delete');
    }

    public function deleteRequestLocation($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $user = User::where('lokasi_id', $id)->count();
        if($user > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Lokasi Ini!');
            return redirect('/request-location');
        } else {
            $lokasi->delete();
            return redirect('/request-location')->with('success', 'Lokasi Berhasil Di Delete');
        }
    }
}
