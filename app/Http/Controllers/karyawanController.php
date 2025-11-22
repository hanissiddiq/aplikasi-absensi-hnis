<?php

namespace App\Http\Controllers;

use App\Models\Sip;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Shift;
use App\Models\Lembur;
use App\Models\Lokasi;
use App\Models\Jabatan;
use App\Models\Kontrak;
use App\Models\Payroll;
use App\Models\dinasLuar;
use App\Models\ResetCuti;
use App\Imports\UsersImport;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;



class karyawanController extends Controller
{
    public function index()
    {
        $search = request()->input('search');

        $data = User::when($search, function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%')
                          ->orWhere('email', 'LIKE', '%'.$search.'%')
                          ->orWhere('telepon', 'LIKE', '%'.$search.'%')
                          ->orWhere('username', 'LIKE', '%'.$search.'%')
                          ->orWhereHas('Jabatan', function ($query) use ($search) {
                              $query->where('nama_jabatan', 'LIKE', '%'.$search.'%');
                          });
                })
                ->orderBy('name', 'ASC')
                ->paginate(10)
                ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('karyawan.index', [
                'title' => 'Pegawai',
                'data_user' => $data
            ]);
        } else {
            return view('karyawan.indexUser', [
                'title' => 'Pegawai',
                'data_user' => $data
            ]);
        }
    }

    public function kontrak($id)
    {

        $user = User::find($id);
        $title = 'List Kontrak';
        $kontraks = Kontrak::where('user_id', $id)
                            ->orderBy('tanggal', 'DESC')
                            ->paginate(10)
                            ->withQueryString();

        return view('karyawan.kontrak', compact(
            'title',
            'kontraks',
            'user'
        ));
    }

    public function export()
    {
        return (new PegawaiExport($_GET))->download('List Pegawai.xlsx');
    }


    public function kartuPegawai()
    {
        $title = 'Kartu Pegawai';

        return view('karyawan.kartuPegawai', compact(
            'title',
        ));
    }

    public function qrcode($id)
    {
        $title = 'Kartu';
        $user = User::find($id);

        return view('karyawan.qrcode', compact(
            'title',
            'user',
        ));
    }

    public function print($id)
    {
        $user = User::find($id);
        $pdf = Pdf::loadView('karyawan.print', [
            'title' => 'Kartu',
            'user' => $user
        ]);

        $pdf->setPaper('A6', 'portrait');
        return $pdf->stream('kartu-pegawai.pdf');
    }

    public function euforia()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = User::where('tgl_lahir', date('Y-m-d'))
                ->orderBy('name', 'ASC')
                ->paginate(10)
                ->withQueryString();

        return view('karyawan.euforia', [
            'title' => 'Euforia',
            'data_user' => $data
        ]);

    }

    public function show($id)
    {
        $user = User::find($id);

        return view('karyawan.show', [
            'title' => 'Detail Karyawan',
            'user' => $user
        ]);
    }

    public function importUsers(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xls,xlsx,csv|max:5000'
        ]);
        $nama_file = $request->file('file_excel')->store('file_excel');

        Excel::import(new UsersImport, public_path('/storage/'.$nama_file));
        return back()->with('success', 'Data Berhasil Di Import');
    }

    public function tambahKaryawan()
    {
        return view('karyawan.tambah',[
            "title" => 'Tambah Pegawai',
            "data_jabatan" => Jabatan::all(),
            "data_lokasi" => Lokasi::where('status', 'approved')->where('keterangan', 'Office')->get(),
            "roles" => Role::orderBy('name')->get()
        ]);
    }

    public function tambahKaryawanProses(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'telepon' => 'required',
            'foto_karyawan' => 'image|file|max:10240',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6|max:255',
            'lokasi_id' => 'required',
            'tgl_lahir' => 'required',
            'tgl_join' => 'required',
            'gender' => 'required',
            'is_admin' => 'required',
            'status_nikah' => 'required',
            'jabatan_id' => 'required',
            'ktp' => 'nullable',
            'kartu_keluarga' => 'nullable',
            'bpjs_kesehatan' => 'nullable',
            'bpjs_ketenagakerjaan' => 'nullable',
            'npwp' => 'nullable',
            'sim' => 'nullable',
            'no_pkwt' => 'nullable',
            'no_kontrak' => 'nullable',
            'tanggal_mulai_pkwt' => 'nullable',
            'tanggal_berakhir_pkwt' => 'nullable',
            'rekening' => 'nullable',
            'nama_rekening' => 'nullable',
            'alamat' => 'nullable',
            'izin_cuti' => 'nullable',
            'izin_lainnya' => 'nullable',
            'izin_telat' => 'nullable',
            'izin_pulang_cepat' => 'nullable',
            'gaji_pokok' => 'nullable',
            'makan_transport' => 'nullable',
            'lembur' => 'nullable',
            'kehadiran' => 'nullable',
            'thr' => 'nullable',
            'bonus_pribadi' => 'nullable',
            'bonus_team' => 'nullable',
            'bonus_jackpot' => 'nullable',
            'izin' => 'nullable',
            'terlambat' => 'nullable',
            'mangkir' => 'nullable',
            'saldo_kasbon' => 'nullable',
            'masa_berlaku' => 'nullable',
        ]);

        $validatedData["izin_cuti"] = $request->izin_cuti ?? 0;
        $validatedData["izin_lainnya"] = $request->izin_lainnya ?? 0;
        $validatedData["izin_telat"] = $request->izin_telat ?? 0;
        $validatedData["izin_pulang_cepat"] = $request->izin_pulang_cepat ?? 0;

        $validatedData['gaji_pokok'] = $request->gaji_pokok ? str_replace(',', '', $request->gaji_pokok) : 0;
        $validatedData['makan_transport'] = $request->makan_transport ? str_replace(',', '', $request->makan_transport) : 0;
        $validatedData['lembur'] = $request->lembur ? str_replace(',', '', $request->lembur) : 0;
        $validatedData['kehadiran'] = $request->kehadiran ? str_replace(',', '', $request->kehadiran) : 0;
        $validatedData['thr'] = $request->thr ? str_replace(',', '', $request->thr) : 0;
        $validatedData['bonus_pribadi'] = $request->bonus_pribadi ? str_replace(',', '', $request->bonus_pribadi) : 0;
        $validatedData['bonus_team'] = $request->bonus_team ? str_replace(',', '', $request->bonus_team) : 0;
        $validatedData['bonus_jackpot'] = $request->bonus_jackpot ? str_replace(',', '', $request->bonus_jackpot) : 0;
        $validatedData['izin'] = $request->izin ? str_replace(',', '', $request->izin) : 0;
        $validatedData['terlambat'] = $request->terlambat ? str_replace(',', '', $request->terlambat) : 0;
        $validatedData['mangkir'] = $request->mangkir ? str_replace(',', '', $request->mangkir) : 0;
        $validatedData['saldo_kasbon'] = $request->saldo_kasbon ? str_replace(',', '', $request->saldo_kasbon) : 0;

        if ($request->file('foto_karyawan')) {
            $validatedData['foto_karyawan'] = $request->file('foto_karyawan')->store('foto_karyawan');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        if ($request->role) {
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }

        return redirect('/pegawai')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function detail($id)
    {
        $user = User::find($id);
        return view('karyawan.editkaryawan', [
            'title' => 'Detail Pegawai',
            'karyawan' => $user,
            'data_jabatan' => Jabatan::all(),
            "data_lokasi" => Lokasi::where('status', 'approved')->where('keterangan', 'Office')->get(),
            "roles" => Role::orderBy('name')->get(),
            'user_roles' => $user->roles->pluck('name')->toArray()
        ]);
    }

    public function editKaryawanProses(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'telepon' => 'required',
            'foto_karyawan' => 'image|file|max:10240',
            'lokasi_id' => 'required',
            'tgl_lahir' => 'required',
            'tgl_join' => 'required',
            'gender' => 'required',
            'is_admin' => 'required',
            'status_nikah' => 'required',
            'jabatan_id' => 'required',
            'ktp' => 'nullable',
            'kartu_keluarga' => 'nullable',
            'bpjs_kesehatan' => 'nullable',
            'bpjs_ketenagakerjaan' => 'nullable',
            'npwp' => 'nullable',
            'sim' => 'nullable',
            'no_pkwt' => 'nullable',
            'no_kontrak' => 'nullable',
            'tanggal_mulai_pkwt' => 'nullable',
            'tanggal_berakhir_pkwt' => 'nullable',
            'rekening' => 'nullable',
            'nama_rekening' => 'nullable',
            'alamat' => 'nullable',
            'izin_cuti' => 'nullable',
            'izin_lainnya' => 'nullable',
            'izin_telat' => 'nullable',
            'izin_pulang_cepat' => 'nullable',
            'gaji_pokok' => 'nullable',
            'makan_transport' => 'nullable',
            'lembur' => 'nullable',
            'kehadiran' => 'nullable',
            'thr' => 'nullable',
            'bonus_pribadi' => 'nullable',
            'bonus_team' => 'nullable',
            'bonus_jackpot' => 'nullable',
            'izin' => 'nullable',
            'terlambat' => 'nullable',
            'mangkir' => 'nullable',
            'saldo_kasbon' => 'nullable',
            'masa_berlaku' => 'nullable',
        ];

        $user = User::find($id);

        foreach($user->roles as $r){
            $user->removeRole($r->name);
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->username != $user->username) {
            $rules['username'] = 'required|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);

        $validatedData["izin_cuti"] = $request->izin_cuti ?? 0;
        $validatedData["izin_lainnya"] = $request->izin_lainnya ?? 0;
        $validatedData["izin_telat"] = $request->izin_telat ?? 0;
        $validatedData["izin_pulang_cepat"] = $request->izin_pulang_cepat ?? 0;

        $validatedData['gaji_pokok'] = $request->gaji_pokok ? str_replace(',', '', $request->gaji_pokok) : 0;
        $validatedData['makan_transport'] = $request->makan_transport ? str_replace(',', '', $request->makan_transport) : 0;
        $validatedData['lembur'] = $request->lembur ? str_replace(',', '', $request->lembur) : 0;
        $validatedData['kehadiran'] = $request->kehadiran ? str_replace(',', '', $request->kehadiran) : 0;
        $validatedData['thr'] = $request->thr ? str_replace(',', '', $request->thr) : 0;
        $validatedData['bonus_pribadi'] = $request->bonus_pribadi ? str_replace(',', '', $request->bonus_pribadi) : 0;
        $validatedData['bonus_team'] = $request->bonus_team ? str_replace(',', '', $request->bonus_team) : 0;
        $validatedData['bonus_jackpot'] = $request->bonus_jackpot ? str_replace(',', '', $request->bonus_jackpot) : 0;
        $validatedData['izin'] = $request->izin ? str_replace(',', '', $request->izin) : 0;
        $validatedData['terlambat'] = $request->terlambat ? str_replace(',', '', $request->terlambat) : 0;
        $validatedData['mangkir'] = $request->mangkir ? str_replace(',', '', $request->mangkir) : 0;
        $validatedData['saldo_kasbon'] = $request->saldo_kasbon ? str_replace(',', '', $request->saldo_kasbon) : 0;

        if ($request->file('foto_karyawan')) {
            if ($request->foto_karyawan_lama) {
                Storage::delete($request->foto_karyawan_lama);
            }
            $validatedData['foto_karyawan'] = $request->file('foto_karyawan')->store('foto_karyawan');
        }

        $path = public_path('neural.json');
        $neural = File::get($path);
        $dataface = json_decode($neural, true);

        foreach ($dataface as &$item) {
            if ($item['label'] === $user->username) {
                $item['label'] = $request->username;
            }
        }

        File::put($path, json_encode($dataface, JSON_PRETTY_PRINT));

        $user->update($validatedData);
        if ($request->role) {
            foreach($request->role as $role){
                $user->assignRole($role);
            }
        }

        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/pegawai');
    }

    public function deleteKaryawan($id)
    {
        $delete = User::find($id);
        MappingShift::where('user_id', $id)->delete();
        Lembur::where('user_id', $id)->delete();
        Cuti::where('user_id', $id)->delete();
        Sip::where('user_id', $id)->delete();
        Payroll::where('user_id', $id)->delete();
        Storage::delete($delete->foto_karyawan);
        $path = public_path('neural.json');
        $neural = File::get($path);
        $dataface = json_decode($neural, true);

        $filterface = array_filter($dataface, function($item) use ($delete) {
            return $item['label'] !== $delete->username;
        });
        File::put($path, json_encode(array_values($filterface), JSON_PRETTY_PRINT));
        $delete->delete();
        return redirect('/pegawai')->with('success', 'Data Berhasil di Delete');
    }

    public function editpassword($id)
    {
        return view('karyawan.editpassword', [
            'title' => 'Edit Password',
            'karyawan' => User::find($id)
        ]);
    }

    public function face($id)
    {
        return view('karyawan.face', [
            'title' => 'Daftar Wajah',
            'karyawan' => User::find($id)
        ]);
    }

    public function ajaxDescrip(Request $request)
    {
        $path = public_path('neural.json');
        $neural = File::get($path);
        $dataface = json_decode($neural, true);
        $user = User::find($request->user_id);

        $filterface = array_filter($dataface, function($item) use ($user) {
            return $item['label'] !== $user->username;
        });

        File::put($path, json_encode(array_values($filterface), JSON_PRETTY_PRINT));

        $json = file_get_contents('neural.json');
        if(strlen($json) > 4){
            $string = ',' . $request["myData"];
        }
        else{
            $string = $request["myData"];
        }
        $position = strlen($json) - 1;
        $out = substr_replace( $json, $string, $position, 0 );
        file_put_contents('neural.json', $out);
    }

    public function ajaxPhoto(Request $request)
    {
        $image = $request["image"];

        $image_parts = explode(";base64,", $image);

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'foto_face_recognition/' . $request["path"] . '.png';

        Storage::put($fileName, $image_base64);

        $user = User::where('username', $request['path'])->update(["foto_face_recognition" => $fileName]);
        return $user;
    }

    public function editPasswordProses(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6|max:255',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::where('id', $id)->update($validatedData);
        $request->session()->flash('success', 'Password Berhasil Diganti');
        return redirect('/pegawai');
    }

    public function shift($id)
    {
        $tanggal = request()->input('tanggal');
        $mapping_shift = MappingShift::where('user_id', $id)
                                    ->when($tanggal, function ($query) use ($tanggal) {
                                        return $query->where('tanggal', $tanggal);
                                    })
                                    ->orderBy('tanggal', 'DESC')
                                    ->paginate(10)
                                    ->withQueryString();
        return view('karyawan.mappingshift', [
            'title' => 'Mapping Shift',
            'karyawan' => User::find($id),
            'shift_karyawan' => $mapping_shift,
            'shift' => Shift::all()
        ]);
    }

    public function dinasLuar($id)
    {
        $tanggal = request()->input('tanggal');
        $dinas_luar = dinasLuar::where('user_id', $id)
                        ->when($tanggal, function ($query) use ($tanggal) {
                            return $query->where('tanggal', $tanggal);
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10)
                        ->withQueryString();
        return view('karyawan.dinasluar', [
            'title' => 'Mapping Dinas Luar',
            'karyawan' => User::find($id),
            'dinas_luar' => $dinas_luar,
            'shift' => Shift::all()
        ]);
    }

    public function prosesTambahShift(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'shift_id' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
        ]);

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

        $interval = new \DateInterval('P1D'); //referensi : https://en.wikipedia.org/wiki/ISO_8601#Durations
        $daterange = new \DatePeriod($begin, $interval ,$end);


        foreach ($daterange as $date) {
            $tanggal = $date->format("Y-m-d");

            $cek = MappingShift::where('user_id', $request['user_id'])->where('tanggal', $tanggal)->first();

            if (!$cek) {
                if ($request["shift_id"] == 1) {
                    $request["status_absen"] = "Libur";
                } else {
                    $request["status_absen"] = "Tidak Masuk";
                }

                $request["tanggal"] = $tanggal;

                $validatedData = $request->validate([
                    'user_id' => 'required',
                    'shift_id' => 'required',
                    'tanggal' => 'required',
                    'status_absen' => 'required',
                ]);

                $validatedData['lock_location'] = $request['lock_location'] ? $request['lock_location'] : null;
                $validatedData['telat'] = 0;
                $validatedData['pulang_cepat'] = 0;

                MappingShift::create($validatedData);
            }
        }
        return redirect('/pegawai/shift/' . $request["user_id"])->with('success', 'Data Berhasil di Tambahkan');
    }

    public function prosesTambahDinas(Request $request)
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

        $interval = new \DateInterval('P1D'); //referensi : https://en.wikipedia.org/wiki/ISO_8601#Durations
        $daterange = new \DatePeriod($begin, $interval ,$end);


        foreach ($daterange as $date) {
            $tanggal = $date->format("Y-m-d");

            if ($request["shift_id"] == 1) {
                $request["status_absen"] = "Libur";
            } else {
                $request["status_absen"] = "Tidak Masuk";
            }

            $request["tanggal"] = $tanggal;

            $validatedData = $request->validate([
                'user_id' => 'required',
                'shift_id' => 'required',
                'tanggal' => 'required',
                'status_absen' => 'required',
            ]);

            dinasLuar::create($validatedData);
        }
        return redirect('/pegawai/dinas-luar/' . $request["user_id"])->with('success', 'Data Berhasil di Tambahkan');
    }

    public function deleteShift(Request $request, $id)
    {
        $delete = MappingShift::find($id);
        $delete->delete();
        return redirect('/pegawai/shift/' . $request["user_id"])->with('success', 'Data Berhasil di Delete');
    }

    public function deleteDinas(Request $request, $id)
    {
        $delete = dinasLuar::find($id);
        $delete->delete();
        return redirect('/pegawai/dinas-luar/' . $request["user_id"])->with('success', 'Data Berhasil di Delete');
    }

    public function editShift($id)
    {
        return view('karyawan.editshift', [
            'title' => 'Edit Shift',
            'shift_karyawan' => MappingShift::find($id),
            'shift' => Shift::all()
        ]);
    }

    public function editDinas($id)
    {
        return view('karyawan.editdinas', [
            'title' => 'Edit Dinas',
            'dinas_luar' => dinasLuar::find($id),
            'shift' => Shift::all()
        ]);
    }

    public function prosesEditShift(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if ($request["shift_id"] == 1) {
            $request["status_absen"] = "Libur";
        } else {
            $request["status_absen"] = "Tidak Masuk";
        }

        $validatedData = $request->validate([
            'shift_id' => 'required',
            'tanggal' => 'required',
            'status_absen' => 'required'
        ]);

        $validatedData['lock_location'] = $request['lock_location'] ? $request['lock_location'] : null;

        MappingShift::where('id', $id)->update($validatedData);
        return redirect('/pegawai/shift/' . $request["user_id"])->with('success', 'Data Berhasil di Update');
    }

    public function prosesEditDinas(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');


        if ($request["shift_id"] == 1) {
            $request["status_absen"] = "Libur";
        } else {
            $request["status_absen"] = "Tidak Masuk";
        }

        $validatedData = $request->validate([
            'shift_id' => 'required',
            'tanggal' => 'required',
            'status_absen' => 'required'
        ]);

        dinasLuar::where('id', $id)->update($validatedData);
        return redirect('/pegawai/dinas-luar/' . $request["user_id"])->with('success', 'Data Berhasil di Update');
    }

    public function myProfile()
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('karyawan.myprofile', [
                'title' => 'My Profile',
                'data_jabatan' => Jabatan::all(),
                "data_lokasi" => Lokasi::where('status', 'approved')->get()
            ]);

        } else {
            return view('karyawan.myprofileuser', [
                'title' => 'My Profile',
                'data_jabatan' => Jabatan::all(),
                "data_lokasi" => Lokasi::where('status', 'approved')->get()
            ]);
        }
    }

    public function myProfileUpdate(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'telepon' => 'required',
            'foto_karyawan' => 'image|file|max:10240',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'status_nikah' => 'required',
            'ktp' => 'nullable',
            'kartu_keluarga' => 'nullable',
            'bpjs_kesehatan' => 'nullable',
            'bpjs_ketenagakerjaan' => 'nullable',
            'npwp' => 'nullable',
            'sim' => 'nullable',
            'rekening' => 'nullable',
            'nama_rekening' => 'nullable',
            'alamat' => 'nullable',
        ];


        $userId = User::find($id);

        if ($request->email != $userId->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->username != $userId->username) {
            $rules['username'] = 'required|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('foto_karyawan')) {
            if ($request->foto_karyawan_lama) {
                Storage::delete($request->foto_karyawan_lama);
            }
            $validatedData['foto_karyawan'] = $request->file('foto_karyawan')->store('foto_karyawan');
        }

        $path = public_path('neural.json');
        $neural = File::get($path);
        $dataface = json_decode($neural, true);

        foreach ($dataface as &$item) {
            if ($item['label'] === $userId->username) {
                $item['label'] = $request->username;
            }
        }
        File::put($path, json_encode($dataface, JSON_PRETTY_PRINT));

        User::where('id', $id)->update($validatedData);
        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/my-profile');
    }

    public function editPassMyProfile()
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('karyawan.editpassmyprofile', [
                'title' => 'Ganti Password'
            ]);
        } else {
            return view('karyawan.editpassworduser', [
                'title' => 'Ganti Password'
            ]);
        }

    }

    public function editPassMyProfileProses(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:6|max:255|confirmed',
        ]);

        $validatedData['password'] = Hash::make($request->password);

        User::where('id', $id)->update($validatedData);
        $request->session()->flash('success', 'Password Berhasil di Update');
        return redirect('/dashboard');
    }

    public function resetCuti()
    {
        return view('karyawan.masterreset', [
            'title' => 'Master Data Reset Cuti',
            'data_cuti' => ResetCuti::first()
        ]);
    }

    public function resetCutiProses(Request $request, $id)
    {
        $validatedData = $request->validate([
            'izin_cuti' => 'required',
            'izin_dinas_luar' => 'required',
            'izin_sakit' => 'required',
            'izin_cek_kesehatan' => 'required',
            'izin_keperluan_pribadi' => 'required',
            'izin_lainnya' => 'required',
            'izin_telat' => 'required',
            'izin_pulang_cepat' => 'required'
        ]);

        ResetCuti::where('id', $id)->update($validatedData);
        return redirect('/reset-cuti')->with('success', 'Master Cuti Berhasil Diupdate');
    }

    public function switchUser()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'user'
        ]);

        return redirect('/dashboard')->with('success', 'Berhasil Pindah Dashboard User');
    }

    public function switchAdmin()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'admin'
        ]);

        return redirect('/dashboard')->with('success', 'Berhasil Pindah Dashboard Admin');
    }
}
