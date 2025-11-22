@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/target-kinerja/update-user/'.$target_kinerja_team->id.'/'.$target_kinerja->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="group-input">
                            <label for="judul" class="float-left">Judul</label>
                            <input type="text" class="@error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $target_kinerja_team->judul) }}">
                            @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jumlah" class="float-left">Jumlah Penjualan</label>
                            <input type="text" class="money @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah', $target_kinerja_team->jumlah) }}" onkeyup="calculation()">
                            @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="target_pribadi" class="float-left">Target Pribadi</label>
                            <input type="text" class="money @error('target_pribadi') is-invalid @enderror" id="target_pribadi" name="target_pribadi" value="{{ old('target_pribadi', $target_kinerja_team->target_pribadi) }}" readonly>
                            @error('target_pribadi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="sisa_target_pribadi" class="float-left">Sisa Target Pribadi</label>
                            <input type="text" class="money @error('sisa_target_pribadi') is-invalid @enderror" id="sisa_target_pribadi" name="sisa_target_pribadi" value="{{ old('sisa_target_pribadi', $target_kinerja_team->target_pribadi - $target_kinerja_team->jumlah) }}" readonly>
                            @error('sisa_target_pribadi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col group-input">
                                <label for="capai" class="float-left">Capai %</label>
                                <input type="text" class="@error('capai') is-invalid @enderror" id="capai" name="capai" value="{{ old('capai', $target_kinerja_team->capai) }}" readonly>
                                @error('capai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col group-input">
                                <label for="nilai" class="float-left">Nilai</label>
                                <input type="text" class="@error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai', $target_kinerja_team->nilai) }}" readonly>
                                @error('nilai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="group-input">
                            <label for="target_team" class="float-left">Target Team</label>
                            <input type="text" class="money @error('target_team') is-invalid @enderror" id="target_team" name="target_team" value="{{ old('target_team', $target_kinerja->target_team) }}" readonly>
                            @error('target_team')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="group-input">
                            <label for="sisa_target_team" class="float-left">Sisa Target Team</label>
                            <input type="text" class="money @error('sisa_target_team') is-invalid @enderror" id="sisa_target_team" name="sisa_target_team" value="{{ old('sisa_target_team', $target_kinerja->target_team - $sum_jumlah - $target_kinerja_team->jumlah) }}" readonly>
                            @error('sisa_target_team')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" name="sum_jumlah" id="sum_jumlah" class="sum_jumlah" value="{{ $sum_jumlah }}">


                        <div class="row">
                            <div class="col group-input">
                                <label for="bonus_p" class="float-left">Bonus Pribadi</label>
                                <input type="text" class="money @error('bonus_p') is-invalid @enderror" id="bonus_p" name="bonus_p" value="{{ old('bonus_p', $target_kinerja_team->bonus_p) }}" readonly>
                                @error('bonus_p')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <input type="hidden" name="jumlah_persen_pribadi" id="jumlah_persen_pribadi" class="jumlah_persen_pribadi" value="{{ $target_kinerja_team->jumlah_persen_pribadi }}">

                            <div class="col group-input">
                                <label for="bonus_t" class="float-left">Bonus Team</label>
                                <input type="text" class="money @error('bonus_t') is-invalid @enderror" id="bonus_t" name="bonus_t" value="{{ old('bonus_t', $target_kinerja_team->bonus_t) }}" readonly>
                                @error('bonus_t')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <input type="hidden" name="jumlah_persen_team" id="jumlah_persen_team" class="jumlah_persen_team" value="{{ $target_kinerja->jumlah_persen_team }}">

                        </div>

                        <div class="row">
                            <div class="col group-input">
                                <label for="tanggal_awal" class="float-left">Tanggal Awal Target</label>
                                <input type="text" class="@error('tanggal_awal') is-invalid @enderror" id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal', $target_kinerja->tanggal_awal) }}" readonly>
                                @error('tanggal_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col group-input">
                                <label for="tanggal_akhir" class="float-left">Tanggal Akhir Target</label>
                                <input type="text" class=" @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir', $target_kinerja->tanggal_akhir) }}" readonly>
                                @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="group-input">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="@error('keterangan') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan', $target_kinerja_team->keterangan) }}</textarea>
                            @error('keterangan')
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            function replaceCurrency(n) {
                if (n) {
                    return n.replace(/\,/g, '');
                }
            }

            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });


            function calculation() {
                let target_pribadi = $('#target_pribadi').val() ? parseFloat(replaceCurrency($('#target_pribadi').val())) : 0;
                let jumlah = $('#jumlah').val() ? parseFloat(replaceCurrency($('#jumlah').val())) : 0;
                let sisa_target_pribadi = target_pribadi - jumlah;
                $('#sisa_target_pribadi').val(accounting.formatMoney(sisa_target_pribadi, '', 0, ",", "."));
                let capai = (jumlah / target_pribadi) * 100;
                if (capai <= 50) {
                    $('#nilai').val('Buruk');
                } else if (capai <= 70) {
                    $('#nilai').val('Cukup');
                } else if (capai <= 80) {
                    $('#nilai').val('Baik');
                } else {
                    $('#nilai').val('Mantap');
                }
                $('#capai').val(capai.toFixed(2));

                let target_team = $('#target_team').val() ? parseFloat(replaceCurrency($('#target_team').val())) : 0;
                let sum_jumlah = $('#sum_jumlah').val() ? parseFloat($('#sum_jumlah').val()) : 0;
                let sisa_target_team = target_team - sum_jumlah - jumlah;
                $('#sisa_target_team').val(accounting.formatMoney(sisa_target_team, '', 0, ",", "."));

                let jumlah_persen_pribadi = $('#jumlah_persen_pribadi').val() ? parseFloat($('#jumlah_persen_pribadi').val()) : 0;
                let bonus_p = jumlah * (jumlah_persen_pribadi / 100);
                $('#bonus_p').val(accounting.formatMoney(bonus_p, '', 0, ",", "."));

                let jumlah_persen_team = $('#jumlah_persen_team').val() ? parseFloat($('#jumlah_persen_team').val()) : 0;
                let bonus_t = (target_team - sisa_target_team) * (jumlah_persen_team / 100);
                $('#bonus_t').val(accounting.formatMoney(bonus_t, '', 0, ",", "."));

            }
        </script>
    @endpush
@endsection
