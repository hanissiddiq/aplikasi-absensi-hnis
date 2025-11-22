@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/laporan-kerja/update/'.$laporan_kerja->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="group-input">
                            <label for="informasi_umum" class="form-label">Informasi Umum</label>
                            <textarea name="informasi_umum" id="informasi_umum" class="@error('informasi_umum') is-invalid @enderror" rows="5">{{ old('informasi_umum', $laporan_kerja->informasi_umum) }}</textarea>
                            @error('informasi_umum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="pekerjaan_dilaksanakan" class="form-label">Pekerjaan Yang Dilaksanakan</label>
                            <textarea name="pekerjaan_dilaksanakan" id="pekerjaan_dilaksanakan" class="@error('pekerjaan_dilaksanakan') is-invalid @enderror" rows="5">{{ old('pekerjaan_dilaksanakan', $laporan_kerja->pekerjaan_dilaksanakan) }}</textarea>
                            @error('pekerjaan_dilaksanakan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="pekerjaan_belum_selesai" class="form-label">Pekerjaan Belum Selesai</label>
                            <textarea name="pekerjaan_belum_selesai" id="pekerjaan_belum_selesai" class="@error('pekerjaan_belum_selesai') is-invalid @enderror" rows="5">{{ old('pekerjaan_belum_selesai', $laporan_kerja->pekerjaan_belum_selesai) }}</textarea>
                            @error('pekerjaan_belum_selesai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" class="@error('catatan') is-invalid @enderror" rows="5">{{ old('catatan', $laporan_kerja->catatan) }}</textarea>
                            @error('catatan')
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

