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
                        <a href="{{ url('/target-kinerja') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ url('/target-kinerja/store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nomor" class="float-left">Nomor Target Kinerja</label>
                                <input type="text" class="form-control borderi @error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor', $nomor) }}" readonly>
                                @error('nomor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="table-responsive mb-3">
                            @php
                                $old = session()->getOldInput();
                            @endphp
                            <table class="table table-striped" id="tablemultiple" style="font-size:12px">
                                <thead>
                                    <tr>
                                        <th style="min-width: 300px; background-color:rgb(243, 243, 243);" class="text-center">Nama Pegawai</th>
                                        <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Jabatan</th>
                                        <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Target Pribadi</th>
                                        <th style="min-width: 130px; background-color:rgb(243, 243, 243);" class="text-center">Jumlah %</th>
                                        <th style="min-width: 200px; background-color:rgb(243, 243, 243);" class="text-center">Bonus Pribadi</th>
                                        <th class="text-center" style="background-color:rgb(243, 243, 243);">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($old['user_id']))
                                        @foreach ($old['user_id'] as $key => $detailName)
                                            <tr id="multiple{{ $key }}">
                                                <td style="vertical-align: middle;">
                                                    <select class="form-control borderi select2 user_id" id="user_id" name="user_id[]">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}" {{ $user->id == old('user_id')[$key] ? 'selected="selected"' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="text" class="form-control borderi jabatan" id="jabatan" name="jabatan[]" value="{{ old('jabatan')[$key] }}" readonly>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="text" class="form-control borderi money target_pribadi" id="target_pribadi" name="target_pribadi[]" value="{{ old('target_pribadi')[$key] }}">
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <div class="input-group" style="width: 120px">
                                                        <input type="number" class="form-control borderi jumlah_persen_pribadi" id="jumlah_persen_pribadi" name="jumlah_persen_pribadi[]" value="{{ old('jumlah_persen_pribadi')[$key] }}">
                                                        <div class="input-group-text borderi">
                                                            <span>%</span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="vertical-align: middle;">
                                                    <input type="text" class="form-control borderi money bonus_pribadi" id="bonus_pribadi" name="bonus_pribadi[]" value="{{ old('bonus_pribadi')[$key] }}" readonly>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle;">
                                                    <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                                </td>

                                                <td style="display:none;">
                                                    <input type="hidden" class="jabatan_id" id="jabatan_id" name="jabatan_id[]" value="{{ old('jabatan_id')[$key] }}" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="multiple0">
                                            <td style="vertical-align: middle;">
                                                <select class="form-control borderi select2 user_id" id="user_id" name="user_id[]">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td style="vertical-align: middle;">
                                                <input type="text" class="form-control borderi jabatan" id="jabatan" name="jabatan[]" readonly>
                                            </td>

                                            <td style="vertical-align: middle;">
                                                <input type="text" class="form-control borderi money target_pribadi" id="target_pribadi" name="target_pribadi[]">
                                            </td>

                                            <td style="vertical-align: middle;">
                                                <div class="input-group" style="width: 120px">
                                                    <input type="number" class="form-control borderi jumlah_persen_pribadi" id="jumlah_persen_pribadi" name="jumlah_persen_pribadi[]">
                                                    <div class="input-group-text borderi">
                                                        <span>%</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td style="vertical-align: middle;">
                                                <input type="text" class="form-control borderi money bonus_pribadi" id="bonus_pribadi" name="bonus_pribadi[]" readonly>
                                            </td>

                                            <td class="text-center" style="vertical-align: middle;">
                                                <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                            </td>

                                            <td style="display:none;">
                                                <input type="hidden" class="jabatan_id" id="jabatan_id" name="jabatan_id[]" readonly>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <a id="add_row" class="btn btn-sm btn-success mt-3">+ Tambah</a>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="target_team" class="float-left">Target Team</label>
                                <input type="text" class="form-control borderi money @error('target_team') is-invalid @enderror" id="target_team" name="target_team" value="{{ old('target_team') }}" readonly>
                                @error('target_team')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label for="jumlah_persen_team">Jumlah %</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control borderi @error('jumlah_persen_team') is-invalid @enderror" name="jumlah_persen_team" id="jumlah_persen_team" value="{{ old('jumlah_persen_team') }}" onkeyup="getBonusTeam()">
                                    <div class="input-group-text borderi">
                                        <span>%</span>
                                    </div>
                                    @error('jumlah_persen_team')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="bonus_team" class="float-left">Bonus Team</label>
                                <input type="text" class="form-control borderi money @error('bonus_team') is-invalid @enderror" id="bonus_team" name="bonus_team" value="{{ old('bonus_team') }}" readonly>
                                @error('bonus_team')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="tanggal_awal" class="float-left">Tanggal Awal Target</label>
                                <input type="datetime" class="form-control borderi @error('tanggal_awal') is-invalid @enderror" id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal') }}">
                                @error('tanggal_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label for="tanggal_akhir" class="float-left">Tanggal Akhir Target</label>
                                <input type="datetime" class="form-control borderi @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                                @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-2">
                                <label for="jackpot" class="float-end mt-3">Jackpot</label>
                            </div>

                            <div class="col-4">
                                <input type="text" class="form-control borderi money @error('jackpot') is-invalid @enderror" id="jackpot" name="jackpot" value="{{ old('jackpot') }}">
                                @error('jackpot')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <style>
            .select2-container--default .select2-selection--single {
                border-color: rgb(201, 201, 201) !important;
            }
            td {
                border: 1px solid #e2dede;
            }
            th {
                border: 1px solid #e2dede;
            }
        </style>
    @endpush

    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            function replaceCurrency(n) {
                if (n) {
                    return n.replace(/\,/g, '');
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.money').mask('000,000,000,000,000', {
                reverse: true
            });

            $('.select2').select2();

            var row_number = 1;
            var temp_row_number = row_number-1;
            $("#add_row").click(function(e) {
                e.preventDefault();
                var new_row_number = row_number - 1;
                var table = document.getElementById("tablemultiple");
                var tbodyRowCount = table.tBodies[0].rows.length;
                $(".user_id").select2('destroy');
                new_row = $('#tablemultiple tbody tr:last').clone();
                new_row.find("input").val("").end();
                new_row.find("select").val("").end();
                $('#tablemultiple').append(new_row);
                $('#tablemultiple tbody tr:last').attr('id','multiple'+(tbodyRowCount));
                row_number++;
                $('.user_id').select2();
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });
                temp_row_number = row_number - 1;
            });

            $('body').on('click', '.delete', function (event) {
                var table = document.getElementById("tablemultiple");
                var tbodyRowCount = table.tBodies[0].rows.length;
                if (tbodyRowCount <= 1) {
                    alert('Cannot delete if only 1 row!');
                } else {
                    if (confirm('Are you sure you want to delete?')) {
                        $(this).closest('tr').remove();
                        let target_team = 0;
                        $('.target_pribadi').each(function () {
                            target_team += $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                        });
                        let jumlah_persen_team = $('#jumlah_persen_team').val() ? parseFloat($('#jumlah_persen_team').val()) : 0;
                        let bonus_team = target_team * (jumlah_persen_team / 100);
                        $('#target_team').val(accounting.formatMoney(target_team, '', 0, ",", "."));
                        $('#bonus_team').val(accounting.formatMoney(bonus_team, '', 0, ",", "."));
                    }
                }
            });

            $('body').on('change', '.user_id', function (event) {
                let $row = $(this).closest('tr');
                let user_id = $row.find('td:eq(0) select').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/target-kinerja/ajaxUserJabatan') }}",
                    data: { user_id: user_id },
                    cache: false,
                    success: function(data) {
                        $row.find('td:eq(1) input').val(data.nama_jabatan);
                        $row.find('td:eq(6) input').val(data.id);
                    },
                    error: function(data) {
                        console.log('error:', data);
                    }
                });
            });

            $('body').on('keyup', '.target_pribadi', function (event) {
                let $row = $(this).closest('tr');
                let target_pribadi = $row.find('td:eq(2) input').val() ? parseFloat(replaceCurrency($row.find('td:eq(2) input').val())) : 0;
                let jumlah_persen_pribadi = $row.find('td:eq(3) input').val() ? parseFloat($row.find('td:eq(3) input').val()) : 0;
                let bonus_pribadi = target_pribadi * (jumlah_persen_pribadi / 100);
                $row.find('td:eq(4) input').val(accounting.formatMoney(bonus_pribadi, '', 0, ",", "."));

                let target_team = 0;
                $('.target_pribadi').each(function () {
                    target_team += $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                });

                let jumlah_persen_team = $('#jumlah_persen_team').val() ? parseFloat($('#jumlah_persen_team').val()) : 0;
                let bonus_team = target_team * (jumlah_persen_team / 100);

                $('#target_team').val(accounting.formatMoney(target_team, '', 0, ",", "."));
                $('#bonus_team').val(accounting.formatMoney(bonus_team, '', 0, ",", "."));
            });

            $('body').on('keyup', '.jumlah_persen_pribadi', function (event) {
                let $row = $(this).closest('tr');
                let target_pribadi = $row.find('td:eq(2) input').val() ? parseFloat(replaceCurrency($row.find('td:eq(2) input').val())) : 0;
                let jumlah_persen_pribadi = $row.find('td:eq(3) input').val() ? parseFloat($row.find('td:eq(3) input').val()) : 0;
                let bonus_pribadi = target_pribadi * (jumlah_persen_pribadi / 100);
                $row.find('td:eq(4) input').val(accounting.formatMoney(bonus_pribadi, '', 0, ",", "."));

                let target_team = 0;
                $('.target_pribadi').each(function () {
                    target_team += $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                });

                let jumlah_persen_team = $('#jumlah_persen_team').val() ? parseFloat($('#jumlah_persen_team').val()) : 0;
                let bonus_team = target_team * (jumlah_persen_team / 100);

                $('#target_team').val(accounting.formatMoney(target_team, '', 0, ",", "."));
                $('#bonus_team').val(accounting.formatMoney(bonus_team, '', 0, ",", "."));
            });

            function getBonusTeam() {
                let target_team = $('#target_team').val() ? parseFloat(replaceCurrency($('#target_team').val())) : 0;
                let jumlah_persen_team = $('#jumlah_persen_team').val() ? parseFloat($('#jumlah_persen_team').val()) : 0;
                let bonus_team = target_team * (jumlah_persen_team / 100);

                $('#bonus_team').val(accounting.formatMoney(bonus_team, '', 0, ",", "."));
            }

        </script>
    @endpush
@endsection
