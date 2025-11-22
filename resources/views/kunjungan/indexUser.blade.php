@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/kunjungan') }}">

                    <div class="row">
                        <div class="col-4">
                            <input type="datetime" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-4">
                            <input type="datetime" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-4">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/kunjungan/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-striped">
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
                                            <a href="{{ url('storage/'.$kun->foto_in) }}" target="_blank" style="background-color: rgb(146, 146, 146); font-size: 9px;" class="btn btn-xs"><i class="fa fa-paperclip me-2"></i>Lampiran</a>
                                            <a href="{{ url('/maps/'.$kun->lat_in.'/'.$kun->long_in.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146); font-size: 9px;" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lokasi</a>
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
                                            <a href="{{ url('storage/'.$kun->foto_out) }}" target="_blank" style="background-color: rgb(146, 146, 146); font-size: 9px;" class="btn btn-xs"><i class="fa fa-paperclip me-2"></i>Lampiran</a>
                                            <a href="{{ url('/maps/'.$kun->lat_out.'/'.$kun->long_out.'/'.$kun->user->id) }}" style="background-color: rgb(146, 146, 146); font-size: 9px;" class="btn btn-xs" target="_blank"><i class="fa fa-eye" class="me-2"></i> Lokasi</a>
                                        </div>
                                    @else
                                        <a href="{{ url('/kunjungan/visit-out/'.$kun->id) }}" style=" font-size: 9px;" class="btn btn-xs btn-primary">+ Visit Out</a>
                                    @endif
                                </td>
                                <td>{{ $kun->status ?? '-' }}</td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="{{ url('/kunjungan/edit/'.$kun->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                        <form action="{{ url('/kunjungan/delete/'.$kun->id) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm btn-circle" style="width: 40px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        <div class="d-flex justify-content-end mr-4">
            {{ $kunjungan->links() }}
        </div>
    </div>
    <br>
    <br>
@endsection
