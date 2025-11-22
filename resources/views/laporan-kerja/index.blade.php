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
                    <form action="{{ url('/laporan-kerja') }}">
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
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Informasi Umum</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Pekerjaan Yang Dilaksanakan</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Pekerjaan Belum Selesai</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($laporan_kerjas) <= 0)
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($laporan_kerjas as $key => $laporan_kerja)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">{{ ($laporan_kerjas->currentpage() - 1) * $laporan_kerjas->perpage() + $key + 1 }}.</td>
                                            <td class="text-center" style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1; vertical-align: middle;">
                                                {{ $laporan_kerja->user->name ?? '-' }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($laporan_kerja->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $laporan_kerja->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if ($laporan_kerja->informasi_umum)
                                                    {!! nl2br(e($laporan_kerja->informasi_umum)) !!}
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if ($laporan_kerja->pekerjaan_dilaksanakan)
                                                    {!! nl2br(e($laporan_kerja->pekerjaan_dilaksanakan)) !!}
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if ($laporan_kerja->pekerjaan_belum_selesai)
                                                    {!! nl2br(e($laporan_kerja->pekerjaan_belum_selesai)) !!}
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if ($laporan_kerja->catatan)
                                                    {!! nl2br(e($laporan_kerja->catatan)) !!}
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $laporan_kerjas->links() }}
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
