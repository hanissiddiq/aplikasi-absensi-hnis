@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 mt-2 p-0 d-flex">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/exit/tambah') }}" class="btn btn-primary ms-2">+ Tambah</a>
                        {{-- <a href="{{ url('/exit/export') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success">Export</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/exit') }}">
                        <div class="row mb-2">
                            <div class="col-5">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Pegawai" id="nama" value="{{ request('nama') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-3">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 10px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);" class="text-center">Tanggal</centh>
                                    <th style="min-width: 250px; background-color:rgb(243, 243, 243);" class="text-center">Jenis</th>
                                    <th style="min-width: 250px; background-color:rgb(243, 243, 243);" class="text-center">Alasan</th>
                                    <th style="min-width: 230px; background-color:rgb(243, 243, 243);" class="text-center">File</th>
                                    <th style="min-width: 230px; background-color:rgb(243, 243, 243);" class="text-center">User Approval</th>
                                    <th style="min-width: 150px; background-color:rgb(243, 243, 243);" class="text-center">Status</th>
                                    <th style="min-width: 250px; background-color:rgb(243, 243, 243);" class="text-center">Note Approver</th>
                                    <th class="text-center" style="background-color:rgb(243, 243, 243);">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pegawai_keluars) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($pegawai_keluars as $key => $pegawai_keluar)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1;">{{ ($pegawai_keluars->currentpage() - 1) * $pegawai_keluars->perpage() + $key + 1 }}.</td>
                                            <td class="text-center" style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;">{{ $pegawai_keluar->user->name ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($pegawai_keluar->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pegawai_keluar->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $pegawai_keluar->jenis ?? '-' }}</td>
                                            <td>{!! $pegawai_keluar->alasan ? nl2br(e($pegawai_keluar->alasan)) : '-' !!}</td>
                                            <td class="text-center">
                                                @if ($pegawai_keluar->pegawai_keluar_file_path)
                                                    <a href="{{ url('/storage/'.$pegawai_keluar->pegawai_keluar_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $pegawai_keluar->pegawai_keluar_file_name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $pegawai_keluar->approvedBy->name ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($pegawai_keluar->status == 'REJECTED')
                                                    <span class="btn btn-xs" style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                                @elseif($pegawai_keluar->status == 'APPROVED')
                                                    <span class="btn btn-xs" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                                @else
                                                    <span class="btn btn-xs" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                                @endif
                                            </td>
                                            <td>{!! $pegawai_keluar->notes ? nl2br(e($pegawai_keluar->notes)) : '-' !!}</td>
                                            <td>
                                                <ul class="action">
                                                    @if ($pegawai_keluar->status == 'PENDING')
                                                        <li class="edit">
                                                            <a href="{{ url('/exit/edit/'.$pegawai_keluar->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                        </li>
                                                        <li class="delete">
                                                            <form action="{{ url('/exit/delete/'.$pegawai_keluar->id) }}" method="post" class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="border-0" style="background-color: transparent;" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </li>

                                                        @if (($pegawai_keluar->user && $pegawai_keluar->user->Jabatan && $pegawai_keluar->user->Jabatan->manager == auth()->user()->id) || auth()->user()->is_admin == 'admin')
                                                            <li>
                                                                <button class="border-0" style="background-color: transparent" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i style="color:blue" class="fa fa-check-circle"></i></button>
                                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Approval Pegawai Keluar</h5>
                                                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form action="{{ url('/exit/approval/'.$pegawai_keluar->id) }}" method="POST">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        @php
                                                                                            $status = array(
                                                                                                [
                                                                                                    "status" => "APPROVED",
                                                                                                    "status_name" => "APPROVE"
                                                                                                ],
                                                                                                [
                                                                                                    "status" => "REJECTED",
                                                                                                    "status_name" => "REJECT"
                                                                                                ]
                                                                                            );
                                                                                        @endphp
                                                                                        <label for="status">Status</label>
                                                                                        <select name="status" id="status" class="form-control selectpicker" data-live-search="true">
                                                                                            <option value="">Pilih Status</option>
                                                                                            @foreach ($status as $s)
                                                                                                @if(old('status', $pegawai_keluar->status) == $s["status"])
                                                                                                    <option value="{{ $s["status"] }}" selected>{{ $s["status_name"] }}</option>
                                                                                                @else
                                                                                                    <option value="{{ $s["status"] }}">{{ $s["status_name"] }}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="notes" class="col-form-label">Notes:</label>
                                                                                        <textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea>
                                                                                        @error('notes')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <input type="hidden" name="approved_by" value="{{ auth()->user()->id }}">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                                                                                    <button class="btn btn-secondary" type="submit">Save changes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endif

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $pegawai_keluars->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#mulai').change(function(){
                    var mulai = $(this).val();
                $('#akhir').val(mulai);
                });
            });
        </script>
    @endpush
@endsection
