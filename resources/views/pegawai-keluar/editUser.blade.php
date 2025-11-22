@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form  method="post" class="tf-form p-2"  action="{{ url('/exit/update/'.$pegawai_keluar->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="group-input">
                        <label for="user" class="float-left">user</label>
                        <input type="text" class="@error('user') is-invalid @enderror" id="user" name="user" value="{{ old('user', $pegawai_keluar->user->name ?? '') }}" readonly>
                        @error('user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input type="hidden" name="user_id" value="{{ old('user_id', $pegawai_keluar->user_id) }}">
                    </div>

                    <div class="group-input">
                        <label for="jenis" style="z-index: 100">Jenis Keberhentian</label>
                        <select name="jenis" id="jenis" class="@error('jenis') is-invalid @enderror selectpicker" data-live-search="true">
                            <option value="">-- Pilih Jenis Keberhentian --</option>
                            <option value="PHK" {{ 'PHK' == old('jenis', $pegawai_keluar->jenis) ? 'selected="selected"' : '' }}>PHK</option>
                            <option value="Mengundurkan Diri" {{ 'Mengundurkan Diri' == old('jenis', $pegawai_keluar->jenis) ? 'selected="selected"' : '' }}>Mengundurkan Diri</option>
                            <option value="Meninggal Dunia" {{ 'Meninggal Dunia' == old('jenis', $pegawai_keluar->jenis) ? 'selected="selected"' : '' }}>Meninggal Dunia</option>
                            <option value="Pensiun" {{ 'Pensiun' == old('jenis', $pegawai_keluar->jenis) ? 'selected="selected"' : '' }}>Pensiun</option>
                        </select>
                        @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="group-input">
                        <label for="alasan" class="form-label">alasan</label>
                        <textarea name="alasan" id="alasan" class="@error('alasan') is-invalid @enderror" cols="30" rows="10">{{ old('alasan', $pegawai_keluar->alasan) }}</textarea>
                        @error('alasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="group-input">
                        <label for="tanggal" class="float-left">Tanggal</label>
                        <input type="datetime" style="background-color: white" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $pegawai_keluar->tanggal) }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <label for="pegawai_keluar_file_path" class="float-left">File</label>
                    <div class="group-input">
                        <input type="file" class="form-control @error('pegawai_keluar_file_path') is-invalid @enderror" id="pegawai_keluar_file_path" name="pegawai_keluar_file_path" value="{{ old('pegawai_keluar_file_path') }}">
                        @error('pegawai_keluar_file_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @if ($pegawai_keluar->pegawai_keluar_file_path)
                            <a href="{{ url('/storage/'.$pegawai_keluar->pegawai_keluar_file_path) }}" style="font-size: 10px; color:blue"><i class="fa fa-download"></i> {{ $pegawai_keluar->pegawai_keluar_file_name }}</a>
                        @endif
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
        <script>
            $('select').select2();
        </script>
    @endpush
@endsection
