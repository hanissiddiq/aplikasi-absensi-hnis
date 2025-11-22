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
                        <a href="{{ url('/kunjungan/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                        <a href="{{ url('/kunjungan/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success">Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/kunjungan') }}">
                        <div class="row mb-2">
                            <div class="col-3">
                                <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                                    <option value=""selected>Pilih Pegawai</option>
                                    @foreach($users as $u)
                                        @if(request('user_id') == $u->id)
                                            <option value="{{ $u->id }}"selected>{{ $u->name }}</option>
                                        @else
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-3">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mytable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Visit In</th>
                                    <th>Visit Out</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kunjungan as $key => $kun)
                                    <tr>
                                        <td>{{ ($kunjungan->currentpage() - 1) * $kunjungan->perpage() + $key + 1 }}.</td>
                                        <td>{{ $kun->user->name ?? '-' }}</td>
                                        <td>{{ $kun->tanggal ?? '-' }}</td>
                                        <td>
                                            @if ($kun->visit_in)
                                                @php
                                                    setlocale(LC_TIME, 'id_ID.UTF-8');
                                                    $visit_in = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kun->visit_in);
                                                    $new_visit_in = $visit_in->locale('id')->isoFormat('dddd, D MMM YYYY HH:mm:ss');
                                                @endphp
                                                {{ $new_visit_in }}
                                                <br>
                                                <br>
                                                <span class="fst-italic">Keterangan : {{ $kun->keterangan_in ?? '-' }}</span>
                                                <br>
                                                <br>
                                                <div style="display: flex; gap: 5px;">
                                                    <a href="{{ url('storage/'.$kun->foto_in) }}" target="_blank" style="background-color: rgb(146, 146, 146)" class="btn btn-xs"><i class="fa fa-paperclip me-2"></i>Lampiran</a>
                                                    <a href="{{ url('/maps/'.$kun->lat_in.'/'.$kun->long_in.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lokasi</a>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kun->visit_out)
                                                @php
                                                    setlocale(LC_TIME, 'id_ID.UTF-8');
                                                    $visit_out = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $kun->visit_out);
                                                    $new_visit_out = $visit_out->locale('id')->isoFormat('dddd, D MMM YYYY HH:mm:ss');
                                                @endphp
                                                {{ $new_visit_out }}
                                                <br>
                                                <br>
                                                <span class="fst-italic">Keterangan : {{ $kun->keterangan_out ?? '-' }}</span>
                                                <br>
                                                <br>
                                                <div style="display: flex; gap: 5px;">
                                                    <a href="{{ url('storage/'.$kun->foto_out) }}" target="_blank" style="background-color: rgb(146, 146, 146)" class="btn btn-xs"><i class="fa fa-paperclip me-2"></i>Lampiran</a>
                                                    <a href="{{ url('/maps/'.$kun->lat_out.'/'.$kun->long_out.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146)" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lokasi</a>
                                                </div>
                                            @else
                                                <a href="{{ url('/kunjungan/visit-out/'.$kun->id) }}" class="btn btn-xs btn-primary">+ Visit Out</a>
                                            @endif
                                        </td>
                                        <td>{{ $kun->status ?? '-' }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ url('/kunjungan/edit/'.$kun->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                </li>
                                                <li class="delete">
                                                    <form action="{{ url('/kunjungan/delete/'.$kun->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $kunjungan->links() }}
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
