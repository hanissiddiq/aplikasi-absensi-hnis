@extends('templates.app')
@section('container')
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
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/data-patroli') }}">
                    <div class="row">
                        <div class="col-5">
                            <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-5">
                            <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <div class="table-responsive" style="border-radius: 10px">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                            <th style="background-color: rgb(215, 215, 215); min-width: 230px;" class="text-center">Nama Pegawai</th>
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
                                    <td style="background-color: rgb(235, 235, 235);">{{ $pat->user->name ?? '-' }}</td>
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
                                        <a href="{{ url('/patroli/maps/'.$pat->lat.'/'.$pat->long.'/'.$pat->lokasi_id) }}" style="background-color: rgb(146, 146, 146);border-radius:10px;" class="badge" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lihat</a>
                                        <br>
                                        <span class="badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $jarak[0] }} Meter</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ url('/data-patroli/delete/'.$pat->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button title="Delete Pegawai" class="border-0" style="background-color: transparent; color:red;" onClick="return confirm('Are You Sure')"><i class="fa fa-trash"></i></button>
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
    <br>
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
