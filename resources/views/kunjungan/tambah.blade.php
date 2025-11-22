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
                <form method="post" class="p-4" action="{{ url('/kunjungan/store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="user_id" class="float-left">Nama</label>
                            <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id" data-live-search="true">
                                <option value="">-- Pilih --</option>
                                @foreach ($user as $us)
                                    @if(old('user_id') == $us->id)
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

                        <input type="hidden" id="lat" name="lat_in" value="{{ old('lat_in') }}">
                        <input type="hidden" id="long" name="long_in" value="{{ old('long_in') }}">

                        <div class="form-group">
                            <label for="foto_in" class="form-label">Foto</label>
                            <input class="form-control @error('foto_in') is-invalid @enderror" type="file" id="foto_in" name="foto_in">
                            @error('foto_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan_in" class="form-label">Keterangan</label>
                            <textarea name="keterangan_in" id="keterangan_in" class="form-control @error('keterangan_in') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_in') }}</textarea>
                            @error('keterangan_in')
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
