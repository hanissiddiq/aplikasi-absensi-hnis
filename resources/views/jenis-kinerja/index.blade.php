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
                        <a href="{{ url('/jenis-kinerja/tambah') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/jenis-kinerja') }}">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" class="form-control" name="search" placeholder="Search..." id="search" value="{{ request('search') }}">
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
                                    <th>Nama Kinerja</th>
                                    <th>Bobot Penilaian</th>
                                    <th>Detail</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis_kinerja as $key => $jk)
                                    <tr>
                                        <td>{{ ($jenis_kinerja->currentpage() - 1) * $jenis_kinerja->perpage() + $key + 1 }}.</td>
                                        <td>{{ $jk->nama ?? '-' }}</td>
                                        <td>{{ $jk->bobot ?? '-' }}</td>
                                        <td>{{ $jk->detail ?? '-' }}</td>
                                        <td>
                                            <center>
                                                <a href="{{ url('/jenis-kinerja/edit/'.$jk->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $jenis_kinerja->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

@endsection
