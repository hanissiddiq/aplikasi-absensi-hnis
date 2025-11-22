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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/settings/store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="name" class="float-left">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" autofocus value="{{ old('name', $data->name) }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="float-left">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" autofocus value="{{ old('alamat', $data->alamat) }}">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="float-left">Telfon</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" autofocus value="{{ old('phone', $data->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="whatsapp" class="float-left">Nomor Whatsapp <span style="color: red; font-style:italic;">(untuk notifikasi - berawalan 62)</span></label>
                            <input type="number" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" autofocus value="{{ old('whatsapp', $data->whatsapp) }}">
                            @error('whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="api_url" class="float-left">Api URL</label>
                            <input type="text" class="form-control @error('api_url') is-invalid @enderror" id="api_url" name="api_url" autofocus value="{{ old('api_url', $data->api_url) }}">
                            @error('api_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="api_whatsapp" class="float-left">Api Key Whatsapp</label>
                            <input type="text" class="form-control @error('api_whatsapp') is-invalid @enderror" id="api_whatsapp" name="api_whatsapp" autofocus value="{{ old('api_whatsapp', $data->api_whatsapp) }}">
                            @error('api_whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="float-left">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus value="{{ old('email', $data->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo" class="form-label">Logo</label>
                            <img src="{{ asset('/storage/'.$data->logo) }}" alt="" style="width: 20px">
                            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo">
                            @error('logo')
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
