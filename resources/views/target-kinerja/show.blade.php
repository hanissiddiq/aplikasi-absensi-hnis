
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
                <div class="bill-content mt-4">
                    <div class="tf-container ">
                        <ul>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Judul
                                    </p>
                                    <h5>
                                        {{ $target_kinerja_team->judul ?? '-' }}
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Jumlah
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->jumlah) }}
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                        Target Pribadi
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->target_pribadi) }}
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Sisa Target Pribadi
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->target_pribadi - $target_kinerja_team->jumlah) }}
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                        <div class="row">
                                            <div class="col-7">
                                                Capai %
                                            </div>
                                            <div class="col-5">
                                                Nilai
                                            </div>
                                        </div>
                                    </p>
                                    <h5>
                                        <div class="row">
                                            <div class="col-7">
                                                {{ $target_kinerja_team->capai ? $target_kinerja_team->capai . ' %' : '-' }}
                                            </div>
                                            <div class="col-5">
                                                {{ $target_kinerja_team->nilai ?? '-' }}
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Target Team
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->target->target_team) }}
                                    </h5>
                                </div>
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Sisa Target Team
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->target->target_team - $sum_jumlah) }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                        <div class="row">
                                            <div class="col-7">
                                                Bonus Pribadi
                                            </div>
                                            <div class="col-5">
                                                Bonus Team
                                            </div>
                                        </div>
                                    </p>
                                    <h5>
                                        <div class="row">
                                            <div class="col-7">
                                                Rp {{ number_format($target_kinerja_team->bonus_p) }}
                                            </div>
                                            <div class="col-5">
                                                Rp {{ number_format($target_kinerja_team->bonus_t) }}
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Bonus Jackpot
                                    </p>
                                    <h5>
                                        Rp {{ number_format($target_kinerja_team->bonus_j) }}
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                        <div class="row">
                                            <div class="col-7">
                                                Tanggal Awal
                                            </div>
                                            <div class="col-5">
                                                Tanggal Akhir
                                            </div>
                                        </div>
                                    </p>
                                    <h5>
                                        <div class="row">
                                            <div class="col-7">
                                                {{ $target_kinerja->tanggal_awal }}
                                            </div>
                                            <div class="col-5">
                                                {{ $target_kinerja->tanggal_akhir }}
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </li>

                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                <div class="content-right">
                                    <p>
                                       Keterangan
                                    </p>
                                    <h5>
                                        {!! $target_kinerja_team->keterangan ? nl2br(e($target_kinerja_team->keterangan)) : '-' !!}
                                    </h5>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-navigation-bar st1 bottom-btn-fixed">
        <div class="tf-container">
            @if ($target_kinerja_team->user_id == auth()->user()->id)
                <a href="{{ url('/target-kinerja/edit-user/'.$target_kinerja_team->id.'/'.$target_kinerja->id) }}" class="tf-btn accent large">Edit</a>
            @endif
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
