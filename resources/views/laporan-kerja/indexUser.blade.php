@extends('templates.app')
@section('container')
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="bill-content mt-3">
                <form action="{{ url('/laporan-kerja') }}">
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

            <a href="{{ url('/laporan-kerja/tambah') }}" class="btn btn-sm btn-primary mt-5" style="border-radius: 10px">+ Tambah</a>

            <div class="bill-content mt-4">
                <div class="tf-container">
                    <ul class="mb-5">
                        @foreach ($laporan_kerjas as $laporan_kerja)
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <h4><a href="{{ url('/laporan-kerja/show/'.$laporan_kerja->id) }}">Laporan<span class="">{{ $laporan_kerja->tanggal }}</span></a></h4>
                                    <p>{!! $laporan_kerja->informasi_umum ? nl2br(e($laporan_kerja->informasi_umum)) : '-' !!}</p>
                                </div>
                            </li>
                        @endforeach
                        <div class="d-flex justify-content-end me-4 mt-4">
                            {{ $laporan_kerjas->links() }}
                        </div>
                    </ul>
                </div>
            </div>


        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection

