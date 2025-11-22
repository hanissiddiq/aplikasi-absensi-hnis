<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use App\Models\Jabatan;
use App\Models\Golongan;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Models\JenisKinerja;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use App\Models\LaporanKinerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login',[
            "title" => "Log In"
        ]);
    }

    public function loginAdmin()
    {
        return view('auth.loginAdmin',[
            "title" => "Log In"
        ]);
    }

    public function getStarted()
    {
        return view('auth.getStarted',[
            "title" => "Log In"
        ]);
    }

    public function welcome()
    {
        return view('auth.welcome',[
            "title" => "Log In"
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            "title" => "Register Account",
            "data_jabatan" => Jabatan::all(),
            "golongan" => Golongan::all(),
            "data_lokasi" => Lokasi::where('status', 'approved')->where('keterangan', 'Office')->get()
        ]);
    }

    public function presensi()
    {
        return view('auth.presensi', [
            "title" => "Presensi Masuk",
        ]);
    }

    public function presensiPulang()
    {
        return view('auth.presensiPulang', [
            "title" => "Presensi Pulang",
        ]);
    }

    public function qrMasuk()
    {
        return view('auth.qrMasuk', [
            "title" => "Presensi QR Code Masuk",
        ]);
    }

    public function qrPulang()
    {
        return view('auth.qrPulang', [
            "title" => "Presensi QR Code Pulang",
        ]);
    }

    public function qrMasukStore(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');
        $user = User::where('username', $request['username'])->first();
        if ($user) {
            $ms = MappingShift::where('user_id', $user->id)->where('tanggal', $currentDate)->first();
            if ($ms) {
                if($ms->jam_absen == null) {
                    $status_absen = "Masuk";
                    $jam_absen = date('H:i');
                    $tgl_skrg = date("Y-m-d");

                    $awal  = strtotime($ms->tanggal . $ms->Shift->jam_masuk);
                    $akhir = strtotime($tgl_skrg . $jam_absen);
                    $diff  = $akhir - $awal;

                    if ($diff <= 0) {
                        $telat= 0;
                        $jenis_kinerja = JenisKinerja::where('nama', 'Presensi Kehadiran Ontime')->first();
                        $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                        if ($laporan_kinerja_before) {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        } else {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        }
                    } else {
                        $telat= $diff;
                        $jenis_kinerja = JenisKinerja::where('nama', 'Telat Presensi Masuk')->first();
                        $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                        if ($laporan_kinerja_before) {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        } else {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        }
                    }

                    $ms->update([
                        'jam_absen' => $jam_absen,
                        'telat' => $telat,
                        'status_absen' => $status_absen
                    ]);
                    return response()->json('masuk');
                } else {
                    return response()->json('selesai');
                }
            } else {
                return response()->json('noMs');
            }
        } else {
            return response()->json('noUser');
        }
    }

    public function presensiStore(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');
        $user = User::where('username', $request['username'])->first();
        if ($user) {
            $ms = MappingShift::where('user_id', $user->id)->where('tanggal', $currentDate)->first();
            if ($ms) {
                if($ms->jam_absen == null) {
                    $lat_kantor = $user->Lokasi->lat_kantor ?? null;
                    $long_kantor = $user->Lokasi->long_kantor ?? null;
                    $radius = $user->Lokasi->radius ?? null;
                    $jarak_masuk = $this->distance($request["lat"], $request["long"], $lat_kantor, $long_kantor, "K") * 1000;
                    if($jarak_masuk > $radius && $ms->lock_location == 1) {
                        return response()->json('outlocation');
                    } else {
                        $image = $request["image"];

                        $image_parts = explode(";base64,", $image);

                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = 'foto_jam_absen/' . uniqid() . '.png';

                        $status_absen = "Masuk";
                        $jam_absen = date('H:i');
                        $tgl_skrg = date("Y-m-d");

                        $awal  = strtotime($ms->tanggal . $ms->Shift->jam_masuk);
                        $akhir = strtotime($tgl_skrg . $jam_absen);
                        $diff  = $akhir - $awal;

                        if ($diff <= 0) {
                            $telat= 0;
                            $jenis_kinerja = JenisKinerja::where('nama', 'Presensi Kehadiran Ontime')->first();
                            $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                            if ($laporan_kinerja_before) {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            } else {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            }
                        } else {
                            $telat= $diff;
                            $jenis_kinerja = JenisKinerja::where('nama', 'Telat Presensi Masuk')->first();
                            $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                            if ($laporan_kinerja_before) {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            } else {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            }
                        }

                        Storage::put($fileName, $image_base64);
                        $ms->update([
                            'jam_absen' => $jam_absen,
                            'telat' => $telat,
                            'foto_jam_absen' => $fileName,
                            'lat_absen' => $request["lat"],
                            'long_absen' => $request["long"],
                            'jarak_masuk' => $jarak_masuk,
                            'status_absen' => $status_absen
                        ]);
                        return response()->json('masuk');
                    }
                } else {
                    return response()->json('selesai');
                }
            } else {
                return response()->json('noMs');
            }
        } else {
            return response()->json('noUser');
        }
    }

    public function presensiPulangStore(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');
        $user = User::where('username', $request['username'])->first();
        if ($user) {
            $ms = MappingShift::where('user_id', $user->id)->where('tanggal', $currentDate)->first();
            if ($ms) {
                if($ms->jam_pulang == null) {
                    $lat_kantor = $user->Lokasi->lat_kantor ?? null;
                    $long_kantor = $user->Lokasi->long_kantor ?? null;
                    $radius = $user->Lokasi->radius ?? null;
                    $jarak_pulang = $this->distance($request["lat"], $request["long"], $lat_kantor, $long_kantor, "K") * 1000;
                    if($jarak_pulang > $radius && $ms->lock_location == 1) {
                        return response()->json('outlocation');
                    } else {
                        $image = $request["image"];

                        $image_parts = explode(";base64,", $image);

                        $image_base64 = base64_decode($image_parts[1]);
                        $fileName = 'foto_jam_pulang/' . uniqid() . '.png';
                        $jam_pulang = date('H:i');

                        $new_tanggal = "";
                        $timeMasuk = strtotime($ms->Shift->jam_masuk);
                        $timePulang = strtotime($ms->Shift->jam_keluar);

                        if ($timePulang < $timeMasuk) {
                            $new_tanggal = date('Y-m-d', strtotime('+1 days', strtotime($ms->tanggal)));
                        } else {
                            $new_tanggal = $ms->tanggal;
                        }

                        $tgl_skrg = date("Y-m-d");

                        $akhir = strtotime($new_tanggal . $ms->Shift->jam_keluar);
                        $awal  = strtotime($tgl_skrg . $jam_pulang);
                        $diff  = $akhir - $awal;

                        if ($diff <= 0) {
                            $pulang_cepat = 0;
                            $jenis_kinerja = JenisKinerja::where('nama', 'Pulang tepat waktu')->first();
                            $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                            if ($laporan_kinerja_before) {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            } else {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            }
                        } else {
                            $pulang_cepat = $diff;
                            $jenis_kinerja = JenisKinerja::where('nama', 'Pulang Sebelum waktunya')->first();
                            $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                            if ($laporan_kinerja_before) {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            } else {
                                LaporanKinerja::create([
                                    'user_id' => $user->id,
                                    'tanggal' => $tgl_skrg,
                                    'jenis_kinerja_id' => $jenis_kinerja->id,
                                    'nilai' => $jenis_kinerja->bobot,
                                    'penilaian_berjalan' => $jenis_kinerja->bobot,
                                    'reference' => 'App\Models\MappingShift',
                                    'reference_id' => $ms->id,
                                ]);
                            }
                        }

                        Storage::put($fileName, $image_base64);
                        $ms->update([
                            'jam_pulang' => $jam_pulang,
                            'pulang_cepat' => $pulang_cepat,
                            'foto_jam_pulang' => $fileName,
                            'lat_pulang' => $request["lat"],
                            'long_pulang' => $request["long"],
                            'jarak_pulang' => $jarak_pulang,
                        ]);
                        return response()->json('pulang');
                    }
                } else {
                    return response()->json('selesai');
                }
            } else {
                return response()->json('noMs');
            }
        } else {
            return response()->json('noUser');
        }
    }

    public function qrPulangStore(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDate = date('Y-m-d');
        $user = User::where('username', $request['username'])->first();
        if ($user) {
            $ms = MappingShift::where('user_id', $user->id)->where('tanggal', $currentDate)->first();
            if ($ms) {
                if($ms->jam_pulang == null) {
                    $jam_pulang = date('H:i');

                    $new_tanggal = "";
                    $timeMasuk = strtotime($ms->Shift->jam_masuk);
                    $timePulang = strtotime($ms->Shift->jam_keluar);

                    if ($timePulang < $timeMasuk) {
                        $new_tanggal = date('Y-m-d', strtotime('+1 days', strtotime($ms->tanggal)));
                    } else {
                        $new_tanggal = $ms->tanggal;
                    }

                    $tgl_skrg = date("Y-m-d");

                    $akhir = strtotime($new_tanggal . $ms->Shift->jam_keluar);
                    $awal  = strtotime($tgl_skrg . $jam_pulang);
                    $diff  = $akhir - $awal;

                    if ($diff <= 0) {
                        $pulang_cepat = 0;
                        $jenis_kinerja = JenisKinerja::where('nama', 'Pulang tepat waktu')->first();
                        $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                        if ($laporan_kinerja_before) {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        } else {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        }
                    } else {
                        $pulang_cepat = $diff;
                        $jenis_kinerja = JenisKinerja::where('nama', 'Pulang Sebelum waktunya')->first();
                        $laporan_kinerja_before = LaporanKinerja::where('user_id', $user->id)->latest()->first();
                        if ($laporan_kinerja_before) {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $laporan_kinerja_before->penilaian_berjalan + $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        } else {
                            LaporanKinerja::create([
                                'user_id' => $user->id,
                                'tanggal' => $tgl_skrg,
                                'jenis_kinerja_id' => $jenis_kinerja->id,
                                'nilai' => $jenis_kinerja->bobot,
                                'penilaian_berjalan' => $jenis_kinerja->bobot,
                                'reference' => 'App\Models\MappingShift',
                                'reference_id' => $ms->id,
                            ]);
                        }
                    }

                    $ms->update([
                        'jam_pulang' => $jam_pulang,
                        'pulang_cepat' => $pulang_cepat,
                    ]);
                    return response()->json('pulang');
                } else {
                    return response()->json('selesai');
                }
            } else {
                return response()->json('noMs');
            }
        } else {
            return response()->json('noUser');
        }
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function switch(Request $request, $id)
    {
        $request->session()->put('existing_user_id', Auth::user()->id);
        $request->session()->put('user_is_switched', true);
        Auth::loginUsingId($id);
        return redirect()->to('/');
    }

    public function ajaxGetNeural()
    {
        $inp = file_get_contents('neural.json');
        $tempArray = json_decode($inp);
        $jsonData = json_encode($tempArray);
        echo $jsonData;
    }

    public function registerProses(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users||min:7|max:7',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:6|max:255',
            'jabatan_id' => 'required',
            'lokasi_id' => 'required',
        ]);

        if ($request->file('foto_karyawan')) {
            $validatedData['foto_karyawan'] = $request->file('foto_karyawan')->store('foto_karyawan');
        }

        $validatedData['is_admin'] = 'user';
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/')->with('success', 'Berhasil Register! Silahkan Login');
    }

    public function loginProses(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if ($user->masa_berlaku && $user->masa_berlaku <= date('Y-m-d')) {
                Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
                return back();
            } else {
                if (Auth::attempt($credentials)) {
                    if ($user->hasRole('admin')) {
                        $user->update([
                            'is_admin' => 'admin'
                        ]);
                    } else {
                        $user->update([
                            'is_admin' => 'user'
                        ]);
                    }

                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                } else {
                    Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
                    return back();
                }
            }
        } else {
            Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
            return back();
        }

    }

    public function loginProsesUser(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if ($user->masa_berlaku && $user->masa_berlaku <= date('Y-m-d')) {
                Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
                return back();
            } else {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                } else {
                    Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
                    return back();
                }
            }
        } else {
            Alert::error('Failed', 'Username / Password Salah / Akun Tidak Aktif');
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgotPassword()
    {
        $title = 'Forgot Password';
        return view('auth.forgot-password', compact(
            'title'
        ));
    }

    public function forgotPasswordLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function showResetForm($token)
    {
        $title = 'Reset Password';
        return view('auth.passwords.reset', compact(
            'token',
            'title'
        ));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
