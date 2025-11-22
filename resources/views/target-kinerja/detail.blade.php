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
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Nomor Target</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Judul</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Target Pribadi</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Jumlah Penjualan</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Sisa</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Keterangan</th>
                                    <th style="min-width: 150px; background-color:rgb(243, 243, 243);" class="text-center">Sisa Target %</th>
                                    <th style="min-width: 150px; background-color:rgb(243, 243, 243);" class="text-center">Capai %</th>
                                    <th style="min-width: 150px; background-color:rgb(243, 243, 243);" class="text-center">Nilai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Awal</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Akhir</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Pribadi</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Team</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Jackpot</th>
                                    <th class="text-center" style="background-color:rgb(243, 243, 243);">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($target_kinerja_team) <= 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($target_kinerja_team as $key => $tkt)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">{{ ($target_kinerja_team->currentpage() - 1) * $target_kinerja_team->perpage() + $key + 1 }}.</td>
                                            <td class="text-center" style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">
                                                {{ $tkt->user->name ?? '-' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $tkt->target->nomor ?? '-' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $tkt->judul ?? '-' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->target_pribadi) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->jumlah) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->target_pribadi - $tkt->jumlah) }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if ($tkt->keterangan)
                                                    {!! nl2br(e($tkt->keterangan)) !!}
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ 100 - $tkt->capai }} %
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $tkt->capai ?? '0' }} %
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $tkt->nilai ?? '-' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($tkt->target && $tkt->target->tanggal_awal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_awal = Carbon\Carbon::createFromFormat('Y-m-d', $tkt->target->tanggal_awal);
                                                        $new_tanggal_awal = $tanggal_awal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_awal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($tkt->target && $tkt->target->tanggal_akhir)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_akhir = Carbon\Carbon::createFromFormat('Y-m-d', $tkt->target->tanggal_akhir);
                                                        $new_tanggal_akhir = $tanggal_akhir->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_akhir  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->bonus_p) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->bonus_t) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                Rp {{ number_format($tkt->bonus_j) }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ url('/target-kinerja/edit/'.$tkt->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ url('/target-kinerja/delete/'.$tkt->id) }}" method="post" class="d-inline">
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
                        {{ $target_kinerja_team->links() }}
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
