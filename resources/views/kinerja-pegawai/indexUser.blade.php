
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
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            <div class="repicient-content mt-8">
                <div class="tf-container">
                 <div class="box-user mt-5 text-center">
                     <div class="box-avatar">
                         @if(auth()->user()->foto_karyawan == null)
                             <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image">
                         @else
                             <img src="{{ url('/storage/'.auth()->user()->foto_karyawan) }}" alt="image">
                         @endif
                     </div>
                     <h3 class="fw_8 mt-3">{{ strtoupper(auth()->user()->name) }}</h3>
                     <h4 style="color: rgb(196, 196, 101)">SKOR : {{ $skor_akhir->penilaian_berjalan ?? 0 }}</h4>
                 </div>
                </div>
            </div>
            <div class="tf-tab">
                <ul class="menu-tabs tabs-food">
                    <li class="nav-tab active">List Penilaian</li>
                    <li class="nav-tab">Data Penilaian</li>
                </ul>
                <div class="content-tab pt-tab-space mb-5">
                    <div id="tab-gift-item app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($list_penilaian as $lp)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="content-right">
                                                <h4><a href="#">{{ $lp->jenis->nama ?? '-' }} <span class="btn btn-{{ $lp->nilai <= 0 ? 'danger' : 'primary' }}">{{ $lp->nilai ?? '-' }}</span></a></h4>
                                                <p>
                                                    @if ($lp->tanggal)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $lp->tanggal);
                                                            $new_tanggal = $tanggal->translatedFormat('l, d F Y');
                                                        @endphp
                                                        {{ $new_tanggal  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                    <div class="d-flex justify-content-end me-4 mt-4">
                                        {{ $list_penilaian->links() }}
                                    </div>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div id="tab-gift-item-2 app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul class="mt-3 mb-5">
                                    @foreach ($data_penilaian as $dp)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="content-right">
                                                <h4><a href="#">{{ $dp->nama ?? '-' }} <span class="btn btn-{{ $dp->total_penilaian <= 0 ? 'danger' : 'primary' }}">{{ $dp->total_penilaian ?? '-' }}</span></a></h4>
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

    @include('sweetalert::alert')
</body>

</html>
