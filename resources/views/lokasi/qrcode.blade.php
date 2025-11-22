@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/lokasi-kantor') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <center>
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
               @endphp

               <div class="kartu mb-4">
                    <div class="barcode">
                        <img src="{{ url('/assets/qrcode/'.$lokasi->nama_lokasi.'.png') }}" alt="{{ $lokasi->nama_lokasi }}.png" class="mt-3" style="width: 160px">
                    </div>
                   <h2 class="member-name">{{ $lokasi->nama_lokasi }}</h2>
               </div>

               <a href="{{ url('/lokasi-kantor/print/'.$lokasi->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-download me-2" style="border-radius: 10px"></i>Download</a>
               <br><br><br>

            </center>
        </div>
    </div>

    @push('style')
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
    @endpush


@endsection
