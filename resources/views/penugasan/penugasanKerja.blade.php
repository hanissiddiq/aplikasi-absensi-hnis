
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
                    <li class="nav-tab {{ $active_tab == 'new' ? 'active' : '' }}">Pekerjaan Baru</li>
                    <li class="nav-tab {{ $active_tab == 'process' ? 'active' : '' }}">Dalam Proses</li>
                    <li class="nav-tab {{ $active_tab == 'finish' ? 'active' : '' }}">Pekerjaan Selesai</li>
                </ul>
                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item-1 app-wrap" class="app-wrap {{ $active_tab == 'new' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($penugasan_pending as $pending)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                @if ($pending->user)
                                                    @if($pending->user->foto_karyawan)
                                                        <img src="{{ url('/storage/'.$pending->user->foto_karyawan) }}" alt="image">
                                                    @else
                                                        <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="content-right">
                                                <h4><a href="{{ url('/penugasan-kerja/show/'.$pending->id) }}">{{ $pending->user->name ?? '-' }} <span class="primary_color">Lihat</span></a></h4>
                                                <p>
                                                    @if ($pending->tanggal)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pending->tanggal);
                                                            $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                                        @endphp
                                                        {{ $new_tanggal  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                                <p>{{ $pending->judul }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="d-flex justify-content-end me-4 mt-4">
                                        {{ $penugasan_pending->links() }}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="tab-gift-item-2 app-wrap" class="app-wrap {{ $active_tab == 'process' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($penugasan_process as $process)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                @if ($process->user)
                                                    @if($process->user->foto_karyawan)
                                                        <img src="{{ url('/storage/'.$process->user->foto_karyawan) }}" alt="image">
                                                    @else
                                                        <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="content-right">
                                                <h4><a href="{{ url('/penugasan-kerja/show/'.$process->id) }}">{{ $process->user->name ?? '-' }} <span class="primary_color">Lihat</span></a></h4>
                                                <p>
                                                    @if ($process->tanggal)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $process->tanggal);
                                                            $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                                        @endphp
                                                        {{ $new_tanggal  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                                <p>{{ $process->judul }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="d-flex justify-content-end me-4 mt-4">
                                        {{ $penugasan_process->links() }}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="tab-gift-item-3 app-wrap" class="app-wrap {{ $active_tab == 'finish' ? 'active-content' : 'hidden' }}">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($penugasan_finish as $finish)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                @if ($finish->user)
                                                    @if($finish->user->foto_karyawan)
                                                        <img src="{{ url('/storage/'.$finish->user->foto_karyawan) }}" alt="image">
                                                    @else
                                                        <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                    @endif
                                                @else
                                                    <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                                                @endif
                                            </div>
                                            <div class="content-right">
                                                <h4><a href="{{ url('/penugasan-kerja/show/'.$finish->id) }}">{{ $finish->user->name ?? '-' }} <span class="primary_color">Lihat</span></a></h4>
                                                <p>
                                                    @if ($finish->tanggal)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $finish->tanggal);
                                                            $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                                        @endphp
                                                        {{ $new_tanggal  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                                <p>{{ $finish->judul }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="d-flex justify-content-end me-4 mt-4">
                                        {{ $penugasan_finish->links() }}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>

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
