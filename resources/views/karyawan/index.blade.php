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
                        <a href="{{ url('/pegawai/tambah-pegawai') }}" class="btn btn-primary btn-sm ms-2">+ Tambah</a>
                        <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-table me-2"></i> Import</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Users</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('/pegawai/import') }}" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="file_excel">File Excel</label>
                                                <input type="file" name="file_excel" id="file_excel" class="form-control @error('file_excel') is-invalid @enderror">
                                                @error('file_excel')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-secondary" type="submit">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/pegawai/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-sm btn-success me-2"><i class="fa fa-file-excel me-2"></i> Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <form action="{{ url('/pegawai') }}">
                        <div class="row mb-2">
                            <div class="col-10">
                                <input type="text" placeholder="Search...." class="form-control" value="{{ request('search') }}" name="search">
                            </div>
                            <div class="col">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table table-bordered" style="vertical-align: middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;" class="text-center">Nama</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Foto</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Username</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Lokasi</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Divisi</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Role</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Dashboard</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Masa Berlaku</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Kartu</th>
                                    <th class="text-center" style="position: sticky; right: 0; background-color: rgb(215, 215, 215); z-index: 2;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data_user) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($data_user as $key => $du)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1;">{{ ($data_user->currentpage() - 1) * $data_user->perpage() + $key + 1 }}.</td>
                                            <td style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;">{{ $du->name }}</td>
                                            <td class="text-center">
                                                @if($du->foto_karyawan == null)
                                                    <img style="width: 80px; border-radius: 50px" src="{{ url('assets/img/foto_default.jpg') }}" alt="{{ $du->name ?? '-' }}">
                                                @else
                                                    <img style="width: 80px; border-radius: 50px" src="{{ url('/storage/'.$du->foto_karyawan) }}" alt="{{ $du->name ?? '-' }}">
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $du->username ?? '-' }}</td>
                                            <td>{{ $du->Lokasi->nama_lokasi ?? '-' }}</td>
                                            <td>{{ $du->Jabatan->nama_jabatan ?? '-' }}</td>
                                            <td class="text-center">
                                                @if (count($du->roles) > 0)
                                                    @foreach ($du->roles as $role)
                                                        <div class="badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $role->name ?? '-' }}</div>
                                                        <br>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $du->is_admin ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($du->masa_berlaku)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $masa_berlaku = Carbon\Carbon::createFromFormat('Y-m-d', $du->masa_berlaku);
                                                        $new_masa_berlaku = $masa_berlaku->translatedFormat('d F Y');
                                                    @endphp
                                                    @if ($du->masa_berlaku <= date('Y-m-d'))
                                                        <span class="btn btn-xs"  style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $new_masa_berlaku  }}</span> <br> <span class="btn btn-xs mt-2"  style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">Non-Aktif</span>
                                                    @else
                                                        <span class="btn btn-xs" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $new_masa_berlaku }}</span> <br> <span class="btn btn-xs mt-2" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">Aktif</span>
                                                    @endif
                                                @else
                                                    <span style="font-size: 30px">♾️</span> <br> <span class="btn btn-xs mt-2" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">Aktif</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ url('/pegawai/qrcode/'.$du->id) }}" class="btn" style="width: 150px; background-color:rgb(196, 196, 196)"><i class="fas fa-qrcode"></i> Qrcode</a></td>
                                            <td style="position: sticky; right: 0; background-color: rgb(235, 235, 235); z-index: 1;"z>
                                                <ul class="action">
                                                    <li class="edit me-2"><a href="{{ url('/pegawai/detail/'.$du->id) }}" title="Edit Pegawai"><i class="icon-pencil-alt"></i></a></li>

                                                    <li class="me-2"><a href="{{ url('/pegawai/edit-password/'.$du->id) }}" title="Ganti Password"><i class="fa fa-solid fa-key" style="color: rgb(11, 18, 222)"></i></a></li>

                                                    <li class="me-2"> <a href="{{ url('/pegawai/shift/'.$du->id) }}" title="Input Shift Pegawai"><i style="color:coral" class="fa fa-solid fa-clock"></i></a></li>

                                                    <li class="me-2"> <a href="{{ url('/pegawai/dinas-luar/'.$du->id) }}" title="Input Dinas Luar Pegawai"><i style="color:rgb(43, 198, 203)" class="fa fa-solid fa-route"></i></a></li>

                                                    <li class="me-2"> <a href="{{ url('/pegawai/kontrak/'.$du->id) }}" title="Kontrak Kerja"><i data-feather="trending-up"> </i></a></li>

                                                    @if ($du->foto_face_recognition == null || $du->foto_face_recognition == "")
                                                        <li><a href="{{ url('/pegawai/face/'.$du->id) }}" title="Face Recognition"><i style="color: black" class="fa fa-solid fa-camera"></i></a></li>
                                                    @endif

                                                    <li class="delete">
                                                        <form action="{{ url('/pegawai/delete/'.$du->id) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button title="Delete Pegawai" class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="icon-trash"></i></button>
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
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $data_user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




