<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $settings = App\Models\settings::first();
        @endphp
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
        <!-- Favicon and Touch Icons  -->
        <link rel="shortcut icon" href="{{ url('/storage/'.$settings->logo) }}" />
        <link rel="apple-touch-icon-precomposed" href="{{ url('/storage/'.$settings->logo) }}" />
        <!-- Font -->
        <link rel="stylesheet" href="{{ url('/myhr/fonts/fonts.css') }}" />
        <!-- Icons -->
        <link rel="stylesheet" href="{{ url('/myhr/fonts/icons-alipay.css') }}">
        <link rel="stylesheet" href="{{ url('/myhr/styles/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('/myhr/styles/swiper-bundle.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/myhr/styles/styles.css') }}" />
        <link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
        <link rel="apple-touch-icon" sizes="192x192" href="{{ url('/myhr/app/icons/icon-192x192.png') }}">
        <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/html/assets/css/vendors/select2.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.css') }}" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
        <script src="{{ url('https://unpkg.com/leaflet@1.8.0/dist/leaflet.js') }}" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
        <link rel="stylesheet" type="text/css" href="{{ url('clock/dist/bootstrap-clockpicker.min.css') }}">
        <style>
            .select2-container .select2-selection--single {
                height: 45px;
                line-height: 45px;
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 45px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 45px;
            }

            .select2-results__option {
                line-height: 45px;
            }

            .select2-selection__choice {
                line-height: 45px;
            }
        </style>
        @stack('style')
    </head>

    <body class="bg_surface_color">
        <!-- preloade -->
        <div class="preload preload-container">
            <div class="preload-logo">
            <div class="spinner"></div>
            </div>
        </div>
        <!-- /preload -->
        <div class="header-style2" style="background: url({{ url('/storage/'.$berita->berita_file_path) }});">
            <div class="tf-container">
                <a href="#" class="back-btn"> <i class="icon-left"></i> </a>
            </div>
        </div>
        <div class="mb-8">
            <div class="app-section bg_white_color giftcard-detail-section-1">
                <div class="tf-container">
                    <div class="voucher-info">
                        <h2 class="fw_6">{{ $berita->judul }}</h2>
                    </div>
                </div>
            </div>

            <div class="app-section mt-1 bg_white_color giftcard-detail-section-2">
                <div class="tf-container">
                    <div class="voucher-desc">
                        <p class="mt-1">{{ $berita->isi }}</p>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>

        <div class="bottom-navigation-bar">
            <div class="tf-container">
                <ul class="tf-navigation-bar">
                    <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a class="fw_6 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/dashboard') }}"><i class="{{ Request::is('dashboard*') ? 'icon-home2' : 'icon-home' }}"></i> Home</a> </li>
                    <li class="{{ Request::is('my-absen*') ? 'active' : '' }}"><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ url('/my-absen') }}"><i
                                class="icon-history"></i> History</a> </li>
                    <li><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ url('/absen') }}"><i
                                class="icon-scan-qr-code"></i> </a> </li>
                    <li class="{{ Request::is('my-dinas-luar*') ? 'active' : '' }}"><a class="fw_4 d-flex justify-content-center align-items-center flex-column"
                            href="{{ url('/my-dinas-luar') }}"><svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12.25" cy="12" r="9.5" stroke="{{ Request::is('my-dinas-luar*') ? '#0000FF' : '#717171' }}" />
                                <path
                                    d="M17.033 11.5318C17.2298 11.3316 17.2993 11.0377 17.2144 10.7646C17.1293 10.4914 16.9076 10.2964 16.6353 10.255L14.214 9.88781C14.1109 9.87213 14.0218 9.80462 13.9758 9.70702L12.8933 7.41717C12.7717 7.15989 12.525 7 12.2501 7C11.9754 7 11.7287 7.15989 11.6071 7.41717L10.5244 9.70723C10.4784 9.80483 10.3891 9.87234 10.286 9.88802L7.86469 10.2552C7.59257 10.2964 7.3707 10.4916 7.2856 10.7648C7.2007 11.038 7.27018 11.3318 7.46702 11.532L9.2189 13.3144C9.29359 13.3905 9.32783 13.5 9.31021 13.607L8.89692 16.1239C8.86027 16.3454 8.91594 16.5609 9.0533 16.7308C9.26676 16.9956 9.6394 17.0763 9.93735 16.9128L12.1027 15.7244C12.1932 15.6749 12.3072 15.6753 12.3975 15.7244L14.563 16.9128C14.6684 16.9707 14.7807 17 14.8966 17C15.1083 17 15.3089 16.9018 15.4469 16.7308C15.5845 16.5609 15.6399 16.345 15.6033 16.1239L15.1898 13.607C15.1722 13.4998 15.2064 13.3905 15.2811 13.3144L17.033 11.5318Z"
                                    stroke="{{ Request::is('my-dinas-luar*') ? '#0000FF' : '#717171' }}" stroke-width="1.25" />
                            </svg>
                            Dinas</a> </li>
                    <li class="{{ Request::is('my-profile*') ? 'active' : '' }}"><a class="fw_4 d-flex justify-content-center align-items-center flex-column" href="{{ url('/my-profile') }}"><i
                                class="icon-user-outline"></i> Profile</a> </li>
                </ul>
            </div>
        </div>

        <script type="text/javascript" src="{{ url('/myhr/javascript/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/myhr/javascript/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/myhr/javascript/swiper-bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/myhr/javascript/swiper.js') }}"></script>
        <script type="text/javascript" src="{{ url('/myhr/javascript/main.js') }}"></script>
        <script src="{{ url('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/clock/dist/bootstrap-clockpicker.min.js') }}"></script>
        <script src="{{ url('accounting.min.js') }}"></script>
        <script>
            config = {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
            }

            flatpickr("input[type=datetime-local]", config)
            flatpickr("input[type=datetime]", {})

            $(function () {

                $('#tablePayroll').DataTable( {
                    "responsive": true,
                    "paging": false,
                    "info": false,
                    "scrollCollapse": true,
                    "autoWidth": false,
                    'searching': false
                });
                 $("#tableprint").DataTable({
                    "responsive": true, "autoWidth": false,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    dom: 'flrtip'
                    // "buttons": ["excel", "pdf", "print"]
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#tableprint_wrapper .col-md-6:eq(0)');


            });

        </script>
        <script src="{{ url('/html/assets/js/select2/select2.full.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ url('/push/bin/push.js') }}"></script>
        <script src="{{ url('/js/app.js') }}"></script>
        <script>
            // Konfigurasi Push.js dengan scope dan serviceWorker spesifik
            Push.config({
                serviceWorker: '{{ url("/push/bin/serviceWorker.min.js") }}',
                scope: window.location.hostname // Hanya menerima notifikasi dari domain ini
            });
            
            window.Echo.channel("messages").listen("NotifApproval", (event) => {
                var user_id = {{ auth()->user()->id }};
                if (event.user_id == user_id) {
                    if (event.type == "Approved") {
                        Swal.fire({
                            icon: "success",
                            title: "Approved",
                            text: event.notif,
                            footer: "<a href=" + event.url + ">View Application</a>",
                        });
                    } else if (event.type == "Approval" || event.type == "Info") {
                        Swal.fire({
                            icon: "info",
                            title: "",
                            text: event.notif,
                            footer: "<a href=" + event.url + ">View Application</a>",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Rejected",
                            text: event.notif,
                            footer: "<a href=" + event.url + ">View Application</a>",
                        });
                    }
                    Push.create(event.notif);
                }
            });
        </script>
        @include('sweetalert::alert')
        @stack('script')
    </body>
</html>
