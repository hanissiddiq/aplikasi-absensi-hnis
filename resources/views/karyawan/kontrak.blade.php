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
                        <a href="{{ url('/pegawai') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <center><h3>{{ $user->name }}</h3></center>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 170px;" class="text-center">Tanggal</th>
                                    <th style="min-width: 350px; background-color:rgb(243, 243, 243);" class="text-center">Jenis Kontrak</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Mulai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Selesai</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Periode</th>
                                    <th style="min-width: 400px; background-color:rgb(243, 243, 243);" class="text-center">Keterangan</th>
                                    <th class="text-center" style="position: sticky; right: 0; background-color: rgb(215, 215, 215); z-index: 2;min-width: 230px;">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($kontraks) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($kontraks as $key => $kontrak)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1;">{{ ($kontraks->currentpage() - 1) * $kontraks->perpage() + $key + 1 }}.</td>
                                            <td style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;">
                                                @if ($kontrak->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $kontrak->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $kontrak->jenis_kontrak ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($kontrak->tanggal_mulai)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_mulai = Carbon\Carbon::createFromFormat('Y-m-d', $kontrak->tanggal_mulai);
                                                        $new_tanggal_mulai = $tanggal_mulai->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_mulai  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($kontrak->tanggal_selesai)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal_selesai = Carbon\Carbon::createFromFormat('Y-m-d', $kontrak->tanggal_selesai);
                                                        $new_tanggal_selesai = $tanggal_selesai->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal_selesai  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    if ($kontrak->tanggal_mulai && $kontrak->tanggal_selesai) {
                                                        $startDate = Carbon\Carbon::createFromFormat('Y-m-d', $kontrak->tanggal_mulai, 'Asia/Jakarta');
                                                        $currentDate = Carbon\Carbon::createFromFormat('Y-m-d', $kontrak->tanggal_selesai, 'Asia/Jakarta');
                                                        if ($startDate->greaterThan($currentDate)) {
                                                            $periode = "0 Tahun, 0 Bulan, 0 Hari.";
                                                        } else {
                                                            $employmentDuration = $currentDate->diff($startDate);
                                                            $periode = "{$employmentDuration->y} Tahun, {$employmentDuration->m} Bulan, {$employmentDuration->d} Hari.";
                                                        }
                                                    } else {
                                                        $periode = '-';
                                                    }
                                                @endphp
                                                {{ $periode }}
                                            </td>
                                            <td>{!! $kontrak->keterangan ? nl2br(e($kontrak->keterangan)) : '-' !!}</td>
                                            <td style="position: sticky; right: 0; background-color: rgb(235, 235, 235); z-index: 1;">
                                                @if ($kontrak->kontrak_file_path)
                                                    <a href="{{ url('/storage/'.$kontrak->kontrak_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $kontrak->kontrak_file_name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $kontraks->links() }}
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
