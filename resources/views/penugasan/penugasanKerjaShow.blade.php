
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

    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
</head>

<body class="bg_surface_color">
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
        <div class="bill-payment-content">
            <div class="tf-container">

                <div class="wrapper-bill">
                    <div class="archive-bottom ">
                        <h2 class="text-center">{{ $penugasan->nomor_penugasan }}</h2>
                        <ul>
                            <li class="list-info-bill">
                                Tanggal
                                <span>
                                    @if ($penugasan->tanggal)
                                        @php
                                            Carbon\Carbon::setLocale('id');
                                            $tanggal = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $penugasan->created_at);
                                            $new_tanggal = $tanggal->translatedFormat('d F Y H:i');
                                        @endphp
                                        {{ $new_tanggal  }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </li>
                            <li class="list-info-bill">Nama Pegawai <span>{{ $penugasan->user->name ?? '-' }}</span> </li>
                            <li class="list-info-bill">
                                Status
                                <span class="text-end">
                                    @if ($penugasan->status == 'PENDING')
                                        <div class="float-end badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $penugasan->status ?? '-' }}</div>
                                    @elseif($penugasan->status == 'PROCESS')
                                        <div class="float-end badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $penugasan->status ?? '-' }}</div>
                                    @else
                                        <div class="float-end badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $penugasan->status ?? '-' }}</div>
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="line"></div>
                    <div class="archive-bottom mb-4">
                        <ul>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                {{ $penugasan->judul }}
                            </li>
                            <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                {!! $penugasan->rincian ? nl2br(e($penugasan->rincian)) : '-' !!}
                            </li>
                        </ul>
                    </div>
                    <div class="archive-bottom app-wrap">
                        <div class="bill-content">
                            <div class="tf-container">
                                <ul>
                                    @foreach ($penugasan->items as $item)
                                        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
                                            <div class="user-info">
                                                @if ($item->user)
                                                    @if($item->user->foto_karyawan)
                                                        <img src="{{ url('/storage/'.$item->user->foto_karyawan) }}" alt="image">
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
                                                        {{ $item->user->name ?? '-' }}
                                                        @if ($item->flow == 'PENDING')
                                                            <div class="float-end badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $item->flow ?? '-' }}</div>
                                                        @elseif($item->flow == 'PROCESS')
                                                            <div class="float-end badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $item->flow ?? '-' }}</div>
                                                        @else
                                                            <div class="float-end badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $item->flow ?? '-' }}</div>
                                                        @endif
                                                    </a>
                                                </h4>
                                                <p style="color: rgb(173, 173, 173); font-size:10px;">
                                                    @if ($item->created_at)
                                                        @php
                                                            Carbon\Carbon::setLocale('id');
                                                            $created_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                                                            $new_created_at = $created_at->translatedFormat('l, d F Y H:i:s');
                                                        @endphp
                                                        {{ $new_created_at  }}
                                                    @else
                                                        -
                                                    @endif
                                                </p>
                                                <p style="color: rgb(173, 173, 173); font-size:10px;">
                                                    @if ($item->flow == 'PENDING')
                                                        Tugas {{ $penugasan->nomor_penugasan }} ditugaskan kepada {{ $penugasan->user->name ?? '-' }} oleh {{ $item->user->name ?? '-' }}
                                                    @elseif($item->flow == 'PROCESS')
                                                        Tugas {{ $penugasan->nomor_penugasan }} diproses oleh {{ $item->user->name ?? '-' }}
                                                    @else
                                                        Tugas {{ $penugasan->nomor_penugasan }} diselesaikan oleh {{ $item->user->name ?? '-' }}
                                                    @endif
                                                </p>
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
            @if ($penugasan->status == 'PENDING')
                <a href="{{ url('/penugasan-kerja/process/'.$penugasan->id) }}" class="tf-btn accent large" onclick="return confirm('Ingin Proses Pekerjaan Ini?')">Proses Pekerjaan</a>
            @elseif ($penugasan->status == 'PROCESS')
                <a href="{{ url('/penugasan-kerja/finish/'.$penugasan->id) }}" class="tf-btn accent large" onclick="return confirm('Ingin Selesaikan Pekerjaan Ini?')">Selesaikan Pekerjaan</a>
            @else
                <a href="{{ url('/penugasan-kerja') }}" class="tf-btn accent large">Back</a>
            @endif
        </div>
    </div>













    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
    @include('sweetalert::alert')

</body>

</html>
