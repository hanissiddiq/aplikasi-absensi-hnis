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
                        <a href="{{ url('/rapat') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/rapat/update/'.$rapat->id) }}">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="nama" class="float-left">Nama Pertemuan</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $rapat->nama) }}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="float-left">Tanggal</label>
                            <input type="datetime" style="background-color: white" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $rapat->tanggal) }}">
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai" class="float-left">Jam Mulai</label>
                            <input type="text" class="form-control clockpicker @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" autofocus value="{{ old('jam_mulai', $rapat->jam_mulai) }}">
                            @error('jam_mulai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_selesai" class="float-left">Jam Selesai</label>
                            <input type="text" class="form-control clockpicker @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" autofocus value="{{ old('jam_selesai', $rapat->jam_selesai) }}">
                            @error('jam_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="float-left">Lokasi Pertemuan</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $rapat->lokasi) }}">
                            @error('lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="detail" class="form-label">Detail Pertemuan</label>
                            <textarea name="detail" id="detail" class="form-control @error('detail') is-invalid @enderror" cols="30" rows="10">{{ old('detail', $rapat->detail) }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <?php $jenis = array(
                                [
                                    "jenis" => "Pertemuan Offline"
                                ],
                                [
                                    "jenis" => "Pertemuan Online"
                                ]);
                            ?>
                            <label for="jenis">Jenis Pertemuan</label>
                            <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror selectpicker" data-live-search="true">
                                <option value="">Pilih Jenis Pertemuan</option>
                                @foreach ($jenis as $jen)
                                    @if(old('jenis', $rapat->jenis) == $jen["jenis"])
                                    <option value="{{ $jen["jenis"] }}" selected>{{ $jen["jenis"] }}</option>
                                    @else
                                    <option value="{{ $jen["jenis"] }}">{{ $jen["jenis"] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id" class="float-left">Peserta</label>
                            <select class="form-control selectpicker @error('user_id') is-invalid @enderror" id="user_id" name="user_id[]" multiple>
                                <option value="">-- Pilih --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ (is_array(old('user_id', $user_id)) && in_array($user->id, old('user_id', $user_id))) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
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
