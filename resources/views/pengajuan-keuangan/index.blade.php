@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">



                <div class="bill-content mt-3">
                    <form action="{{ url('/pengajuan-keuangan') }}">
                        <div class="row">
                            <div class="col-10">
                                <div class="input-field">
                                    <span class="icon-search"></span>
                                    <input required class="search-field value_input" placeholder="Search" name="search" type="text" value="{{ request('search') }}">
                                    <span class="icon-clear"></span>
                                </div>
                            </div>
                            <div class="col-2">

                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <a href="{{ url('/pengajuan-keuangan/tambah') }}" class="tf-btn accent large mt-4">+ Tambah</a>

                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item-1 app-wrap" class="app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mb-5">
                                    @if (count($pengajuan_keuangans) > 0)
                                        @foreach ($pengajuan_keuangans as $pk)
                                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                                <div class="content-right">
                                                    <h4><a href="{{ url('/pengajuan-keuangan/show/'.$pk->id) }}">{{ $pk->nomor ?? '-' }}<span class="primary_color">Lihat</span></a></h4>
                                                    <p>Total : Rp {{ number_format($pk->total_harga) }}</p>
                                                    <p>
                                                        Tanggal :
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
                                                    </p>
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
                                                </div>
                                            </li>
                                        @endforeach
                                        <div class="d-flex justify-content-end me-4 mt-4">
                                            {{ $pengajuan_keuangans->links() }}
                                        </div>
                                    @else
                                        <center>
                                        <hr> No Data Available <hr>
                                        </center>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
