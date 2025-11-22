@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/reimbursement/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <label for="pegawai">Nama Pegawai</label>
                            <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', auth()->user()->name) }}" readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="event">event</label>
                            <textarea name="event" id="event" class="@error('event') is-invalid @enderror">{{ old('event') }}</textarea>
                            @error('event')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="kategori_id" style="z-index: 1000">Kategori</label>
                            <select class="select2 @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" data-live-search="true">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                    @if(old('kategori_id') == $kat->id)
                                        <option value="{{ $kat->id }}" selected>{{ $kat->name }}</option>
                                    @else
                                        <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="money @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="qty">Qty</label>
                            <input type="number" class="@error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}">
                            @error('qty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="total">Total</label>
                            <input type="text" readonly class="money @error('total') is-invalid @enderror" id="total" name="total" value="{{ old('total') }}">
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="table-responsive mb-4">
                            <table id="tablemultiple" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Fee</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $old = session()->getOldInput();
                                    @endphp
                                    @if(isset($old['user_id_item']))
                                        @foreach ($old['user_id_item'] as $key => $detailName)
                                            <tr id="multiple{{ $key }}">
                                                <td>
                                                    <select style="width: 130px" class="user_id_item" name="user_id_item[]">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($user as $us)
                                                            @if(old('user_id_item')[$key] == $us->id)
                                                                <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                                            @else
                                                                <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="money fee" id="fee" name="fee[]" value="{{ old('fee')[$key] }}">
                                                    @error('fee')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="multiple0">
                                            <td>
                                                <select style="width: 130px" class="user_id_item" name="user_id_item[]">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($user as $us)
                                                        <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="money fee" id="fee" name="fee[]">
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <a id="add_row" class="btn btn-sm btn-success float-end">+ Tambah</a>
                        </div>

                        <div class="group-input">
                            <label for="sisa">Sisa</label>
                            <input type="text" readonly class="money @error('sisa') is-invalid @enderror" id="sisa" name="sisa" value="{{ old('sisa') }}">
                            @error('sisa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="status">status</label>
                            <input type="text" class="@error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', 'Pending') }}">
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <input type="file" class="form-control @error('file_path') is-invalid @enderror" id="file_path" name="file_path" value="{{ old('file_path') }}">
                            @error('file_path')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input type="hidden" name="kategori_name" id="kategori_name" value="{{ old('kategori_name') }}">

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
            $(document).ready(function(){
                $('.money').mask('000,000,000,000,000', {
                    reverse: true
                });

                $('#kategori_id').select2();
                $('.user_id_item').select2();

                var row_number = 1;
                var temp_row_number = row_number-1;
                $("#add_row").click(function(e) {
                    e.preventDefault();
                    var new_row_number = row_number - 1;
                    var table = document.getElementById("tablemultiple");
                    var tbodyRowCount = table.tBodies[0].rows.length;
                    $(".user_id_item").select2('destroy');
                    new_row = $('#tablemultiple tbody tr:last').clone();
                    new_row.find("input").val("").end();
                    new_row.find("select").val("").end();
                    $('#tablemultiple').append(new_row);
                    $('#tablemultiple tbody tr:last').attr('id','multiple'+(tbodyRowCount));
                    row_number++;
                    $('.user_id_item').select2();
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
                            let total = $('#total').val() ? parseFloat(replaceCurrency($('#total').val())) : 0;
                            let sum_fee = 0;
                            $('.fee').each(function () {
                                sum_fee += $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(1) input').val())) : 0;
                            });
                            $('#sisa').val(accounting.formatMoney(total - sum_fee, '', 0, ",", "."));
                        }
                    }
                });

                $('body').on('keyup click', '.fee', function (event) {
                    let total = $('#total').val() ? parseFloat(replaceCurrency($('#total').val())) : 0;
                    let sum_fee = 0;
                    $('.fee').each(function () {
                        sum_fee += $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(1) input').val())) : 0;
                    });
                    $('#sisa').val(accounting.formatMoney(total - sum_fee, '', 0, ",", "."));
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let kategori_name = $('#kategori_name').val();
                if (kategori_name == 'Lain-lain') {
                    $("#jumlah").prop('readonly', false);
                } else {
                    $("#jumlah").prop('readonly', true);
                }


                $('#kategori_id').on('change', function(){
                    let kategori_id = $('#kategori_id').val();
                    $.ajax({
                        type : 'POST',
                        url : "{{ url('/reimbursement/getKategori') }}",
                        data :  {kategori_id:kategori_id},
                        cache : false,
                        success: function(data){
                            $('#kategori_name').val(data.name);
                            let qty = $('#qty').val() ? parseFloat($('#qty').val()) : 0;
                            let sum_fee = 0;
                            $('.fee').each(function () {
                                sum_fee += $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(1) input').val())) : 0;
                            });
                            if (data.name == 'Lain-lain') {
                                $('#jumlah').val(accounting.formatMoney(0, '', 0, ",", "."));
                                $('#total').val(accounting.formatMoney(0, '', 0, ",", "."));
                                $('#sisa').val(accounting.formatMoney(0, '', 0, ",", "."));
                                $("#jumlah").prop('readonly', false);
                            } else {
                                let total = parseFloat(data.jumlah) * qty;
                                let sisa = total - sum_fee;
                                $('#jumlah').val(accounting.formatMoney(data.jumlah, '', 0, ",", "."));
                                $('#total').val(accounting.formatMoney(total, '', 0, ",", "."));
                                $("#jumlah").prop('readonly', true);
                                $('#sisa').val(accounting.formatMoney(sisa, '', 0, ",", "."));
                            }
                        },
                        error: function(data){
                            console.log('error:' ,data);
                        }
                    })
                })

                $('#jumlah').on('keyup', function(){
                    let jumlah = $('#jumlah').val() ? parseFloat(replaceCurrency($('#jumlah').val())) : 0;
                    let qty = $('#qty').val() ? parseFloat($('#qty').val()) : 0;
                    let total = jumlah * qty;
                    $('#total').val(accounting.formatMoney(total, '', 0, ",", "."));

                    let sum_fee = 0;
                    $('.fee').each(function () {
                        sum_fee += $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(1) input').val())) : 0;
                    });
                    let sisa = total - sum_fee;
                    $('#sisa').val(accounting.formatMoney(sisa, '', 0, ",", "."));
                })

                $('#qty').on('keyup change', function(){
                    let jumlah = $('#jumlah').val() ? parseFloat(replaceCurrency($('#jumlah').val())) : 0;
                    let qty = $('#qty').val() ? parseFloat($('#qty').val()) : 0;
                    let total = jumlah * qty;
                    $('#total').val(accounting.formatMoney(total, '', 0, ",", "."));

                    let sum_fee = 0;
                    $('.fee').each(function () {
                        sum_fee += $(this).closest('tr').find('td:eq(1) input').val() ?  parseFloat(replaceCurrency($(this).closest('tr').find('td:eq(1) input').val())) : 0;
                    });
                    let sisa = total - sum_fee;
                    $('#sisa').val(accounting.formatMoney(sisa, '', 0, ",", "."));
                })
            });
        </script>
    @endpush
@endsection
