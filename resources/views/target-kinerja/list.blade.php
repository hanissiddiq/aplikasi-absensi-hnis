
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
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
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


                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item-1 app-wrap" class="app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mb-5">
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <h5><div class="float-start">Periode</div> <div class="float-end">{{ $target_kinerja->tanggal_awal }} s/d {{ $target_kinerja->tanggal_akhir }}</div></h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <h5><div class="float-start">Target Team</div> <div class="float-end">Rp {{ number_format($target_kinerja->target_team) }}</div></h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <h5><div class="float-start">Total Penjualan</div> <div class="float-end">Rp {{ number_format($sum_jumlah) }}</div></h5>
                                        </div>
                                    </li>
                                    <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                        <div class="content-right">
                                            <h5><div class="float-start">Sisa Target Team</div> <div class="float-end">Rp {{ number_format($target_kinerja->target_team - $sum_jumlah) }}</div></h5>
                                        </div>
                                    </li>
                                    <br>
                                    @foreach ($target_kinerja_team as $tkt)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="content-right">
                                                <h4><a href="{{ url('/target-kinerja/show/'.$tkt->id.'/'.$target_kinerja->id) }}">{{ $tkt->user->name ?? '-' }}<span class="primary_color">Lihat</span></a></h4>
                                                <p>Target Pribadi : Rp {{ number_format($tkt->target_pribadi) }}</p>
                                                <p>Jumlah Penjualan: Rp {{ number_format($tkt->jumlah) }}</p>
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
