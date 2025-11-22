<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $lokasi->nama_lokasi }}</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .kartu {
            width: 270px;
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
<body>
    @php
        $result = Endroid\QrCode\Builder\Builder::create()
        ->writer(new Endroid\QrCode\Writer\PngWriter())
        ->writerOptions([])
        ->data($lokasi->nama_lokasi)
        ->encoding(new Endroid\QrCode\Encoding\Encoding('UTF-8'))
        ->errorCorrectionLevel(new Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin())
        ->validateResult(false)
        ->build();

        $result->saveToFile(public_path('/assets/qrcode/'.$lokasi->nama_lokasi.'.png'));
        $dataUri = $result->getDataUri();

        $path = public_path('/assets/qrcode/'.$lokasi->nama_lokasi.'.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp


    <div class="container">
        <div class="kartu mb-4">
            <div class="barcode">
                <img src="{{ url('/assets/qrcode/'.$lokasi->nama_lokasi.'.png') }}" alt="{{ $lokasi->nama_lokasi }}.png" style="margin-top: 20px; width: 160px">
            </div>
           <h2 class="member-name">{{ $lokasi->nama_lokasi }}</h2>
       </div>
    </div>
</body>
</html>

