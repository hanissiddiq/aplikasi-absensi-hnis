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
        
        .face-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            background-color: #fff;
            text-align: center;
        }
        
        .face-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-dark);
            letter-spacing: -0.025em;
        }
        
        .face-subtitle {
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        .video-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 75%;
            margin-bottom: 2rem;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border-color);
            background-color: #000;
        }
        
        #video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
            .face-container {
                max-width: 90%;
                margin: 1.5rem auto;
                padding: 1.5rem;
            }
            
            .face-title {
                font-size: 1.5rem;
            }
            
            .video-container {
                padding-bottom: 100%;
            }
        }
    </style>
    
    <div class="face-container">
        <h1 class="face-title">{{ $title }}</h1>
        <p class="face-subtitle">Posisikan wajah Anda di depan kamera untuk melakukan absensi pulang</p>
        
        <div class="video-container">
            <video id="video" autoplay playsinline></video>
            <canvas id="canvas"></canvas>
        </div>
        
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="long" id="long">
        
        <a href="{{ url('/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
    
    @push('script')
        <script src="{{ url('/face/dist/face-api.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Geolocation tidak didukung oleh browser ini',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }
            
            function showPosition(position) {
                $('#lat').val(position.coords.latitude);
                $('#long').val(position.coords.longitude);
            }
            
            function showError(error) {
                let errorMessage = '';
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = "Anda menolak permintaan geolokasi";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = "Informasi lokasi tidak tersedia";
                        break;
                    case error.TIMEOUT:
                        errorMessage = "Permintaan untuk mendapatkan lokasi pengguna habis waktu";
                        break;
                    case error.UNKNOWN_ERROR:
                        errorMessage = "Terjadi kesalahan yang tidak diketahui";
                        break;
                }
                
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: errorMessage,
                    confirmButtonColor: '#4f46e5'
                });
            }
            
            // Dapatkan lokasi setiap 5 detik
            setInterval(getLocation, 5000);
            
            let faceMatcher = undefined;
            let video = document.getElementById("video");
            let canvas = document.getElementById("canvas");
            let ctx = canvas.getContext("2d");
            
            let width = 320;  // Resolusi lebih rendah untuk kinerja lebih baik
            let height = 240;

            const startStream = async () => {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: "user", width, height },
                        audio: false
                    });
                    video.srcObject = stream;
                } catch (error) {
                    console.error('Error accessing camera:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tidak dapat mengakses kamera. Pastikan Anda memberikan izin kamera.',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            }

            // Memuat model yang diperlukan
            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceRecognitionNet.loadFromUri("{{ url('/face/weights') }}")
            ]).then(startStream);

            video.onloadedmetadata = () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                start();
            };

            async function start() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Memuat data wajah, harap tunggu.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Mengambil data neural untuk menciptakan faceMatcher
                $.ajax({
                    datatype: 'json',
                    url: "{{ url('/ajaxGetNeural') }}",
                    data: ""
                }).done(async function(data) {
                    if (data.length > 2) {
                        var json_str = "{\"parent\":" + data + "}"
                        var content = JSON.parse(json_str);
                        for (let x = 0; x < content.parent.length; x++) {
                            for (let y = 0; y < content.parent[x].descriptors.length; y++) {
                                let results = Object.values(content.parent[x].descriptors[y])
                                content.parent[x].descriptors[y] = new Float32Array(results)
                            }
                        }
                        faceMatcher = await createFaceMatcher(content);
                        onPlay();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Tidak ada data wajah yang tersedia',
                            confirmButtonColor: '#4f46e5'
                        });
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal memuat data wajah: ' + textStatus,
                        confirmButtonColor: '#4f46e5'
                    });
                });
            }

            async function createFaceMatcher(data) {
                const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
                    return new faceapi.LabeledFaceDescriptors(
                        className.label,
                        className.descriptors.map(d => new Float32Array(d))
                    );
                }));
                return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
            }

            async function onPlay() {
                if (faceMatcher) {
                    const displaySize = { width: video.videoWidth, height: video.videoHeight };
                    faceapi.matchDimensions(canvas, displaySize);

                    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                        .withFaceLandmarks()
                        .withFaceDescriptors();
                    const resizedDetections = faceapi.resizeResults(detections, displaySize);
                    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));

                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    results.forEach((result, i) => {
                        const box = resizedDetections[i].detection.box;
                        const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
                        drawBox.draw(canvas);

                        let label = result.label;
                        let distance = result.distance;
                        Swal.close()
                        if (label !== "unknown" && distance < 0.5) {
                            let imageURL = canvas.toDataURL();
                            var canvas2 = document.createElement('canvas');
                            canvas2.width = 600;
                            canvas2.height = 600;
                            var ctx = canvas2.getContext('2d');
                            ctx.drawImage(video, 0, 0, 600, 600);
                            var new_image_url = canvas2.toDataURL();
                            var img = document.createElement('img');
                            img.src = new_image_url;
                            let lat = $('#lat').val();
                            let long = $('#long').val();
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('/presensi-pulang/store') }}",
                                data: { username: label, image: img.src, lat: lat, long:long },
                                cache: false,
                                success: function(msg) {
                                    let title = '';
                                    let icon = 'success';
                                    
                                    switch (msg) {
                                        case 'pulang':
                                            title = 'Berhasil Pulang';
                                            icon = 'success';
                                            break;
                                        case 'outlocation':
                                            title = 'Anda Berada Di Luar Radius Kantor';
                                            icon = 'error';
                                            break;
                                        case 'selesai':
                                            title = 'Anda Sudah Selesai Absen Hari Ini';
                                            icon = 'warning';
                                            break;
                                        case 'noMs':
                                            title = 'Hubungi Admin Untuk Input Shift Anda';
                                            icon = 'warning';
                                            break;
                                        default:
                                            title = 'Tidak Ada Data User';
                                            icon = 'error';
                                    }
                                    
                                    Swal.fire({
                                        icon: icon,
                                        title: title,
                                        confirmButtonColor: '#4f46e5'
                                    });
                                    
                                    setTimeout(() => Swal.close(), 2000);
                                },
                                error: function(data) {
                                    console.error('Error:', data);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan saat memproses data',
                                        confirmButtonColor: '#4f46e5'
                                    });
                                }
                            });
                        }
                    });
                }

                setTimeout(() => onPlay(), 5000); // Interval untuk deteksi ulang setiap 5 detik
            }
        </script>
    @endpush
@endsection


