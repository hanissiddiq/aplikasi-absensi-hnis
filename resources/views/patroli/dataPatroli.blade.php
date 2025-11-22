@extends('templates.dashboard')
@section('isi')
<style>
    td {
        border: 1px solid #e2dede;
    }
    th {
        border-top: 1px solid #e2dede;
        border-left: 1px solid #e2dede;
        border-right: 1px solid #e2dede;
    }
</style>
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a target="_blank" href="{{ url('/data-patroli/export-excel') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success ms-2">Export Excel</a>
                        <a target="_blank" href="{{ url('/data-patroli/export-pdf') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-danger">Export PDF</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/data-patroli') }}">
                        <div class="row mb-2">
                            <div class="col-4">
                                <input type="text" class="form-control" name="nama" placeholder="Nama" id="nama" value="{{ request('nama') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-2">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Lokasi</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal</th>
                                    <th style="min-width: 100px; background-color:rgb(243, 243, 243);" class="text-center">Jam</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Lokasi Scan</th>
                                    <th style="background-color:rgb(243, 243, 243);" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($patroli) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($patroli as $key => $pat)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1;">{{ ($patroli->currentpage() - 1) * $patroli->perpage() + $key + 1 }}.</td>
                                            <td style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;">{{ $pat->user->name ?? '-' }}</td>
                                            <td class="text-center">{{ $pat->lokasi->nama_lokasi ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($pat->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pat->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $pat->jam ?? '-' }}</td>
                                            <td class="text-center">
                                                @php
                                                    $jarak = explode(".", $pat->jarak);
                                                @endphp
                                                <a href="{{ url('/patroli/maps/'.$pat->lat.'/'.$pat->long.'/'.$pat->lokasi_id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lihat</a>
                                                <br>
                                                <span class="badge badge-warning">{{ $jarak[0] }} Meter</span>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ url('/data-patroli/delete/'.$pat->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button title="Delete Pegawai" class="border-0" style="background-color: transparent; color:red" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $patroli->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

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
