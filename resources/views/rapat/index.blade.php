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
                        <a href="{{ url('/rapat/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/rapat') }}">
                        <div class="row mb-2">
                            <div class="col-5">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-5">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-2">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered border-dark">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th style="min-width: 300px;" class="text-center">Nama Pertemuaan</th>
                                    <th style="min-width: 180px;" class="text-center">Tanggal</centh>
                                    <th style="min-width: 130px;" class="text-center">Jam Mulai</th>
                                    <th style="min-width: 130px;" class="text-center">Jam Selesai</th>
                                    <th style="min-width: 300px;" class="text-center">Lokasi</centh>
                                    <th style="min-width: 300px;" class="text-center">Detail Pertemuan</th>
                                    <th style="min-width: 200px;" class="text-center">Jenis Pertemuan</th>
                                    <th style="min-width: 500px;" class="text-center">Peserta</th>
                                    <th style="min-width: 400px;" class="text-center">Notulen</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($rapats) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($rapats as $key => $rapat)
                                        <tr>
                                            <td>{{ ($rapats->currentpage() - 1) * $rapats->perpage() + $key + 1 }}.</td>
                                            <td class="text-center">{{ $rapat->nama ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($rapat->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $rapat->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $rapat->jam_mulai ?? '-' }}</td>
                                            <td class="text-center">{{ $rapat->jam_selesai ?? '-' }}</td>
                                            <td class="text-center">{{ $rapat->lokasi ?? '-' }}</td>
                                            <td>{!! $rapat->detail ? nl2br(e($rapat->detail)) : '-' !!}</td>
                                            <td class="text-center">{{ $rapat->jenis ?? '-' }}</td>
                                            <td>
                                                @if (count($rapat->pegawai) > 0)
                                                    @foreach ($rapat->pegawai as $pegawai)
                                                        @if ($pegawai->status == "Hadir")
                                                            <span class="float-start">{{ $pegawai->user->name ?? '-' }}</span> <span class="float-end btn btn-xs"  style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pegawai->status ?? '-' }}</span>
                                                        @else
                                                            <span class="float-start">{{ $pegawai->user->name ?? '-' }}</span> <span class="float-end btn btn-xs"  style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pegawai->status ?? '-' }}</span>
                                                        @endif
                                                        <br>
                                                        <span style="color: rgb(173, 173, 173); font-size:10px">
                                                            @if ($pegawai->hadir)
                                                                @php
                                                                    Carbon\Carbon::setLocale('id');
                                                                    $hadir = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pegawai->hadir);
                                                                    $new_hadir = $hadir->translatedFormat('l, d F Y H:i:s');
                                                                @endphp
                                                                {{ $new_hadir  }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                        @if (!$loop->last)
                                                            <hr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (count($rapat->notulen) > 0)
                                                    @foreach ($rapat->notulen as $notulen)
                                                        <span class="badge" style="border-radius:15px; background-color:blue">{{ $loop->iteration }}</span> {{ $notulen->notulen }}
                                                        <br>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (now()->format('Y-m-d H:i') < $rapat->tanggal . ' ' . $rapat->jam_mulai)
                                                    <ul class="action">
                                                        <li class="edit">
                                                            <a href="{{ url('/rapat/edit/'.$rapat->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ url('/rapat/delete/'.$rapat->id) }}" method="post" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $rapats->links() }}
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
