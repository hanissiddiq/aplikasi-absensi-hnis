@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/inventory') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/inventory/update/'.$inventory->id) }}">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="kode_barang" class="float-left">Kode Barang</label>
                            <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $inventory->kode_barang) }}">
                            @error('kode_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_barang" class="float-left">Nama Barang</label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $inventory->nama_barang) }}">
                            @error('nama_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="stok" class="float-left">Stok</label>
                                <input type="number" step="0.01" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $inventory->stok) }}">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="uom" class="float-left">UoM</label>
                                <input type="text" class="form-control @error('uom') is-invalid @enderror" id="uom" name="uom" value="{{ old('uom', $inventory->uom) }}">
                                @error('uom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10">{{ old('desc', $inventory->desc) }}</textarea>
                            @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="lokasi_id" class="float-left">Lokasi</label>
                                <select class="form-control selectpicker @error('lokasi_id') is-invalid @enderror" id="lokasi_id" name="lokasi_id" data-live-search="true">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($lokasi as $lok)
                                        @if(old('lokasi_id', $inventory->lokasi_id) == $lok->id)
                                            <option value="{{ $lok->id }}" selected>{{ $lok->nama_lokasi }}</option>
                                        @else
                                            <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="jabatan_id" class="float-left">Divisi / Jabatan</label>
                                <select class="form-control selectpicker @error('jabatan_id') is-invalid @enderror" id="jabatan_id" name="jabatan_id" data-live-search="true">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($jabatan as $jab)
                                        @if(old('jabatan_id', $inventory->jabatan_id) == $jab->id)
                                            <option value="{{ $jab->id }}" selected>{{ $jab->nama_jabatan }}</option>
                                        @else
                                            <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
