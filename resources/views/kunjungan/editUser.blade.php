@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/kunjungan/update/'.$kunjungan->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="group-input">
                            <label for="nama">Nama</label>
                            <input type="text" class="@error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kunjungan->user->name ?? '') }}" readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ $kunjungan->user->id ?? '' }}">
                        </div>

                        <div class="group-input">
                            <label for="foto_in" class="form-label">Foto (In)</label>
                            <input class="form-control @error('foto_in') is-invalid @enderror" type="file" id="foto_in" name="foto_in">
                            @error('foto_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="keterangan_in" class="form-label">Keterangan (In)</label>
                            <textarea name="keterangan_in" id="keterangan_in" class="@error('keterangan_in') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_in', $kunjungan->keterangan_in) }}</textarea>
                            @error('keterangan_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @if ($kunjungan->visit_out)
                            <div class="group-input">
                                <label for="foto_out" class="form-label">Foto (Out)</label>
                                <input class="form-control @error('foto_out') is-invalid @enderror" type="file" id="foto_out" name="foto_out">
                                @error('foto_out')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="group-input">
                                <label for="keterangan_out" class="form-label">Keterangan (Out)</label>
                                <textarea name="keterangan_out" id="keterangan_out" class="@error('keterangan_out') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan_out', $kunjungan->keterangan_out) }}</textarea>
                                @error('keterangan_out')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        @endif

                        @if ($kunjungan->visit_out)
                            <div class="group-input">
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
                                <select name="status" id="status" class="selectpicker @error('status') is-invalid @enderror" data-live-search="true">
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
                $('#long').val(position.coords.longitude);
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
