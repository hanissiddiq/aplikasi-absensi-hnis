@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="d-flex justify-content-center mb-4">
            <form action="{{ url('/my-location') }}" method="get">
                @csrf
                <input type="hidden" name="lat" id="lat2">
                <input type="hidden" name="long" id="long2">
                <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-success">Lihat Lokasi Saya</button>
            </form>
        </div>
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/kunjungan/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <label for="pegawai">Nama</label>
                            <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', auth()->user()->name) }}" readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                        </div>

                        <input type="hidden" id="lat" name="lat_in" value="{{ old('lat_in') }}">
                        <input type="hidden" id="long" name="long_in" value="{{ old('long_in') }}">

                        <div class="group-input">
                            <input class="form-control @error('foto_in') is-invalid @enderror" type="file" id="foto_in" name="foto_in">
                            @error('foto_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="keterangan_in" class="form-label">Keterangan</label>
                            <textarea name="keterangan_in" id="keterangan_in" class="@error('keterangan_in') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_in') }}</textarea>
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
    <br>
    <br>
    <br>
    <br>
    @push('script')
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                $('#lat').val(position.coords.latitude);
                $('#lat2').val(position.coords.latitude);
                $('#long').val(position.coords.longitude);
                $('#long2').val(position.coords.longitude);
            }

            setInterval(getLocation, 1000);

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
