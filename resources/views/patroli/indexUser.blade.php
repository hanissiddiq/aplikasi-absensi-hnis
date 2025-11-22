@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Tanggal</span>
                    </div>
                    <span>{{ date('Y-m-d') }}</span>
                </div>
            </div>
        </div>
    </div>

    <br>
    <style>
        .jam-digital-malasngoding {
          overflow: hidden;
          float: center;
          width: 100px;
          margin: 2px auto;
          border: 0px solid #efefef;
        }

        .kotak {
          float: left;
          width: 30px;
          height: 30px;
          background-color: #189fff;
        }

        .jam-digital-malasngoding p {
          color: #fff;
          font-size: 16px;
          text-align: center;
          margin-top: 3px;
        }
    </style>

    <div class="jam-digital-malasngoding">
        <div class="kotak">
          <p id="jam"></p>
        </div>
        <div class="kotak">
          <p id="menit"></p>
        </div>
        <div class="kotak">
          <p id="detik"></p>
        </div>
    </div>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
          var waktu = new Date();
          setTimeout("waktu()", 1000);
          document.getElementById("jam").innerHTML = waktu.getHours();
          document.getElementById("menit").innerHTML = waktu.getMinutes();
          document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>
    <br>

    <div class="d-flex justify-content-center mb-4">
        <form action="{{ url('/my-location') }}" method="get">
            @csrf
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="long" id="long">
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <button type="submit" class="btn btn-success">Lihat Lokasi Saya</button>
        </form>
    </div>

    <div class="transfer-content">
        <form class="tf-form" action="{{ url('/patroli/store') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="tf-container">
                <center>
                    <div id="reader" style="width: 80%"></div>
                </center>
            </div>
        </form>
    </div>

    @push('script')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
            function showPosition(position) {
                $('#lat').val(position.coords.latitude);
                $('#long').val(position.coords.longitude);
            }

            setInterval(getLocation, 1000);

            function onScanSuccess(decodedText, decodedResult) {
                    let lat = $('#lat').val();
                    let long = $('#long').val();
                    let nama_lokasi = decodedText;
                    html5QrcodeScanner.clear().then(_ => {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('/patroli/store') }}",
                            type: 'POST',
                            data: {
                                _methode : "POST",
                                _token: CSRF_TOKEN,
                                nama_lokasi : nama_lokasi,
                                lat : lat,
                                long : long
                            },
                            success: function (response) {
                                if(response == 'success'){
                                    Swal.fire('Berhasil Scan!', '', 'success');
                                    setInterval(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Data Lokasi Tidak Ditemukan!',
                                    });
                                    setInterval(function() {
                                        location.reload();
                                    }, 2000);
                                }
                            }
                        });
                    }).catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ERROR!',
                        });
                        setInterval(function() {
                            location.reload();
                        }, 2000);
                    });
            }

            function onScanFailure(error) {
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    @endpush

@endsection



