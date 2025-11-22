@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/kasbon') }}">
                    <div class="row">
                        <div class="col-11">
                            <input type="text" name="search" placeholder="search.." id="search" value="{{ request('search') }}">
                        </div>
                        <div class="col-1">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/inventory/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <table id="tablePayroll" class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>UoM</th>
                        <th>Description</th>
                        <th>Lokasi</th>
                        <th>Divisi / Jabatan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inventory->kode_barang ?? '-' }}</td>
                            <td>{{ $inventory->nama_barang ?? '-' }}</td>
                            <td>{{ $inventory->stok ?? '-' }}</td>
                            <td>{{ $inventory->uom ?? '-' }}</td>
                            <td>{!! $inventory->desc ? nl2br(e($inventory->desc)) : '-' !!}</td>
                            <td>{{ $inventory->lokasi->nama_lokasi ?? '-' }}</td>
                            <td>{{ $inventory->jabatan->nama_jabatan ?? '-' }}</td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <a href="{{ url('/inventory/edit/'.$inventory->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-solid fa-edit"></i></a>
                                    <form action="{{ url('/inventory/delete/'.$inventory->id) }}" method="post" class="d-inline">
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
            {{ $inventories->links() }}
        </div>
    </div>
    <br>
    <br>
@endsection
