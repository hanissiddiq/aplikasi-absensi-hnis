@extends('templates.app')
@section('container')
<style>
    td {
        border: 1px solid #e2dede;
    }
    th {
        border-top: 1px solid #e2dede;
        border-left: 1px solid #e2dede;
        border-right: 1px solid #e2dede;
    }
</style>
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form action="{{ url('/exit') }}">
                    <div class="row">
                        <div class="col-5">
                            <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                        </div>
                        <div class="col-5">
                            <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" id="search" class="form-control btn" style="border-radius: 10px; width:40px"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="tf-spacing-20"></div>
    <a href="{{ url('/exit/tambah') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
    <div class="tf-spacing-20"></div>
    <div class="transfer-content">
        <div class="tf-container">
            <div class="table-responsive" style="border-radius: 10px">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;">No.</th>
                            <th style="40px; background-color: rgb(215, 215, 215); min-width: 230px;" class="text-center">Nama Pegawai</th>
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
                                    <td class="text-center" style="background-color: rgb(235, 235, 235);">{{ $pegawai_keluar->user->name ?? '-' }}</td>
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
                                            <span class="badge" style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                        @elseif($pegawai_keluar->status == 'APPROVED')
                                            <span class="badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                        @else
                                            <span class="badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $pegawai_keluar->status ?? '-' }}</span>
                                        @endif
                                    </td>
                                    <td>{!! $pegawai_keluar->notes ? nl2br(e($pegawai_keluar->notes)) : '-' !!}</td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            @if ($pegawai_keluar->status == 'PENDING')
                                                <a class="btn btn-sm btn-warning" href="{{ url('/exit/edit/'.$pegawai_keluar->id) }}"><i class="fa fa-solid fa-edit"></i></a>


                                                <form action="{{ url('/exit/delete/'.$pegawai_keluar->id) }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm btn-circle" style="width: 40px" onClick="return confirm('Are You Sure')"><i class="fa fa-solid fa-trash"></i></button>
                                                </form>

                                                @if (($pegawai_keluar->user && $pegawai_keluar->user->Jabatan && $pegawai_keluar->user->Jabatan->manager == auth()->user()->id) || auth()->user()->is_admin == 'admin')
                                                    <button class="border-0 btn btn-primary btn-sm btn-circle" style="width: 40px" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-check-circle"></i></button>
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
                                                @endif
                                            @endif
                                        </div>
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
    <br>
    <br>
@endsection
