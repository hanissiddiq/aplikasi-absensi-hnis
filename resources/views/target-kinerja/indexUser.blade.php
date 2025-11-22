
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

                <div class="bill-content mt-3">
                    <form action="{{ url('/target-kinerja') }}">
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

                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item-1 app-wrap" class="app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mb-5">
                                    @foreach ($target_kinerjas as $tk)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="content-right">
                                                <h4><a href="{{ url('/target-kinerja/list/'.$tk->id) }}">{{ $tk->nomor ?? '-' }}<span class="primary_color">Lihat</span></a></h4>
                                                <p>Target team : Rp {{ number_format($tk->target_team) }}</p>
                                                <p>Tanggal : {{ $tk->tanggal_awal }} s/d {{ $tk->tanggal_akhir }}</p>
                                                @foreach ($tk->team as $team)
                                                    <div class="badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $team->user->name ?? '-' }}</div>
                                                @endforeach

                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="d-flex justify-content-end me-4 mt-4">
                                        {{ $target_kinerjas->links() }}
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
