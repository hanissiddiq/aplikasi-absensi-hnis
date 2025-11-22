@extends('templates.login')
@section('container')
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --text-dark: #333;
            --text-muted: #6b7280;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --bg-light: #f9fafb;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 4px;
            --radius-md: 6px;
            --radius-lg: 10px;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        
        .qr-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            background-color: #fff;
            text-align: center;
        }
        
        .qr-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-dark);
            letter-spacing: -0.025em;
        }
        
        .qr-subtitle {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        #reader {
            width: 100% !important;
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }
        
        /* Override QR scanner styles */
        #reader video {
            border-radius: var(--radius-md);
        }
        
        #reader__dashboard {
            background-color: var(--bg-light) !important;
            padding: 1rem !important;
        }
        
        #reader__dashboard_section_csr button {
            background-color: var(--primary-color) !important;
            color: white !important;
            border: none !important;
            border-radius: var(--radius-md) !important;
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem !important;
            cursor: pointer !important;
            transition: all 0.2s !important;
        }
        
        #reader__dashboard_section_csr button:hover {
            background-color: var(--primary-hover) !important;
        }
        
        #reader__dashboard_section_swaplink {
            color: var(--primary-color) !important;
        }
        
        #reader__scan_region {
            background-color: transparent !important;
        }
        
        .back-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
            text-decoration: none;
        }
        
        .back-button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
            text-decoration: none;
        }
        
        .back-button i {
            margin-right: 0.5rem;
        }
        
        /* Media Queries for Mobile View */
        @media (max-width: 768px) {
            .qr-container {
                max-width: 90%;
                margin: 1.5rem auto;
                padding: 1.5rem;
            }
            
            .qr-title {
                font-size: 1.5rem;
            }
            
            #reader {
                height: auto !important;
            }
        }
    </style>
    
    <div class="qr-container">
        <h1 class="qr-title">{{ $title }}</h1>
        <p class="qr-subtitle">Scan QR code Anda untuk melakukan absensi pulang</p>
        
        <div id="reader"></div>
        
        <a href="{{ url('/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
    
    @push('script')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                let username = decodedText;
                html5QrcodeScanner.clear().then(_ => {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('/qr-pulang/store') }}",
                        type: 'POST',
                        data: {
                            _methode : "POST",
                            _token: CSRF_TOKEN,
                            username : username
                        },
                        success: function (response) {
                            console.log(response);
                            if(response == 'pulang'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Absensi pulang berhasil dicatat',
                                    confirmButtonColor: '#4f46e5'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else if (response == 'selesai'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Anda sudah melakukan absensi pulang hari ini',
                                    confirmButtonColor: '#4f46e5'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else if (response == 'noMs'){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Perhatian',
                                    text: 'Hubungi admin untuk input shift Anda',
                                    confirmButtonColor: '#4f46e5'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Data QR atau pegawai tidak ditemukan di sistem',
                                    confirmButtonColor: '#4f46e5'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat memproses QR code',
                        confirmButtonColor: '#4f46e5'
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                });
            }

            function onScanFailure(error) {
                // Silence is golden
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 250, height: 250} },
                /* verbose= */ false
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    @endpush
@endsection
