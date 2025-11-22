<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\settings;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CutiController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail(auth()->user()->id);

        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::where('user_id', $user_id)
                    ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        return $query->whereBetween('tanggal', [$mulai, $akhir]);

                    })
                    ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.indexuser', [
            'title' => 'Tambah Permintaan Cuti Karyawan',
            'data_user' => $user,
            'data_cuti_user' => $cuti
        ]);
    }

    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        if($request["tanggal_mulai"] == null) {
            $request["tanggal_mulai"] = $request["tanggal_akhir"];
        } else {
            $request["tanggal_mulai"] = $request["tanggal_mulai"];
        }

        if($request["tanggal_akhir"] == null) {
            $request["tanggal_akhir"] = $request["tanggal_mulai"];
        } else {
            $request["tanggal_akhir"] = $request["tanggal_akhir"];
        }

        $begin = new \DateTime($request["tanggal_mulai"]);
        $end = new \DateTime($request["tanggal_akhir"]);
        $end = $end->modify('+1 day');

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);

        foreach ($daterange as $date) {
            $request["tanggal"] = $date->format("Y-m-d");

            $request['status_cuti'] = "Pending";
            $validatedData = $request->validate([
                'user_id' => 'required',
                'nama_cuti' => 'required',
                'tanggal' => 'required',
                'alasan_cuti' => 'required',
                'foto_cuti' => 'image|file|max:10240',
                'status_cuti' => 'required',
            ]);

            $validatedData['lokasi_id'] = auth()->user()->lokasi_id;

            if ($request->file('foto_cuti')) {
                $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
            }

            $cuti = Cuti::create($validatedData);
        }

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'hrd')
                ->orWhere('name', 'general_manager');
        });

        $kepala_cabang = User::whereHas('roles', function ($query) {
            $query->where('name', 'kepala_cabang');
        })->where('lokasi_id', auth()->user()->lokasi_id);

        $users = $user_roles->union($kepala_cabang)->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]
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

        return redirect('/cuti')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function delete($id)
    {
        $delete = Cuti::find($id);
        $delete->delete();
        return redirect('/cuti')->with('success', 'Data Berhasil di Delete');
    }

    public function edit($id){
        return view('cuti.edituser', [
            'title' => 'Edit Permintaan Cuti',
            'data_cuti_user' => Cuti::findOrFail($id)
        ]);
    }

    public function editProses(Request $request, $id)
    {
        $cuti = Cuti::find($id);
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_cuti' => 'required',
            'tanggal' => 'required',
            'alasan_cuti' => 'required',
            'foto_cuti' => 'image|file|max:10240',
        ]);

        $validatedData['lokasi_id'] = auth()->user()->lokasi_id;

        if ($request->file('foto_cuti')) {
            $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
        }

        $cuti->update($validatedData);

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'hrd')
                ->orWhere('name', 'general_manager');
        });

        $kepala_cabang = User::whereHas('roles', function ($query) {
            $query->where('name', 'kepala_cabang');
        })->where('lokasi_id', auth()->user()->lokasi_id);

        $users = $user_roles->union($kepala_cabang)->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]
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

        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/cuti');
    }

    public function dataCuti()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'admin'
        ]);

        $users = User::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
        ->orderBy('name')
        ->get();

        $user_id = request()->input('user_id');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
                        return $query->where('lokasi_id', auth()->user()->lokasi_id);
                    })
                    ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        return $query->whereBetween('tanggal', [$mulai, $akhir]);
                    })
                    ->when($user_id, function ($query) use ($user_id) {
                        return $query->where('user_id', $user_id);
                    })
                    ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.datacuti', [
            'title' => 'Data Cuti Karyawan',
            'data_cuti' => $cuti,
            'users' => $users,
        ]);
    }

    public function tambahAdmin()
    {
        $users = User::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
        ->orderBy('name')
        ->get();
        return view('cuti.tambahadmin', [
            'title' => 'Tambah Cuti Pegawai',
            'data_user' => $users
        ]);
    }

    public function getUserId(Request $request)
    {
        $id = $request["id"];
        $data_user = User::findOrfail($id);

        $izin_cuti = $data_user->izin_cuti;
        $izin_lainnya = $data_user->izin_lainnya;
        $izin_telat = $data_user->izin_telat;
        $izin_pulang_cepat = $data_user->izin_pulang_cepat;

        $data_cuti = array(
            [
                'nama' => 'Cuti',
                'nama_cuti' => 'Cuti ('.$izin_cuti.')'
            ],
            [
                'nama' => 'Izin Masuk',
                'nama_cuti' => 'Izin Masuk ('.$izin_lainnya.')'
            ],
            [
                'nama' => 'Izin Telat',
                'nama_cuti' => 'Izin Telat ('.$izin_telat.')'
            ],
            [
                'nama' => 'Izin Pulang Cepat',
                'nama_cuti' => 'Izin Pulang Cepat ('.$izin_pulang_cepat.')'
            ],
            [
                'nama' => 'Sakit',
                'nama_cuti' => 'Sakit'
            ]
        );

        echo "<option value='' selected>Pilih Cuti</option>";
        foreach($data_cuti as $dc){
            echo "
                <option value='$dc[nama]'>$dc[nama_cuti]</option>
            ";
        }
    }

    public function tambahAdminProses(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        if($request["tanggal_mulai"] == null) {
            $request["tanggal_mulai"] = $request["tanggal_akhir"];
        } else {
            $request["tanggal_mulai"] = $request["tanggal_mulai"];
        }

        if($request["tanggal_akhir"] == null) {
            $request["tanggal_akhir"] = $request["tanggal_mulai"];
        } else {
            $request["tanggal_akhir"] = $request["tanggal_akhir"];
        }

        $begin = new \DateTime($request["tanggal_mulai"]);
        $end = new \DateTime($request["tanggal_akhir"]);
        $end = $end->modify('+1 day');

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);

        $user_cuti = User::find($request->user_id);

        foreach ($daterange as $date) {
            $request["tanggal"] = $date->format("Y-m-d");

            $request['status_cuti'] = "Pending";
            $validatedData = $request->validate([
                'user_id' => 'required',
                'nama_cuti' => 'required',
                'tanggal' => 'required',
                'alasan_cuti' => 'required',
                'foto_cuti' => 'image|file|max:10240',
                'status_cuti' => 'required',
            ]);

            if ($request->file('foto_cuti')) {
                $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
            }

            $validatedData['lokasi_id'] = $user_cuti->lokasi_id;

            $cuti = Cuti::create($validatedData);
        }

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'hrd')
                ->orWhere('name', 'general_manager');
        });

        $kepala_cabang = User::whereHas('roles', function ($query) {
            $query->where('name', 'kepala_cabang');
        })->where('lokasi_id', $user_cuti->lokasi_id);

        $users = $user_roles->union($kepala_cabang)->get();

        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . $user_cuti->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  $user_cuti->id,
                'from'   =>  $user_cuti->name,
                'message'   =>  $notif,
                'action'   =>  '/data-cuti?user_id='.$cuti->user_id.'&mulai='.$request["tanggal_mulai"].'&akhir='.$request["tanggal_akhir"]
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

        return redirect('/data-cuti')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function deleteAdmin($id)
    {
        $delete = Cuti::find($id);
        // Storage::delete($delete->foto_cuti);
        $delete->delete();
        return redirect('/data-cuti')->with('success', 'Data Berhasil di Delete');
    }

    public function editAdmin($id)
    {
        return view('cuti.editadmin', [
            'title' => 'Edit Cuti Karyawan',
            'data_cuti_karyawan' => Cuti::findOrFail($id)
        ]);
    }

    public function editAdminProses(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $cuti = Cuti::find($id);
        $validated = $request->validate([
            'nama_cuti' => 'required',
            'tanggal' => 'required',
            'status_cuti' => 'required',
            'catatan' => 'nullable',
        ]);
        $validated['user_approval'] = auth()->user()->id;
        $cuti->update($validated);

        $user = User::find($cuti->user_id);
        $mapping_shift = MappingShift::where('tanggal', $request['tanggal'])->where('user_id', $cuti->user_id)->first();

        if ($request["status_cuti"] == "Diterima") {
            if($request["nama_cuti"] == "Cuti") {
                $user->update([
                    'izin_cuti' => $user->izin_cuti - 1
                ]);

                if ($mapping_shift) {
                    $mapping_shift->update([
                        'status_absen' => $request["nama_cuti"]
                    ]);
                } else {
                    MappingShift::create([
                        'user_id' => $cuti->user_id,
                        'tanggal' => $cuti->tanggal,
                        'status_absen' => $request["nama_cuti"]
                    ]);
                }
            } else if($request["nama_cuti"] == "Izin Masuk") {
                $user->update([
                    'izin_lainnya' => $user->izin_lainnya - 1
                ]);

                if ($mapping_shift) {
                    $mapping_shift->update([
                        'status_absen' => $request["nama_cuti"]
                    ]);
                } else {
                    MappingShift::create([
                        'user_id' => $cuti->user_id,
                        'tanggal' => $cuti->tanggal,
                        'status_absen' => $request["nama_cuti"]
                    ]);
                }
            } else if($request["nama_cuti"] == "Sakit") {
                if ($mapping_shift) {
                    $mapping_shift->update([
                        'status_absen' => $request["nama_cuti"]
                    ]);
                } else {
                    MappingShift::create([
                        'user_id' => $cuti->user_id,
                        'tanggal' => $cuti->tanggal,
                        'status_absen' => $request["nama_cuti"]
                    ]);
                }
            } else if($request["nama_cuti"] == "Izin Telat") {
                if ($mapping_shift) {
                    $user->update([
                        'izin_telat' => $user->izin_telat - 1
                    ]);
                    $mapping_shift->update([
                        'jam_absen' => $mapping_shift->Shift->jam_masuk,
                        'telat' => 0,
                        'lat_absen' => $user->Lokasi->lat_kantor,
                        'long_absen' => $user->Lokasi->long_kantor,
                        'jarak_masuk' => 0,
                        'foto_jam_absen' => $cuti->foto_cuti,
                        'status_absen' => $request["nama_cuti"],
                    ]);
                } else {
                    $cuti->update(['status_cuti' => 'Pending']);
                    Alert::error('Failed', 'Anda Belum Absen Masuk Pada Tanggal Tersebut');
                    return redirect('/data-cuti');
                }
            } else {
                if ($mapping_shift) {
                    $user->update([
                        'izin_pulang_cepat' => $user->izin_pulang_cepat - 1
                    ]);

                    $mapping_shift->update([
                        'jam_pulang' => $mapping_shift->Shift->jam_keluar,
                        'lat_pulang' => $user->Lokasi->lat_kantor,
                        'long_pulang' => $user->Lokasi->long_kantor,
                        'pulang_cepat' => 0,
                        'jarak_pulang' => 0,
                        'foto_jam_pulang' => $cuti->foto_cuti,
                        'status_absen' => $request["nama_cuti"],
                    ]);
                } else {
                    $cuti->update(['status_cuti' => 'Pending']);
                    Alert::error('Failed', 'Anda Belum Absen Masuk Pada Tanggal Tersebut');
                    return redirect('/data-cuti');
                }
            }

            $type = 'Approved';
            $notif = $cuti->nama_cuti . ' Anda Telah Diterima Oleh ' . auth()->user()->name;
            $url = url('/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal
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
        } else if ($request["status_cuti"] == "Ditolak") {
            $type = 'Rejected';
            $notif = $cuti->nama_cuti . ' Anda Telah Ditolak Oleh ' . auth()->user()->name;
            $url = url('/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal
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

        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/data-cuti');
    }

}
