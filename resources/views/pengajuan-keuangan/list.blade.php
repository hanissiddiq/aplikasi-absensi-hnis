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
                        <a href="{{ url('/list-pengajuan-keuangan/excel') }}{{ $_GET?'?'.$_SERVER['QUERY_STRING']: '' }}" class="btn btn-success">Export</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('/list-pengajuan-keuangan') }}">
                        @php
                            $status = array(
                                [
                                    "status" => "PENDING",
                                ],
                                [
                                    "status" => "APPROVED",
                                ],
                                [
                                    "status" => "REJECTED",
                                ],
                                [
                                    "status" => "COMPLETED",
                                ],
                            );
                        @endphp
                        <div class="row mb-2">
                            <div class="col-5">
                                <input type="text" class="form-control" name="search" placeholder="Search.." id="search" value="{{ request('search') }}">
                            </div>
                            <div class="col-2">
                                <select name="status" id="status" class="form-control selectpicker" data-live-search="true">
                                    <option value=""selected>Status</option>
                                    @foreach($status as $stat)
                                        @if(request('status') == $stat['status'])
                                            <option value="{{ $stat['status'] }}"selected>{{ $stat['status'] }}</option>
                                        @else
                                            <option value="{{ $stat['status'] }}">{{ $stat['status'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="datetime" class="form-control" name="mulai" placeholder="Tanggal Mulai" id="mulai" value="{{ request('mulai') }}">
                            </div>
                            <div class="col-2">
                                <input type="datetime" class="form-control" name="akhir" placeholder="Tanggal Akhir" id="akhir" value="{{ request('akhir') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" id="search"class="border-0 mt-3" style="background-color: transparent;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="vertical-align: middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="position: sticky; left: 0; background-color: rgb(215, 215, 215); z-index: 2;border: 1px solid black;">No.</th>
                                    <th style="position: sticky; left: 40px; background-color: rgb(215, 215, 215); z-index: 2; min-width: 230px;border: 1px solid black;" class="text-center">Nomor Pengajuan</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Nama Pegawai</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Tanggal</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Items</th>
                                    <th style="min-width: 230px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Total Pengajuan</th>
                                    <th style="min-width: 300px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Keterangan</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">File</th>
                                    <th style="min-width: 170px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Status</th>
                                    <th style="min-width: 400px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">User Approval</th>
                                    <th style="min-width: 200px; background-color:rgb(243, 243, 243);border: 1px solid black;" class="text-center">Nota</th>
                                    <th class="text-center" style="background-color:rgb(243, 243, 243);border: 1px solid black;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pengajuan_keuangans) <= 0)
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak Ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($pengajuan_keuangans as $key => $pk)
                                        <tr>
                                            <td class="text-center" style="position: sticky; left: 0; background-color: rgb(235, 235, 235); z-index: 1;border: 1px solid black;">{{ ($pengajuan_keuangans->currentpage() - 1) * $pengajuan_keuangans->perpage() + $key + 1 }}.</td>
                                            <td class="text-center" style="position: sticky; left: 40px; background-color: rgb(235, 235, 235); z-index: 1;border: 1px solid black;">{{ $pk->nomor ?? '-' }}</td>
                                            <td class="text-center" style="border: 1px solid black;">{{ $pk->user->name ?? '-' }}</td>
                                            <td class="text-center" style="border: 1px solid black;">
                                                @if ($pk->tanggal)
                                                    @php
                                                        Carbon\Carbon::setLocale('id');
                                                        $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pk->tanggal);
                                                        $new_tanggal = $tanggal->translatedFormat('d F Y');
                                                    @endphp
                                                    {{ $new_tanggal  }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="border: 1px solid black;">
                                                @if (count($pk->items) > 0)
                                                    @foreach ($pk->items as $index => $item)
                                                        <div class="row">
                                                            <div class="col-3">
                                                                Nama
                                                            </div>
                                                            <div class="col-1">
                                                                :
                                                            </div>
                                                            <div class="col-8">
                                                                {{ $item->nama }}
                                                            </div>
                                                            <div class="col-3">
                                                                Qty
                                                            </div>
                                                            <div class="col-1">
                                                                :
                                                            </div>
                                                            <div class="col-8">
                                                                {{ $item->qty }}
                                                            </div>
                                                            <div class="col-3">
                                                                Harga
                                                            </div>
                                                            <div class="col-1">
                                                                :
                                                            </div>
                                                            <div class="col-8">
                                                                Rp {{ number_format($item->harga) }}
                                                            </div>
                                                            <div class="col-3">
                                                                Total
                                                            </div>
                                                            <div class="col-1">
                                                                :
                                                            </div>
                                                            <div class="col-8">
                                                                Rp {{ number_format($item->total) }}
                                                            </div>
                                                        </div>
                                                        @if ($index < count($pk->items) - 1)
                                                            <hr style="background-color: black">
                                                        @endif
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center" style="border: 1px solid black;">Rp {{ number_format($pk->total_harga) }}</td>
                                            <td style="border: 1px solid black;">{!! $pk->keterangan ? nl2br(e($pk->keterangan)) : '-' !!}</td>
                                            <td class="text-center" style="border: 1px solid black;">
                                                @if ($pk->pk_file_path)
                                                    <a href="{{ url('/storage/'.$pk->pk_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $pk->pk_file_name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center" style="border: 1px solid black;">
                                                @if ($pk->status == 'REJECTED')
                                                    <div class="badge" style="color: rgba(78, 26, 26, 0.889); background-color:rgb(242, 170, 170); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                                @elseif($pk->status == 'APPROVED')
                                                    <div class="badge" style="color: rgba(20, 78, 7, 0.889); background-color:rgb(186, 238, 162); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                                @elseif($pk->status == 'PENDING')
                                                    <div class="badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                                @elseif($pk->status == 'ON GOING')
                                                    <div class="badge" style="color: rgb(21, 47, 118); background-color:rgba(192, 218, 254, 0.889); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                                @else
                                                    <div class="badge" style="color: rgb(45, 45, 45); background-color:rgba(207, 207, 207, 0.889); border-radius:10px;">{{ $pk->status ?? '-' }}</div>
                                                @endif
                                            </td>
                                            <td style="border: 1px solid black;">
                                                @if ($pk->ua)
                                                    <div class="float-start badge" style="color: rgba(255, 123, 0, 0.889); background-color:rgb(255, 238, 177); border-radius:10px;">
                                                        {{ $pk->ua->name ?? '-' }}
                                                    </div>
                                                    <div class="float-end" style="font-style: italic">
                                                        {!! $pk->note_approval ? nl2br(e($pk->note_approval)) : '-' !!}
                                                    </div>
                                                @else
                                                    <center>
                                                        -
                                                    </center>
                                                @endif
                                            </td>
                                            <td class="text-center" style="border: 1px solid black;">
                                                @if ($pk->nota_file_path)
                                                    <a href="{{ url('/storage/'.$pk->nota_file_path) }}" style="font-size: 10px"><i class="fa fa-download"></i> {{ $pk->nota_file_name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="border: 1px solid black;">
                                                @if ($pk->status == 'PENDING')
                                                    @if ($pk->total_harga <= 1000000)
                                                        @if (auth()->user()->hasAnyRole(['admin', 'finance', 'regional_manager', 'general_manager']))
                                                            <center>
                                                                <button class="border-0" style="background-color: transparent" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i style="color:blue" class="fa fa-check-circle me-2"></i></button>
                                                            </center>
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Approval Pengajuan Keuangan</h5>
                                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ url('/list-pengajuan-keuangan/approval/'.$pk->id) }}" method="POST">
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
                                                                                            @if(old('status', $pk->status) == $s["status"])
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
                                                                                    <label for="note_approval" class="col-form-label">Note:</label>
                                                                                    <textarea class="form-control" id="note_approval" name="note_approval">{{ old('note_approval') }}</textarea>
                                                                                    @error('note_approval')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
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
                                                    @else
                                                        @if (auth()->user()->hasAnyRole(['admin', 'regional_manager', 'general_manager']))
                                                            <center>
                                                                <button class="border-0" style="background-color: transparent" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i style="color:blue" class="fa fa-check-circle me-2"></i></button>
                                                            </center>
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Approval Pengajuan Keuangan</h5>
                                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ url('/list-pengajuan-keuangan/approval/'.$pk->id) }}" method="POST">
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
                                                                                            @if(old('status', $pk->status) == $s["status"])
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
                                                                                    <label for="note_approval" class="col-form-label">Note:</label>
                                                                                    <textarea class="form-control" id="note_approval" name="note_approval">{{ old('note_approval') }}</textarea>
                                                                                    @error('note_approval')
                                                                                        <div class="invalid-feedback">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
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
                                                @endif

                                                @if ($pk->status == 'ON GOING' && $pk->nota_file_path)
                                                    <a class="btn btn-info" onclick="return confirm('Are You Sure?')" href="{{ url('/list-pengajuan-keuangan/close/'.$pk->id) }}">COMPLETE</a>
                                                @endif

                                                <center>
                                                    <a class="badge badge-info" target="_blank" href="{{ url('/list-pengajuan-keuangan/pdf/'.$pk->id) }}"><i class="fa fa-file-pdf"></i> Pdf</a>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $pengajuan_keuangans->links() }}
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
