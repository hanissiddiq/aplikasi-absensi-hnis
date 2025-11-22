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
                    <form action="{{ url('/kinerja-pegawai') }}">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="search" placeholder="Search..." id="search" value="{{ request('search') }}">
                            </div>
                            <div class="col-2">
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
                                    <th>Nama Pegawai</th>
                                    <th>Kinerja</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ($users->currentpage() - 1) * $users->perpage() + $key + 1 }}.</td>
                                        <td>{{ $user->name ?? '-' }}</td>
                                        <td>{{ $kinerja = $user->lastlk($user->id)->penilaian_berjalan ?? 0 }}</td>
                                        <td>
                                            @if($kinerja <= 0)
                                                <span class="badge badge-danger">Kinerja Buruk</span>
                                            @elseif($kinerja <= 50)
                                                <span class="badge badge-warning">Kinerja Cukup Buruk</span>
                                            @elseif($kinerja <= 100)
                                                <span class="badge badge-info">Kinerja Lumayan</span>
                                            @else
                                                <span class="badge badge-primary">Kinerja Baik</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
