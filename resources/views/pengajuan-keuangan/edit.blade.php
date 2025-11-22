@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <form method="post" class="tf-form p-2" action="{{ url('/pengajuan-keuangan/update/'.$pk->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="group-input">
                    <label for="pegawai">Nama Pegawai</label>
                    <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', $pk->user->name ?? '') }}" readonly>
                    <input type="hidden" name="user_id" id="user_id" value="{{ $pk->user->id ?? '' }}">
                </div>

                <div class="group-input">
                    <label for="nomor">Nomor Pengajuan</label>
                    <input type="text" class="@error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor', $pk->nomor) }}" readonly>
                </div>

                <div class="group-input">
                    <label for="tanggal">Tanggal</label>
                    <input type="datetime" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $pk->tanggal) }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="table-responsive mb-4">
                    <table id="tablemultiple" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="min-width: 200px; background-color:rgb(222, 222, 222)">Nama Item</th>
                                <th class="text-center" style="min-width: 100px; background-color:rgb(222, 222, 222)">Qty</th>
                                <th class="text-center" style="min-width: 200px; background-color:rgb(222, 222, 222)">Harga</th>
                                <th class="text-center" style="min-width: 200px; background-color:rgb(222, 222, 222)">Total</th>
                                <th class="text-center" style=" background-color:rgb(222, 222, 222)">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $old = session()->getOldInput();
                            @endphp
                            @if(isset($old['nama']))
                                @foreach ($old['nama'] as $key => $detailName)
                                    <tr id="multiple{{ $key }}">
                                        <td>
                                            <input type="text" class="nama" id="nama" name="nama[]" value="{{ old('nama')[$key] }}">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" class="qty" id="qty" name="qty[]" value="{{ old('qty')[$key] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="money harga" id="harga" name="harga[]" value="{{ old('harga')[$key] }}">
                                        </td>
                                        <td>
                                            <input type="text" class="money total" id="total" name="total[]" value="{{ old('total')[$key] }}" readonly>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($pk->items as $key => $item)
                                    <tr id="multiple{{ $key }}">
                                        <td>
                                            <input type="text" class="nama" id="nama" name="nama[]" value="{{ $item->nama }}">
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" class="qty" id="qty" name="qty[]" value="{{ $item->qty }}">
                                        </td>
                                        <td>
                                            <input type="text" class="money harga" id="harga" name="harga[]" value="{{ $item->harga }}">
                                        </td>
                                        <td>
                                            <input type="text" class="money total" id="total" name="total[]" value="{{ $item->total }}" readonly>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <a id="add_row" class="btn btn-sm btn-success float-start mb-2">+ Tambah</a>
                </div>

                <div class="group-input">
                    <label for="total_harga">Total Pengajuan</label>
                    <input type="text" class="money @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" value="{{ old('total_harga', $pk->total_harga) }}" readonly>
                    @error('total_harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="group-input">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="@error('keterangan') is-invalid @enderror">{{ old('keterangan', $pk->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="group-input">
                    <input type="file" class="form-control @error('pk_file_path') is-invalid @enderror" id="pk_file_path" name="pk_file_path" value="{{ old('pk_file_path') }}">
                    @error('pk_file_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
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

            let row_number = 1;
            let temp_row_number = row_number-1;
            $("#add_row").click(function(e) {
                e.preventDefault();
                let new_row_number = row_number - 1;
                let table = document.getElementById("tablemultiple");
                let tbodyRowCount = table.tBodies[0].rows.length;
                new_row = $('#tablemultiple tbody tr:last').clone();
                new_row.find("input").val("").end();
                $('#tablemultiple').append(new_row);
                $('#tablemultiple tbody tr:last').attr('id','multiple'+(tbodyRowCount));
                row_number++;
                temp_row_number = row_number - 1;
            });

            $('body').on('keyup click', '.qty', function (event) {
                let qty =  $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat($(this).closest('tr').find('td:eq(1) input').val()) : 0;
                let harga =  $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                let total = qty * harga;
                $(this).closest('tr').find('td:eq(3) input').val(accounting.formatMoney(total, '', 0, ",", "."))

                let total_harga = 0;
                $('.total').each(function () {
                    let qty_loop =  $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat($(this).closest('tr').find('td:eq(1) input').val()) : 0;
                    let harga_loop =  $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                    let total_loop = qty_loop * harga_loop;
                    total_harga += total_loop;
                });
                $('#total_harga').val(accounting.formatMoney(total_harga, '', 0, ",", "."));
            });

            $('body').on('keyup click', '.harga', function (event) {
                let qty =  $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat($(this).closest('tr').find('td:eq(1) input').val()) : 0;
                let harga =  $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                let total = qty * harga;
                $(this).closest('tr').find('td:eq(3) input').val(accounting.formatMoney(total, '', 0, ",", "."))

                let total_harga = 0;
                $('.total').each(function () {
                    let qty_loop =  $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat($(this).closest('tr').find('td:eq(1) input').val()) : 0;
                    let harga_loop =  $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                    let total_loop = qty_loop * harga_loop;
                    total_harga += total_loop;
                });
                $('#total_harga').val(accounting.formatMoney(total_harga, '', 0, ",", "."));
            });

            $('body').on('click', '.delete', function (event) {
                var table = document.getElementById("tablemultiple");
                var tbodyRowCount = table.tBodies[0].rows.length;
                if (tbodyRowCount <= 1) {
                    alert('Cannot delete if only 1 row!');
                } else {
                    if (confirm('Are you sure you want to delete?')) {
                        $(this).closest('tr').remove();
                        let total_harga = 0;
                        $('.total').each(function () {
                            let qty_loop =  $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat($(this).closest('tr').find('td:eq(1) input').val()) : 0;
                            let harga_loop =  $(this).closest('tr').find('td:eq(2) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(2) input').val())) : 0;
                            let total_loop = qty_loop * harga_loop;
                            total_harga += total_loop;
                        });
                        $('#total_harga').val(accounting.formatMoney(total_harga, '', 0, ",", "."));
                    }
                }
            });


        </script>
    @endpush
@endsection
