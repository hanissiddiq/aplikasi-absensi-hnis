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
                        <a href="{{ url('/berita') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/berita/store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            @php
                                $tipe = array(
                                    [
                                        "tipe" => "Berita",
                                    ],
                                    [
                                        "tipe" => "Informasi",
                                    ],
                                );
                            @endphp
                            <label for="tipe" class="float-left">Tipe</label>
                            <select name="tipe" id="tipe" class="form-control selectpicker" data-live-search="true">
                                <option value=""selected>-- Pilih Tipe --</option>
                                @foreach($tipe as $tip)
                                    @if(request('tipe') == $tip['tipe'])
                                        <option value="{{ $tip['tipe'] }}"selected>{{ $tip['tipe'] }}</option>
                                    @else
                                        <option value="{{ $tip['tipe'] }}">{{ $tip['tipe'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tipe')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul" class="float-left">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" autofocus value="{{ old('judul') }}">
                            @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi" class="float-left">Isi Konten</label>
                            <input id="isi" type="hidden" name="isi" {!! old('isi') !!}>
                            <trix-editor input="isi">{!! old('isi') !!}</trix-editor>
                        </div>

                        <div class="form-group">
                            <label for="berita_file_path" class="float-left">Gambar</label>
                            <input type="file" class="form-control @error('berita_file_path') is-invalid @enderror" id="berita_file_path" name="berita_file_path" autofocus value="{{ old('berita_file_path') }}">
                            @error('berita_file_path')
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
