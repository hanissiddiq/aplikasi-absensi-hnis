
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

    <div id="app-wrap">
        <div class="bill-content">
            <div class="tf-container">
                <ul class="mt-3 mb-5">
                    @foreach ($rapats as $rapat)
                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                            <div class="content-right">
                                <h4><a href="{{ url('/rapat-kerja/show/'.$rapat->id) }}">{{ $rapat->nama ?? '-' }} <span>{{ $rapat->jam_mulai }} s/d {{ $rapat->jam_selesai }}</span></a></h4>
                                <p>
                                    @if ($rapat->tanggal)
                                        @php
                                            Carbon\Carbon::setLocale('id');
                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $rapat->tanggal);
                                            $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                        @endphp
                                        {{ $new_tanggal  }}
                                    @else
                                        -
                                    @endif
                                </p>
                                <p>{{ $rapat->jenis }}</p>
                            </div>
                        </li>
                    @endforeach
                    <div class="d-flex justify-content-end me-4 mt-4">
                        {{ $rapats->links() }}
                    </div>
                </ul>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>

    @include('sweetalert::alert')
</body>

</html>
