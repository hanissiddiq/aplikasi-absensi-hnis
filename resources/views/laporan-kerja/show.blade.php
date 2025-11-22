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
                                    <h5>
                                        Informasi Umum
                                    </h5>
                                    <p>
                                        {!! $laporan_kerja->informasi_umum ? nl2br(e($laporan_kerja->informasi_umum)) : '-' !!}
                                    </p>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <h5>
                                        Pekerjaan Yang Dilaksanakan
                                    </h5>
                                    <p>
                                        {!! $laporan_kerja->pekerjaan_dilaksanakan ? nl2br(e($laporan_kerja->pekerjaan_dilaksanakan)) : '-' !!}
                                    </p>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <h5>
                                        Pekerjaan Yang Belum Selesai
                                    </h5>
                                    <p>
                                        {!! $laporan_kerja->pekerjaan_belum_selesai ? nl2br(e($laporan_kerja->pekerjaan_belum_selesai)) : '-' !!}
                                    </p>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <h5>
                                        Catatan
                                    </h5>
                                    <p>
                                        {!! $laporan_kerja->catatan ? nl2br(e($laporan_kerja->catatan)) : '-' !!}
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar st1 bottom-btn-fixed" style="padding: 80px; background-color:white">
        <div class="tf-container">
            <div class="row">
                <div class="col">
                    <a href="{{ url('/laporan-kerja/edit/'.$laporan_kerja->id) }}" class="tf-btn accent large">Edit</a>
                </div>
                <div class="col">
                    <form action="{{ url('/laporan-kerja/delete/'.$laporan_kerja->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="tf-btn btn-danger large"  onClick="return confirm('Are You Sure')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

