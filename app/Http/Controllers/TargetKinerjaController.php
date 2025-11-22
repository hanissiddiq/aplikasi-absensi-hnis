<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Counter;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Models\TargetKinerja;
use App\Models\TargetKinerjaItem;
use App\Models\TargetKinerjaTeam;

class TargetKinerjaController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Target Kinerja';
        $search = request()->input('search');

        $target_kinerjas = TargetKinerja::when($search, function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('nomor', 'LIKE', '%'.$search.'%')
                ->orWhereHas('team', function ($quer) use ($search) {
                    $quer->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
                });
            });
        })
        ->when(auth()->user()->is_admin == 'user', function ($query) {
            $query->whereHas('team', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
        })
        ->orderBy('id', 'DESC')
        ->paginate(10)
        ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('target-kinerja.index', compact(
                'title',
                'target_kinerjas'
            ));
        } else {
            return view('target-kinerja.indexUser', compact(
                'title',
                'target_kinerjas'
            ));
        }
    }

    public function detail()
    {
        $title = 'Detail Target Kinerja';
        $search = request()->input('search');

        $target_kinerja_team = TargetKinerjaTeam::when($search, function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%'.$search.'%');
                })
                ->orWhereHas('target', function ($q) use ($search) {
                    $q->where('nomor', 'LIKE', '%'.$search.'%');
                })
                ->orWhereHas('jabatan', function ($q) use ($search) {
                    $q->where('nama_jabatan', 'LIKE', '%'.$search.'%');
                });
            });
        })
        ->orderBy('id', 'DESC')
        ->paginate(10)
        ->withQueryString();

        return view('target-kinerja.detail', compact(
            'title',
            'target_kinerja_team'
        ));
    }

    public function tambah()
    {
        $title = 'Target Kinerja';
        $users = User::orderBy('name')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        if (!old('nomor')) {
            $counter = Counter::where('name', 'Target Kinerja')->first();
            $counter->update(['counter' => $counter->counter + 1]);
            $next_number = str_pad($counter->counter, 6, '0', STR_PAD_LEFT);
            $nomor = $counter->text . '/' . $next_number;
        } else {
            $nomor = old('nomor');
        }

        return view('target-kinerja.tambah', compact(
            'title',
            'users',
            'jabatans',
            'nomor',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required',
            'target_team' => 'required',
            'jumlah_persen_team' => 'required',
            'bonus_team' => 'required',
            'jackpot' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        $validated['target_team'] = $request->target_team ? str_replace(',', '', $request->target_team) : 0;
        $validated['bonus_team'] = $request->bonus_team ? str_replace(',', '', $request->bonus_team) : 0;
        $validated['jackpot'] = $request->jackpot ? str_replace(',', '', $request->jackpot) : 0;

        $target_kinerja = TargetKinerja::create($validated);

        $user_id = $request->input('user_id', []);
        $jabatan_id = $request->input('jabatan_id', []);
        $target_pribadi = $request->input('target_pribadi', []);
        $jumlah_persen_pribadi = $request->input('jumlah_persen_pribadi', []);
        $bonus_pribadi = $request->input('bonus_pribadi', []);

        if (count($user_id) > 0) {
            for ($i = 0; $i < count($user_id); $i++) {
                TargetKinerjaTeam::create([
                    'target_kinerja_id' => $target_kinerja->id,
                    'user_id' => $user_id[$i],
                    'jabatan_id' => $jabatan_id[$i],
                    'target_pribadi' => $target_pribadi[$i] ? str_replace(',', '', $target_pribadi[$i]) : 0,
                    'jumlah_persen_pribadi' => $jumlah_persen_pribadi[$i],
                    'bonus_pribadi' => $bonus_pribadi[$i] ? str_replace(',', '', $bonus_pribadi[$i]) : 0,
                ]);
            }
        }

        return redirect('/target-kinerja')->with('success', 'Data Has Been Saved');
    }

    public function edit($id)
    {
        $title = 'Target Kinerja';
        $users = User::orderBy('name')->get();
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $target_kinerja = TargetKinerja::find($id);

        return view('target-kinerja.edit', compact(
            'title',
            'users',
            'jabatans',
            'target_kinerja',
        ));
    }

    public function update(Request $request, $id)
    {
        $target_kinerja = TargetKinerja::find($id);

        $validated = $request->validate([
            'target_team' => 'required',
            'jumlah_persen_team' => 'required',
            'bonus_team' => 'required',
            'jackpot' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        $validated['target_team'] = $request->target_team ? str_replace(',', '', $request->target_team) : 0;
        $validated['bonus_team'] = $request->bonus_team ? str_replace(',', '', $request->bonus_team) : 0;
        $validated['jackpot'] = $request->jackpot ? str_replace(',', '', $request->jackpot) : 0;

        $target_kinerja->update($validated);

        $user_id = $request->input('user_id', []);
        $jabatan_id = $request->input('jabatan_id', []);
        $target_pribadi = $request->input('target_pribadi', []);
        $jumlah_persen_pribadi = $request->input('jumlah_persen_pribadi', []);
        $bonus_pribadi = $request->input('bonus_pribadi', []);

        TargetKinerjaTeam::where('target_kinerja_id', $target_kinerja->id)->delete();
        if (count($user_id) > 0) {
            for ($i = 0; $i < count($user_id); $i++) {
                TargetKinerjaTeam::create([
                    'target_kinerja_id' => $target_kinerja->id,
                    'user_id' => $user_id[$i],
                    'jabatan_id' => $jabatan_id[$i],
                    'target_pribadi' => $target_pribadi[$i] ? str_replace(',', '', $target_pribadi[$i]) : 0,
                    'jumlah_persen_pribadi' => $jumlah_persen_pribadi[$i],
                    'bonus_pribadi' => $bonus_pribadi[$i] ? str_replace(',', '', $bonus_pribadi[$i]) : 0,
                ]);
            }
        }

        return redirect('/target-kinerja')->with('success', 'Data Has Been Saved');
    }

    public function delete($id)
    {
        $target_kinerja = TargetKinerja::find($id);
        TargetKinerjaTeam::where('target_kinerja_id', $target_kinerja->id)->delete();
        $target_kinerja->delete();
        return redirect('/target-kinerja')->with('success', 'Data Has Been Deleted');
    }

    public function list($id)
    {
        $target_kinerja = TargetKinerja::find($id);
        $title = 'Target Kinerja - ' . $target_kinerja->nomor;
        $target_kinerja_team = TargetKinerjaTeam::where('target_kinerja_id', $id)->get();
        $sum_jumlah = TargetKinerjaTeam::where('target_kinerja_id', $id)->sum('jumlah');

        return view('target-kinerja.list', compact(
            'title',
            'target_kinerja',
            'target_kinerja_team',
            'sum_jumlah',
        ));
    }

    public function show($tkt_id, $tk_id)
    {
        $title = 'Target Kinerja';
        $target_kinerja_team = TargetKinerjaTeam::find($tkt_id);
        $target_kinerja = TargetKinerja::find($tk_id);
        $sum_jumlah = TargetKinerjaTeam::where('target_kinerja_id', $tk_id)->sum('jumlah');

        return view('target-kinerja.show', compact(
            'title',
            'target_kinerja',
            'target_kinerja_team',
            'sum_jumlah',
        ));
    }

    public function editUser($tkt_id, $tk_id)
    {
        $title = 'Target Kinerja';
        $target_kinerja_team = TargetKinerjaTeam::find($tkt_id);
        $target_kinerja = TargetKinerja::find($tk_id);
        $sum_jumlah = TargetKinerjaTeam::where('target_kinerja_id', $tk_id)->where('id', '!=', $tkt_id)->sum('jumlah');

        return view('target-kinerja.editUser', compact(
            'title',
            'target_kinerja',
            'target_kinerja_team',
            'sum_jumlah',
        ));
    }

    public function updateUser(Request $request, $tkt_id, $tk_id)
    {
        $target_kinerja_team = TargetKinerjaTeam::find($tkt_id);
        $target_kinerja = TargetKinerja::find($tk_id);

        $request->validate([
            'judul' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
        ]);

        $target_kinerja_team->user->update([
            'bonus_pribadi' => $target_kinerja_team->user->bonus_pribadi - $target_kinerja_team->bonus_p
        ]);

        $target_kinerja_team->update([
            'judul' => $request->judul,
            'jumlah' => $request->jumlah ? str_replace(',', '', $request->jumlah) : 0,
            'capai' => $request->capai,
            'nilai' => $request->nilai,
            'bonus_p' => $request->bonus_p ? str_replace(',', '', $request->bonus_p) : 0,
            'keterangan' => $request->keterangan,
        ]);

        $target_kinerja_team->user->update([
            'bonus_pribadi' => $target_kinerja_team->user->bonus_pribadi + $target_kinerja_team->bonus_p
        ]);

        $sum_jumlah = TargetKinerjaTeam::where('target_kinerja_id', $tk_id)->sum('jumlah');

        foreach ($target_kinerja->team as $team) {
            $team->user->update([
                'bonus_team' => $team->user->bonus_team - $team->bonus_t,
                'bonus_jackpot' => $team->user->bonus_jackpot - $team->bonus_j
            ]);

            $bonus_t = $sum_jumlah * ($target_kinerja->jumlah_persen_team / 100);
            if ($sum_jumlah >= $target_kinerja->target_team) {
                $bonus_j = $target_kinerja->jackpot;
            } else {
                $bonus_j = 0;
            }
            $team->update([
                'bonus_t' => $bonus_t,
                'bonus_j' => $bonus_j
            ]);

            $team->user->update([
                'bonus_team' => $team->user->bonus_team + $team->bonus_t,
                'bonus_jackpot' => $team->user->bonus_jackpot + $team->bonus_j
            ]);
        }
        return redirect('/target-kinerja/show/'.$tkt_id.'/'.$tk_id)->with('success', 'Data Has Been Updated');
    }


    public function ajaxUserJabatan(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        return response()->json($user->Jabatan ?? null);
    }
}
