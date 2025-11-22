
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>{{ $title }}</title>
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('/myhr/images/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('/myhr/images/logo.png') }}" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('/myhr/styles/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">

    <style>
        .hidden {
            display: none;
        }
        .content-tab .active-content {
            display: block;
        }
    </style>
</head>

<body>
       <!-- preloade -->
       <div class="preload preload-container">
        <div class="preload-logo">
          <div class="spinner"></div>
        </div>
      </div>
    <!-- /preload -->
    <div class="header is-fixed">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>{{ $title }}</h3>
            </div>
        </div>
    </div>
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="tf-tab">
                <ul class="menu-tabs tabs-food-new">
                    <li class="nav-tab {{ $active_tab == 'detail' ? 'active' : '' }}">Detail</li>
                    <li class="nav-tab {{ $active_tab == 'hadir' ? 'active' : '' }}">Peserta</li>
                    <li class="nav-tab {{ $active_tab == 'notulen' ? 'active' : '' }}">Notulen</li>
                </ul>
                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item-1 app-wrap" class="app-wrap {{ $active_tab == 'detail' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                               Mulai Acara
                                            </p>
                                            <h5>
                                                @if ($rapat->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $rapat->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                                    @endphp
                                                @else
                                                    @php
                                                        $new_tanggal = '-';
                                                    @endphp
                                                @endif
                                                {{ $new_tanggal }} {{ $rapat->jam_mulai }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                               Selesai Acara
                                            </p>
                                            <h5>
                                                {{ $new_tanggal }} {{ $rapat->jam_selesai }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                               Jenis Pertemuan
                                            </p>
                                            <h5>
                                                {{ $rapat->jenis }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                               Lokasi Pertemuan
                                            </p>
                                            <h5>
                                                {{ $rapat->lokasi }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                                Jumlah Peserta
                                            </p>
                                            <h5>
                                                {{ count($rapat->pegawai) }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                                Peserta Hadir
                                            </p>
                                            <h5>
                                                {{ count($rapat->pegawai->where('status', 'Hadir')) }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                                Peserta Tidak Hadir
                                            </p>
                                            <h5>
                                                {{ count($rapat->pegawai->where('status', 'Tidak Hadir')) }}
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <p>
                                                Detail Pertemuan
                                            </p>
                                            <h5>
                                                {!! $rapat->detail ? nl2br(e($rapat->detail)) : '-' !!}
                                            </h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="tab-gift-item-2 app-wrap" class="app-wrap {{ $active_tab == 'hadir' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul>
                                    @foreach ($rapat->pegawai as $pegawai)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                @if ($pegawai->user)
                                                    @if($pegawai->user->foto_karyawan)
                                                        <img src="{{ url('/storage/'.$pegawai->user->foto_karyawan) }}" alt="image">
                                                    @else
                                                        <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="content-right">
                                                <h4>
                                                    <a href="#">
                                                        {{ $pegawai->user->name ?? '-' }}
                                                        @if ($pegawai->status == 'Hadir')
                                                            <div class="float-end badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pegawai->status ?? '-' }}</div>
                                                        @else
                                                            <div class="float-end badge" style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pegawai->status ?? '-' }}</div>
                                                        @endif
                                                    </a>
                                                </h4>
                                                <p style="color: rgb(173, 173, 173); font-size:10px;">
                                                    @if ($pegawai->hadir)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $hadir = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pegawai->hadir);
                                                            $new_hadir = $hadir->translatedFormat('l, d F Y H:i:s');
                                                        @endphp
                                                        {{ $new_hadir  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="tab-gift-item-3 app-wrap" class="app-wrap {{ $active_tab == 'notulen' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($rapat->notulen as $notulen)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                <span class="badge" style="border-radius:15px; background-color:blue">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="content-right">
                                                <h4>
                                                    {{ $notulen->notulen }}
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="bottom-navigation-bar st1 bottom-btn-fixed">
        <div class="tf-container">
            <div class="row">
                @if ($mypegawai->status == 'Tidak Hadir')
                    <div class="col">
                        <a href="{{ url('/rapat-kerja/hadir/'.$rapat->id) }}" class="tf-btn accent large" onclick="return confirm('Anda Sudah Di Lokasi Rapat?')">Hadir</a>
                    </div>
                @endif
                <div class="col">
                    <a href="#" id="btn-popup-down" class="tf-btn success large">Notulen</a>
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
                        <h3>Notulen</h3>
                    </div>

                </div>
            </div>

            <div class="mt-5">
                <div class="tf-container">
                    <form class="tf-form-verify" action="{{ url('/rapat-kerja/notulen/'.$rapat->id) }}" method="POST">
                        @csrf
                        <div class="group-input">
                            <input type="text" class="@error('notulen') is-invalid @enderror" name="notulen" value="{{ old('notulen') }}" />
                            @error('notulen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-7 mb-6">
                            <button type="submit" class="tf-btn success">Submit</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.menu-tabs .nav-tab').click(function () {
                $('.menu-tabs .nav-tab').removeClass('active');
                $('.content-tab > div').removeClass('active-content').addClass('hidden');

                $(this).addClass('active');

                let tabIndex = $(this).index();

                $('.content-tab > div').eq(tabIndex).removeClass('hidden').addClass('active-content');
            });

            $('.menu-tabs .nav-tab.active').trigger('click');
        });
    </script>

    @include('sweetalert::alert')
</body>

</html>
