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
                        <a href="{{ url('/kontrak') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/kontrak/update/'.$kontrak->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="tanggal" class="float-left">Tanggal</label>
                        <input type="datetime" style="background-color: white" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $kontrak->tanggal) }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="user_id" class="float-left">Nama Pegawai</label>
                        <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($users as $user)
                                @if(old('user_id', $kontrak->user_id) == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis_kontrak">Jenis Kontrak</label>
                        <select name="jenis_kontrak" id="jenis_kontrak" class="form-control @error('jenis_kontrak') is-invalid @enderror selectpicker" data-live-search="true">
                            <option value="">-- Pilih Jenis Kontrak --</option>
                            <option value="Perjanjian Kerja Waktu Tertentu (PKWT)" {{ 'Perjanjian Kerja Waktu Tertentu (PKWT)' == old('jenis_kontrak', $kontrak->jenis_kontrak) ? 'selected="selected"' : '' }}>Perjanjian Kerja Waktu Tertentu (PKWT)</option>
                            <option value="Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)" {{ 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)' == old('jenis_kontrak', $kontrak->jenis_kontrak) ? 'selected="selected"' : '' }}>Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)</option>
                            <option value="Tenaga Harian Lepas (THL)" {{ 'Tenaga Harian Lepas (THL)' == old('jenis_kontrak', $kontrak->jenis_kontrak) ? 'selected="selected"' : '' }}>Tenaga Harian Lepas (THL)</option>
                        </select>
                        @error('jenis_kontrak')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mb-4">
                            <label for="tanggal_mulai" class="float-left">Tanggal Mulai</label>
                            <input type="datetime" style="background-color: white" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kontrak->tanggal_mulai) }}">
                            @error('tanggal_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-6 mb-4" id="tanggalSelesai">
                            <label for="tanggal_selesai" class="float-left">Tanggal Selesai</label>
                            <input type="datetime" style="background-color: white" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kontrak->tanggal_selesai) }}">
                            @error('tanggal_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan', $kontrak->keterangan) }}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kontrak_file_path" class="float-left">File</label>
                        <input type="file" class="form-control @error('kontrak_file_path') is-invalid @enderror" id="kontrak_file_path" name="kontrak_file_path" value="{{ old('kontrak_file_path') }}">
                        @error('kontrak_file_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @if ($kontrak->kontrak_file_path)
                            <a href="{{ url('/storage/'.$kontrak->kontrak_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $kontrak->kontrak_file_name }}</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            let jenis_kontrak = $('#jenis_kontrak').val();
            if (jenis_kontrak !== 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)') {
                $('#tanggalSelesai').show();
            } else {
                $('#tanggalSelesai').hide();
            }

            $('body').on('change', '#jenis_kontrak', function (event) {
                let jenis_kontrak = $('#jenis_kontrak').val();
                if (jenis_kontrak !== 'Perjanjian Kerja Waktu Tidak Tertentu (PKWTT)') {
                    $('#tanggalSelesai').show();
                    $('#tanggal_selesai').val(null);
                } else {
                    $('#tanggalSelesai').hide();
                    $('#tanggal_selesai').val(null);
                }
            });
        </script>
    @endpush
@endsection
