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
                        <a href="{{ url('/exit') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/exit/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user_id" class="float-left">Nama Pegawai</label>
                        <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach ($users as $user)
                                @if(old('user_id') == $user->id)
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
                        <label for="jenis">Jenis Keberhentian</label>
                        <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror selectpicker" data-live-search="true">
                            <option value="">-- Pilih Jenis Keberhentian --</option>
                            <option value="PHK" {{ 'PHK' == old('jenis') ? 'selected="selected"' : '' }}>PHK</option>
                            <option value="Mengundurkan Diri" {{ 'Mengundurkan Diri' == old('jenis') ? 'selected="selected"' : '' }}>Mengundurkan Diri</option>
                            <option value="Meninggal Dunia" {{ 'Meninggal Dunia' == old('jenis') ? 'selected="selected"' : '' }}>Meninggal Dunia</option>
                            <option value="Pensiun" {{ 'Pensiun' == old('jenis') ? 'selected="selected"' : '' }}>Pensiun</option>
                        </select>
                        @error('jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alasan" class="form-label">alasan</label>
                        <textarea name="alasan" id="alasan" class="form-control @error('alasan') is-invalid @enderror" cols="30" rows="10">{{ old('alasan') }}</textarea>
                        @error('alasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal" class="float-left">Tanggal</label>
                        <input type="datetime" style="background-color: white" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="pegawai_keluar_file_path" class="float-left">File</label>
                        <input type="file" class="form-control @error('pegawai_keluar_file_path') is-invalid @enderror" id="pegawai_keluar_file_path" name="pegawai_keluar_file_path" value="{{ old('pegawai_keluar_file_path') }}">
                        @error('pegawai_keluar_file_path')
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

@endsection
