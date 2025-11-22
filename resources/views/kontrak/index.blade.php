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
                        <a href="{{ url('/kontrak/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                        <a href="{{ url('/kontrak/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success">Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/kontrak') }}">
                        <div class="row mb-2">
                            <div class="col-5">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Pegawai" id="nama" value="{{ request('nama') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal</centh>
                                    <th style="min-width: 350px; background-color:rgb(243, 243, 243);" class="text-center">Jenis Kontrak</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Mulai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal Selesai</th>
                                    <th style="min-width: 400px; background-color:rgb(243, 243, 243);" class="text-center">Keterangan</th>
                                    <th style="min-width: 230px; background-color:rgb(243, 243, 243);" class="text-center">File</th>
                                    <th class="text-center" style="position: sticky; right: 0; background-color: rgb(215, 215, 215); z-index: 2;">Actions</th>
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
                                            <td style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;">{{ $kontrak->user->name ?? '-' }}</td>
                                            <td class="text-center">
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
                                            <td>{!! $kontrak->keterangan ? nl2br(e($kontrak->keterangan)) : '-' !!}</td>
                                            <td>
                                                @if ($kontrak->kontrak_file_path)
                                                    <a href="{{ url('/storage/'.$kontrak->kontrak_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $kontrak->kontrak_file_name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="position: sticky; right: 0; background-color: rgb(235, 235, 235); z-index: 1;">
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ url('/kontrak/edit/'.$kontrak->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ url('/kontrak/delete/'.$kontrak->id) }}" method="post" class="d-inline">
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
