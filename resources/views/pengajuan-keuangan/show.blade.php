@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">
                <div class="bill-content mt-4">
                    <div class="tf-container ">
                        <ul>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Nomor Pengajuan Keuangan
                                    </p>
                                    <h5>
                                        {{ $pk->nomor ?? '-' }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Nama Pegawai
                                    </p>
                                    <h5>
                                        {{ $pk->user->name ?? '-' }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Tanggal
                                    </p>
                                    <h5>
                                        @if ($pk->tanggal)
                                            @php
                                                Carbon\Carbon::setLocale('id');
                                                $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pk->tanggal);
                                                $new_tanggal = $tanggal->translatedFormat('d F Y');
                                            @endphp
                                            {{ $new_tanggal  }}
                                        @else
                                            -
                                        @endif
                                    </h5>
                                </div>
                            </li>


                            @foreach ($pk->items as $item)
                                <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                    <div class="content-right">
                                        <p>
                                            <div class="row">
                                                <div class="col-4" style="color: black; font-weight:bold;">
                                                    {{ $loop->iteration }}. Nama Barang
                                                </div>
                                                <div class="col-1" style="color: black; font-weight:bold;">
                                                    :
                                                </div>
                                                <div class="col-7" style="color: black; font-weight:bold;">
                                                    {{ $item->nama }}
                                                </div>
                                            </div>
                                        </p>
                                        <p>
                                            <div class="row">
                                                <div class="col-4" style="color: black; font-weight:bold;">
                                                    <span class="ms-3">Qty</span>
                                                </div>
                                                <div class="col-1" style="color: black; font-weight:bold;">
                                                    :
                                                </div>
                                                <div class="col-7" style="color: black; font-weight:bold;">
                                                    {{ $item->qty }}
                                                </div>
                                            </div>
                                        </p>
                                        <p>
                                            <div class="row">
                                                <div class="col-4" style="color: black; font-weight:bold;">
                                                    <span class="ms-3">Harga</span>
                                                </div>
                                                <div class="col-1" style="color: black; font-weight:bold;">
                                                    :
                                                </div>
                                                <div class="col-7" style="color: black; font-weight:bold;">
                                                    Rp {{ number_format($item->harga) }}
                                                </div>
                                            </div>
                                        </p>
                                        <p>
                                            <div class="row">
                                                <div class="col-4" style="color: black; font-weight:bold;">
                                                    <span class="ms-3">Total</span>
                                                </div>
                                                <div class="col-1" style="color: black; font-weight:bold;">
                                                    :
                                                </div>
                                                <div class="col-7" style="color: black; font-weight:bold;">
                                                    Rp {{ number_format($item->total) }}
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </li>
                            @endforeach

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Total Pengajuan
                                    </p>
                                    <h5>
                                        Rp {{ number_format($pk->total_harga) }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Keterangan
                                    </p>
                                    <h5>
                                        {!! $pk->keterangan ? nl2br(e($pk->keterangan)) : '-' !!}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    File
                                    </p>
                                    <h5>
                                        @if ($pk->pk_file_path)
                                            <a target="_blank" href="{{ url('/storage/'.$pk->pk_file_path) }}"><span style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;" class="badge"><i class="fa fa-download me-2"></i>{{ $pk->pk_file_name }}</span></a>
                                        @else
                                            -
                                        @endif
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Status
                                    </p>
                                    <h5>
                                        @if ($pk->status == 'REJECTED')
                                            <div class="badge" style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                        @elseif($pk->status == 'APPROVED')
                                            <div class="badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                        @elseif($pk->status == 'PENDING')
                                            <div class="badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                        @elseif($pk->status == 'ON GOING')
                                            <div class="badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                        @else
                                            <div class="badge" style="color: rgb(45, 45, 45); background-color:rgba(207, 207, 207, 0.889); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                        @endif
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    User Approval
                                    </p>
                                    <h5>
                                        {{ $pk->ua->name ?? '-' }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                    Nota
                                    </p>
                                    <h5>
                                        @if ($pk->nota_file_path)
                                            <a target="_blank" href="{{ url('/storage/'.$pk->nota_file_path) }}"><span style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;" class="badge"><i class="fa fa-download me-2"></i>{{ $pk->nota_file_name }}</span></a>
                                        @else
                                            -
                                        @endif
                                    </h5>
                                </div>
                            </li>

                            @if ($pk->status == 'PENDING')
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ url('/pengajuan-keuangan/edit/'.$pk->id) }}" class="tf-btn accent large">Edit</a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ url('/pengajuan-keuangan/delete/'.$pk->id) }}" onclick="return confirm('are you sure?')" class="tf-btn accent large" style="background-color: red">Delete</a>
                                    </div>
                                </div>
                            @endif

                            @if ($pk->status == 'APPROVED')
                                <a href="{{ url('/pengajuan-keuangan/accept/'.$pk->id) }}" onclick="return confirm('are you sure?')" class="tf-btn accent large" style="background-color: green">Terima Uang</a>
                            @endif

                            @if ($pk->status == 'ON GOING')
                                <a href="#" id="btn-popup-down" class="tf-btn accent large">Upload Nota</a>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-panel down">
        <div class="panel_overlay"></div>
        <div class="panel-box panel-down">
            <div class="header">
                <div class="tf-container">
                    <div class="tf-statusbar d-flex justify-content-center align-items-center">
                        <a href="#" class="clear-panel"> <i class="icon-close1"></i> </a>
                        <h3>Upload Nota</h3>
                    </div>

                </div>
            </div>

            <div class="mt-5">
                <div class="tf-container">
                    <form class="tf-form-verify" action="{{ url('/pengajuan-keuangan/nota/'.$pk->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <input type="file" class="form-control @error('nota_file_path') is-invalid @enderror" name="nota_file_path" value="{{ old('nota_file_path') }}" />
                            @error('nota_file_path')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-7 mb-6">
                            <button type="submit" class="tf-btn accent">Submit</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection
