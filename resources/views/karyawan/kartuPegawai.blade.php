
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
    <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
    <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
    <style>
        .kartu {
            width: 300px;
            background-color: #e9e9e9;
            border-radius: 30px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .barcode {
            width: 100%;
            height: 200px;
            background-color: #000;
            border-radius: 30px;
            margin-bottom: 70px;
        }

        .member-name {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .membership-type {
            font-size: 18px;
            color: #666;
        }
    </style>
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
                        <center>
                            @php
                                $result = Endroid\QrCode\Builder\Builder::create()
                               ->writer(new Endroid\QrCode\Writer\PngWriter())
                               ->writerOptions([])
                               ->data(auth()->user()->username)
                               ->encoding(new Endroid\QrCode\Encoding\Encoding('UTF-8'))
                               ->errorCorrectionLevel(new Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh())
                               ->size(300)
                               ->margin(10)
                               ->roundBlockSizeMode(new Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin())
                               ->validateResult(false)
                               ->build();

                               $result->saveToFile(public_path('/assets/qrcode/'.auth()->user()->username.'.png'));
                               $dataUri = $result->getDataUri();
                           @endphp

                           <div class="kartu mb-4">
                                <div class="barcode">
                                    <img src="{{ url('/assets/qrcode/'.auth()->user()->username.'.png') }}" alt="{{ auth()->user()->username }}.png" class="mt-3" style="width: 160px">
                                </div>
                               <h2 class="member-name">{{ auth()->user()->name }}</h2>
                                <p class="membership-type">{{ auth()->user()->Jabatan->nama_jabatan ?? '-' }}</p>
                           </div>

                           <a href="{{ url('/pegawai/print/'.auth()->user()->id) }}" target="_blank" class="btn btn-primary"  style="border-radius: 15px"><i class="fa fa-download me-2"></i>Download</a>
                           <br><br><br>

                        </center>
                    </div>

                 </div>


            </div>

         </div>
    </div>







    <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
    @include('sweetalert::alert')

</body>

</html>
