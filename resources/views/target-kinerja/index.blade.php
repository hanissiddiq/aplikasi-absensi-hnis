@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/target-kinerja/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/target-kinerja') }}">
                        <div class="row">
                            <div class="col-11">
                                <input type="text" style="border-color: rgb(222, 222, 222)" class="form-control" name="search" placeholder="Search.." id="search" value="{{ request('search') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" id="search" class="btn" style="background-color: rgb(222, 222, 222);"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 200px;" class="text-center">Nomor Target</th>
                                    <th style="min-width: 230px; background-color:rgb(243, 243, 243);" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Jabatan</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Target Pribadi</th>
                                    <th style="min-width: 50px; background-color:rgb(243, 243, 243);" class="text-center">%</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Pribadi</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Target Team</th>
                                    <th style="min-width: 50px; background-color:rgb(243, 243, 243);" class="text-center">%</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Team</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Awal</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Akhir</th>
                                    <th class="text-center" style="background-color:rgb(243, 243, 243);">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($target_kinerjas) <= 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($target_kinerjas as $key => $tk)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">{{ ($target_kinerjas->currentpage() - 1) * $target_kinerjas->perpage() + $key + 1 }}.</td>
                                            <td class="text-center" style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">{{ $tk->nomor ?? '-' }}</td>
                                            <td class="text-center"  style="vertical-align: middle;">
                                                @foreach ($tk->team as $index => $team)
                                                    {{ $team->user->name ?? '-' }}
                                                    @if ($index < count($tk->team) - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @foreach ($tk->team as $index => $team)
                                                    {{ $team->jabatan->nama_jabatan ?? '-' }}
                                                    @if ($index < count($tk->team) - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @foreach ($tk->team as $index => $team)
                                                    Rp {{ number_format($team->target_pribadi) }}
                                                    @if ($index < count($tk->team) - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @foreach ($tk->team as $index => $team)
                                                    {{ $team->jumlah_persen_pribadi ?? '-' }}%
                                                    @if ($index < count($tk->team) - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @foreach ($tk->team as $index => $team)
                                                    Rp {{ number_format($team->bonus_pribadi) }}
                                                    @if ($index < count($tk->team) - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tk->target_team) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">{{ $tk->jumlah_persen_team ?? '-' }}%</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tk->bonus_team) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($tk->tanggal_awal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_awal = Carbon\Carbon::createFromFormat('Y-m-d', $tk->tanggal_awal);
                                                        $new_tanggal_awal = $tanggal_awal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_awal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($tk->tanggal_akhir)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_akhir = Carbon\Carbon::createFromFormat('Y-m-d', $tk->tanggal_akhir);
                                                        $new_tanggal_akhir = $tanggal_akhir->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_akhir  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ url('/target-kinerja/edit/'.$tk->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ url('/target-kinerja/delete/'.$tk->id) }}" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $target_kinerjas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    @push('style')
        <style>
            td {
                border: 1px solid #e2dede;
            }
            th {
                border: 1px solid #e2dede;
            }
        </style>
    @endpush

    @push('script')
        <script>
            $(document).ready(function() {
                $('#mulai').change(function(){
                    var mulai = $(this).val();
                $('#akhir').val(mulai);
                });
            });
        </script>
    @endpush
@endsection
