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
                        <a href="{{ url('/inventory/tambah') }}" class="btn btn-primary">+ Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/inventory') }}">
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
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th style="min-width: 200px;" class="text-center">Kode Barang</th>
                                    <th style="min-width: 300px;" class="text-center">Nama Barang</th>
                                    <th style="min-width: 120px;" class="text-center">Stok</th>
                                    <th style="min-width: 200px;" class="text-center">UoM</th>
                                    <th style="min-width: 500px;" class="text-center">Description</th>
                                    <th style="min-width: 300px;" class="text-center">Lokasi</th>
                                    <th style="min-width: 300px;" class="text-center">Divisi / Jabatan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($inventories) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($inventories as $key => $inventory)
                                        <tr>
                                            <td>{{ ($inventories->currentpage() - 1) * $inventories->perpage() + $key + 1 }}.</td>
                                            <td class="text-center">{{ $inventory->kode_barang ?? '-' }}</td>
                                            <td class="text-center">{{ $inventory->nama_barang ?? '-' }}</td>
                                            <td class="text-center">{{ $inventory->stok ?? '-' }}</td>
                                            <td class="text-center">{{ $inventory->uom ?? '-' }}</td>
                                            <td>{!! $inventory->desc ? nl2br(e($inventory->desc)) : '-' !!}</td>
                                            <td class="text-center">{{ $inventory->lokasi->nama_lokasi ?? '-' }}</td>
                                            <td class="text-center">{{ $inventory->jabatan->nama_jabatan ?? '-' }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ url('/inventory/edit/'.$inventory->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ url('/inventory/delete/'.$inventory->id) }}" method="post" class="d-inline">
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
                        {{ $inventories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

@endsection
