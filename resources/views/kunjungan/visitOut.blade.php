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
                        <a href="{{ url('/kunjungan') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                        <form action="{{ url('/my-location') }}" method="get">
                            @csrf
                            <input type="hidden" name="lat" id="lat2">
                            <input type="hidden" name="long" id="long2">
                            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-success btn-sm ms-2">Lihat Lokasi Saya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/kunjungan/visit-out/update/'.$kunjungan->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" value="{{ old('nama', $kunjungan->user->name ?? '') }}" id="nama" name="nama" disabled>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" id="lat" name="lat_out" value="{{ old('lat_out') }}">
                        <input type="hidden" id="long" name="long_out" value="{{ old('long_out') }}">

                        <div class="form-group">
                            <label for="foto_out" class="form-label">Foto</label>
                            <input class="form-control @error('foto_out') is-invalid @enderror" type="file" id="foto_out" name="foto_out">
                            @error('foto_out')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan_out" class="form-label">Keterangan</label>
                            <textarea name="keterangan_out" id="keterangan_out" class="form-control @error('keterangan_out') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_out') }}</textarea>
                            @error('keterangan_out')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            @php
                                $status = array(
                                    [
                                        "status" => "Pending",
                                    ],
                                    [
                                        "status" => "Sukses",
                                    ],
                                    [
                                        "status" => "Gagal",
                                    ]
                                );
                            @endphp
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control selectpicker @error('status') is-invalid @enderror" data-live-search="true">
                                <option value="">-- Pilih --</option>
                                @foreach ($status as $s)
                                    @if(old('status') == $s["status"])
                                    <option value="{{ $s["status"] }}" selected>{{ $s["status"] }}</option>
                                    @else
                                    <option value="{{ $s["status"] }}">{{ $s["status"] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                $('.clockpicker').clockpicker({
                    donetext: 'Done'
                });

                $('body').on('keyup', '.clockpicker', function (event) {
                    var val = $(this).val();
                    val = val.replace(/[^0-9:]/g, '');
                    val = val.replace(/:+/g, ':');
                    $(this).val(val);
                });
            });
        </script>
    @endpush
@endsection
