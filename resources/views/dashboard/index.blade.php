@extends('templates.dashboard')
@section('isi')
  <div class="row">
    <!-- Dashboard Header -->
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
          <h4 class="mb-0">Dashboard Kehadiran - {{ date('F Y') }}</h4>
          <div class="d-flex align-items-center">
            <span class="badge bg-primary p-2 me-2">
              <i data-feather="calendar" class="me-1" style="width: 16px; height: 16px;"></i> {{ date('d F Y') }}
            </span>
            <span class="badge bg-info p-2">
              <i data-feather="clock" class="me-1" style="width: 16px; height: 16px;"></i> <span id="live-time"></span>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="col-12">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-primary-light me-3">
                  <i data-feather="users" class="text-primary"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Total Pegawai</h6>
                  <h4 class="mb-0">{{ $jumlah_user }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-success-light me-3">
                  <i data-feather="check-circle" class="text-success"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Masuk</h6>
                  <h4 class="mb-0">{{ $jumlah_masuk + $jumlah_izin_telat + $jumlah_izin_pulang_cepat }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-danger-light me-3">
                  <i data-feather="x-circle" class="text-danger"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Alfa</h6>
                  <h4 class="mb-0">{{ ($jumlah_user - ($jumlah_masuk + $jumlah_izin_telat + $jumlah_izin_pulang_cepat + $jumlah_libur + $jumlah_cuti + $jumlah_izin_masuk + $jumlah_sakit)) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-warning-light me-3">
                  <i data-feather="calendar" class="text-warning"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Libur</h6>
                  <h4 class="mb-0">{{ $jumlah_libur }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Additional Stats -->
    <div class="col-12">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-info-light me-3">
                  <i data-feather="file-text" class="text-info"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Lembur</h6>
                  <h4 class="mb-0">{{ $jumlah_karyawan_lembur }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-primary-light me-3">
                  <i data-feather="credit-card" class="text-primary"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Cuti</h6>
                  <h4 class="mb-0">{{ $jumlah_cuti }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-warning-light me-3">
                  <i data-feather="thermometer" class="text-warning"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Sakit</h6>
                  <h4 class="mb-0">{{ $jumlah_sakit }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-success-light me-3">
                  <i data-feather="umbrella" class="text-success"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Izin</h6>
                  <h4 class="mb-0">{{ $jumlah_izin_masuk }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Izin Stats -->
    <div class="col-12">
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-info-light me-3">
                  <i data-feather="clock" class="text-info"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Izin Telat</h6>
                  <h4 class="mb-0">{{ $jumlah_izin_telat }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-danger-light me-3">
                  <i data-feather="log-out" class="text-danger"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Izin Pulang Cepat</h6>
                  <h4 class="mb-0">{{ $jumlah_izin_pulang_cepat }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-primary-light me-3">
                  <i data-feather="dollar-sign" class="text-primary"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Payroll {{ date('F Y') }}</h6>
                  <h4 class="mb-0">Rp {{ number_format($payroll) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Financial Stats -->
    <div class="col-12">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-warning-light me-3">
                  <i data-feather="git-commit" class="text-warning"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Kasbon {{ date('F Y') }}</h6>
                  <h4 class="mb-0">Rp {{ number_format($kasbon) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="rounded-circle p-3 bg-success-light me-3">
                  <i data-feather="pocket" class="text-success"></i>
                </div>
                <div>
                  <h6 class="text-muted mb-1">Reimbursement {{ date('F Y') }}</h6>
                  <h4 class="mb-0">Rp {{ number_format($reimbursement) }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Calendar -->
    <div class="col-12 mb-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kalender Kehadiran - {{ date('F Y') }}</h5>
            <div class="calendar-legend d-flex flex-wrap">
              <span class="badge bg-danger me-2 mb-1">Ulang Tahun</span>
              <span class="badge bg-warning me-2 mb-1">Sakit</span>
              <span class="badge bg-primary me-2 mb-1">Cuti</span>
              <span class="badge bg-info me-2 mb-1">Izin</span>
              <span class="badge bg-success me-2 mb-1">Izin Telat</span>
              <span class="badge bg-secondary mb-1">Izin Pulang Cepat</span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @push('script')
    <script>
      // Live time function
      function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit'
        });
        document.getElementById('live-time').textContent = timeString;
      }
      
      // Update time every second
      setInterval(updateTime, 1000);
      updateTime(); // Initial call
      
      // Calendar initialization
      document.addEventListener("DOMContentLoaded", function () {
        var date = new Date();
        var d = date.getDate();
        m = date.getMonth();
        y = date.getFullYear();

        var containerEl = document.getElementById("external-events-list");
        if (containerEl) {
          new FullCalendar.Draggable(containerEl, {
            itemSelector: ".fc-event",
            eventData: function (eventEl) {
              return {
                title: eventEl.innerText.trim(),
              };
            },
          });
        }

        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
          },
          initialView: "dayGridMonth",
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          height: 'auto',
          events: [
            @php
              $tahun_skrg = date('Y');
              $bulan_skrg = date('m');
              $jmlh_bulan = cal_days_in_month(CAL_GREGORIAN,$bulan_skrg,$tahun_skrg);
              $tgl_mulai = date('1945-01-01');
              $tgl_akhir = date('Y-m-'.$jmlh_bulan);
              $data_user = App\Models\User::select('name', 'tgl_lahir')->whereBetween('tgl_lahir', [$tgl_mulai, $tgl_akhir])->get();
              $data_sakit = App\Models\MappingShift::where('status_absen', 'Sakit')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
              $data_cuti = App\Models\MappingShift::where('status_absen', 'Cuti')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
              $data_izin_masuk = App\Models\MappingShift::where('status_absen', 'Izin Masuk')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
              $data_izin_telat = App\Models\MappingShift::where('status_absen', 'Izin Telat')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
              $data_izin_pulang_cepat = App\Models\MappingShift::where('status_absen', 'Izin Pulang Cepat')->whereBetween('tanggal', [$tgl_mulai, $tgl_akhir])->get();
            @endphp
            
            @foreach($data_user as $du)
              @php
                $pecah = explode("-", $du->tgl_lahir)
              @endphp
              {
                title: 'Ulang Tahun {{ $du->name }}',
                start: '{{ $tahun_skrg }}-{{ $pecah[1] }}-{{ $pecah[2] }}',
                backgroundColor: '#dc3545',
                borderColor: '#dc3545',
                textColor: '#fff'
              },
            @endforeach
            
            @foreach($data_sakit as $ds)
              {
                title: 'Sakit: {{ $ds->user->name }}',
                start: '{{ $ds->tanggal }}',
                backgroundColor: '#ffc107',
                borderColor: '#ffc107',
                textColor: '#212529'
              },
            @endforeach
            
            @foreach($data_cuti as $dc)
              {
                title: 'Cuti: {{ $dc->user->name }}',
                start: '{{ $dc->tanggal }}',
                backgroundColor: '#0d6efd',
                borderColor: '#0d6efd',
                textColor: '#fff'
              },
            @endforeach
            
            @foreach($data_izin_masuk as $dim)
              {
                title: 'Izin: {{ $dim->user->name }}',
                start: '{{ $dim->tanggal }}',
                backgroundColor: '#0dcaf0',
                borderColor: '#0dcaf0',
                textColor: '#212529'
              },
            @endforeach
            
            @foreach($data_izin_telat as $dit)
              {
                title: 'Izin Telat: {{ $dit->user->name }}',
                start: '{{ $dit->tanggal }}',
                backgroundColor: '#198754',
                borderColor: '#198754',
                textColor: '#fff'
              },
            @endforeach
            
            @foreach($data_izin_pulang_cepat as $dipc)
              {
                title: 'Izin Pulang Cepat: {{ $dipc->user->name }}',
                start: '{{ $dipc->tanggal }}',
                backgroundColor: '#6c757d',
                borderColor: '#6c757d',
                textColor: '#fff'
              },
            @endforeach
          ],
          eventClick: function(info) {
            info.jsEvent.preventDefault();
            Swal.fire({
              title: info.event.title,
              text: 'Tanggal: ' + moment(info.event.start).format('DD MMMM YYYY'),
              icon: 'info',
              confirmButtonColor: '#0d6efd'
            });
          },
          windowResize: function(view) {
            if(window.innerWidth < 768) {
              calendar.changeView('listWeek');
            } else {
              calendar.changeView('dayGridMonth');
            }
          }
        });
        
        // Initial view based on screen size
        if(window.innerWidth < 768) {
          calendar.changeView('listWeek');
        }
        
        calendar.render();
      });
    </script>
    <style>
      /* Custom background colors for cards */
      .bg-primary-light {
        background-color: rgba(13, 110, 253, 0.15);
      }
      .bg-success-light {
        background-color: rgba(25, 135, 84, 0.15);
      }
      .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.15);
      }
      .bg-danger-light {
        background-color: rgba(220, 53, 69, 0.15);
      }
      .bg-info-light {
        background-color: rgba(13, 202, 240, 0.15);
      }
      
      /* Card styling */
      .card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 0.75rem;
      }
      
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
      }
      
      /* Calendar styling */
      .fc-theme-standard td, .fc-theme-standard th {
        border-color: #e9ecef;
      }
      
      .fc-theme-standard .fc-scrollgrid {
        border-color: #e9ecef;
      }
      
      .fc .fc-button-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
      }
      
      .fc .fc-button-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
      }
      
      .fc .fc-button-primary:disabled {
        background-color: #6c757d;
        border-color: #6c757d;
      }
      
      .fc .fc-daygrid-day.fc-day-today {
        background-color: rgba(13, 110, 253, 0.1);
      }
      
      /* Responsive adjustments */
      @media (max-width: 767.98px) {
        .calendar-legend {
          margin-top: 0.5rem;
          justify-content: flex-start;
          width: 100%;
        }
        
        .card-header {
          flex-direction: column;
          align-items: flex-start !important;
        }
        
        .card-header h5 {
          margin-bottom: 0.5rem;
        }
      }
    </style>
  @endpush
@endsection
