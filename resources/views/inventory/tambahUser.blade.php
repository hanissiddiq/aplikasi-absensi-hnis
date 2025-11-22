@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/inventory/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <label for="kode_barang" class="float-left">Kode Barang</label>
                            <input type="text" class="@error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $kode_barang) }}">
                            @error('kode_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="nama_barang" class="float-left">Nama Barang</label>
                            <input type="text" class="@error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                            @error('nama_barang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col group-input">
                                <label for="stok" class="float-left">Stok</label>
                                <input type="number" step="0.01" class="@error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col group-input">
                                <label for="uom" class="float-left">UoM</label>
                                <input type="text" class="@error('uom') is-invalid @enderror" id="uom" name="uom" value="{{ old('uom') }}">
                                @error('uom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="group-input">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" class="@error('desc') is-invalid @enderror" cols="30" rows="10">{{ old('desc') }}</textarea>
                            @error('desc')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col group-input">
                                <label style="z-index: 1000" for="lokasi_id" class="float-left">Lokasi</label>
                                <select class="selectpicker @error('lokasi_id') is-invalid @enderror" id="lokasi_id" name="lokasi_id" data-live-search="true">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($lokasi as $lok)
                                        @if(old('lokasi_id') == $lok->id)
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

                            <div class="col group-input">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', auth()->user()->jabatan->nama_jabatan ?? '') }}" readonly>
                                <input type="hidden" name="jabatan_id" id="jabatan_id" value="{{ old('jabatan_id', auth()->user()->jabatan_id) }}" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
     @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });
            $('select').select2();
        </script>
    @endpush
@endsection
