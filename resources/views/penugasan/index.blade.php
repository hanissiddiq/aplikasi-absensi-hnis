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
                        <a href="{{ url('/penugasan/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/laporan-kinerja') }}">
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
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th style="min-width: 130px;" class="text-center">Nomor Penugasan</th>
                                    <th style="min-width: 180px;" class="text-center">Tanggal</th>
                                    <th style="min-width: 250px;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 200px;" class="text-center">Judul</th>
                                    <th style="min-width: 300px;" class="text-center">Rincian</th>
                                    <th style="min-width: 570px;" class="text-center">Progress</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($penugasans) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($penugasans as $key => $penugasan)
                                        <tr>
                                            <td>{{ ($penugasans->currentpage() - 1) * $penugasans->perpage() + $key + 1 }}.</td>
                                            <td class="text-center">{{ $penugasan->nomor_penugasan ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($penugasan->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $penugasan->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $penugasan->user->name ?? '-' }}</td>
                                            <td class="text-center">{{ $penugasan->judul ?? '-' }}</td>
                                            <td>{!! $penugasan->rincian ? nl2br(e($penugasan->rincian)) : '-' !!}</td>
                                            <td>
                                                @if (count($penugasan->items) > 0)
                                                    @foreach ($penugasan->items as $item)
                                                        @if ($item->flow == 'PENDING')
                                                            <span class="float-start">{{ $item->user->name ?? '-' }}</span> <span class="float-end btn btn-xs" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $item->flow ?? '-' }}</span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px">
                                                                @if ($item->created_at)
                                                                    @php
                                                                        Carbon\Carbon::setLocale('id');
                                                                        $created_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                        $new_created_at = $created_at->translatedFormat('l, d F Y H:i:s');
                                                                    @endphp
                                                                    {{ $new_created_at  }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px;">Tugas {{ $penugasan->nomor_penugasan }} ditugaskan kepada {{ $penugasan->user->name ?? '-' }} oleh {{ $item->user->name ?? '-' }}</span>
                                                        @elseif($item->flow == 'PROCESS')
                                                            <span class="float-start">{{ $item->user->name ?? '-' }}</span> <span class="float-end btn btn-xs" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $item->flow ?? '-' }}</span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px">
                                                                @if ($item->created_at)
                                                                    @php
                                                                        Carbon\Carbon::setLocale('id');
                                                                        $created_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                        $new_created_at = $created_at->translatedFormat('l, d F Y H:i:s');
                                                                    @endphp
                                                                    {{ $new_created_at  }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px;">Tugas {{ $penugasan->nomor_penugasan }} diproses oleh {{ $item->user->name ?? '-' }}</span>
                                                        @else
                                                            <span class="float-start">{{ $item->user->name ?? '-' }}</span> <span class="float-end btn btn-xs" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $item->flow ?? '-' }}</span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px">
                                                                @if ($item->created_at)
                                                                    @php
                                                                        Carbon\Carbon::setLocale('id');
                                                                        $created_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                                        $new_created_at = $created_at->translatedFormat('l, d F Y H:i:s');
                                                                    @endphp
                                                                    {{ $new_created_at  }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </span>
                                                            <br>
                                                            <span style="color: rgb(173, 173, 173); font-size:10px;">Tugas {{ $penugasan->nomor_penugasan }} diselesaikan oleh {{ $item->user->name ?? '-' }}</span>
                                                        @endif
                                                        @if (!$loop->last)
                                                            <hr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($penugasan->status == 'PENDING')
                                                    <span class="float-end btn btn-xs" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $penugasan->status ?? '-' }}</span>
                                                @elseif($penugasan->status == 'PROCESS')
                                                    <span class="float-end btn btn-xs" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $penugasan->status ?? '-' }}</span>
                                                @else
                                                    <span class="float-end btn btn-xs" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $penugasan->status ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <ul class="action">
                                                    @if ($penugasan->status == 'PENDING')
                                                        <li class="edit">
                                                            <a href="{{ url('/penugasan/edit/'.$penugasan->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ url('/penugasan/delete/'.$penugasan->id) }}" method="post" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $penugasans->links() }}
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
