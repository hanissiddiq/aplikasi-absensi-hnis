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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/kunjungan/update/'.$kunjungan->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="user_id" class="float-left">Nama</label>
                            <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                                <option value="">-- Pilih --</option>
                                @foreach ($user as $us)
                                    @if(old('user_id', $kunjungan->id) == $us->id)
                                        <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                    @else
                                        <option value="{{ $us->id }}">{{ $us->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="foto_in" class="form-label">Foto (In)</label>
                                <input class="form-control @error('foto_in') is-invalid @enderror" type="file" id="foto_in" name="foto_in">
                                @error('foto_in')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            @if ($kunjungan->visit_out)
                                <div class="col">
                                    <label for="foto_out" class="form-label">Foto (Out)</label>
                                    <input class="form-control @error('foto_out') is-invalid @enderror" type="file" id="foto_out" name="foto_out">
                                    @error('foto_out')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="keterangan_in" class="form-label">Keterangan (In)</label>
                                <textarea name="keterangan_in" id="keterangan_in" class="form-control @error('keterangan_in') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_in', $kunjungan->keterangan_in) }}</textarea>
                                @error('keterangan_in')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            @if ($kunjungan->visit_out)
                                <div class="col">
                                    <label for="keterangan_out" class="form-label">Keterangan (Out)</label>
                                    <textarea name="keterangan_out" id="keterangan_out" class="form-control @error('keterangan_out') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_out', $kunjungan->keterangan_out) }}</textarea>
                                    @error('keterangan_out')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        @if ($kunjungan->visit_out)
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
                                        @if(old('status', $kunjungan->status) == $s["status"])
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
                        @endif

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
