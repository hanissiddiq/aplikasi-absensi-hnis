<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pk->nomor }}</title>
    <style>
        @page {
            margin-top: 115px ;
            margin-bottom: 20px ;
            margin-left: 20px ;
            margin-right: 20px ;
        }
        footer { position: fixed; bottom: -5px; left: 0px; right: 0px; }
        #header { position: fixed; top: -105px; left: 0px; right: 0px; }
        p { page-break-after: always; }
        p:last-child { page-break-after: never; }
    </style>
</head>
<body>
    @php

    $td_head='font-weight:bold; border: 1px solid black; padding:6px; vertical-align:middle; text-align:center;';
    $th='padding:4px; border: 1px solid black; vertical-align:middle; font-weight:bold;';
    $th1='background:#374151;color:white';
    $th2='background:#F59E0B;';
    $td='padding:4px; border: 1px solid black; vertical-align:top; text-align:left;';
    $td_noborder_left='border-left: none;';
    $td_noborder_right='border-right: none;';
    $border_top_none='border-top: none;';
    $border_bottom_none='border-bottom: none;';
    $bold='font-weight:bold;';
    $text_right='text-align: right;';
    $text_left='text-align: left;';
    $text_center='text-align: center;';
    $ttd='padding:4px; font-weight:bold; vertical-align:top; text-align:center;';


    $check=true;
    @endphp
    <div id="header">
        <table  style="width: 100%; font-family: 'Open Sans', sans-serif; color:rgb(0, 0, 0);">
            <tbody>
                <tr>
                    <td style="width: 10%" rowspan="2">
                        @php
                            $settings = App\Models\settings::first();
                            $path = url('/storage/'.$settings->logo);
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" style="height: 60px;width: auto;" >
                    </td>
                    <td rowspan="2">
                        <div style="font-size: 22px; color:rgb(0, 39, 138)">{{ $settings->name }}</div>
                        <div style="font-size: 10px; color:rgb(0, 39, 138)">{{ $settings->alamat }}</div>
                    </td>
                    <td>
                        <div style="font-size: 22px; float:right; margin-top: 10px">PRA<span style="color: red">JA</span></div>
                    </td>
                </tr>
                <tr>
                    <div style="font-size: 12px; float:right;">online <span style="color: red">system</span></div>
                </tr>
                <tr>
                    <td colspan="3" ></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:3px solid #111;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-top:2px solid #111;  "></td>
                </tr>
            </tbody>
        </table>


    </div>

    <footer>
        <table style="margin-bottom:15px; border-collapse: collapse; width: 100%; font-size:9px; font-family: 'Open Sans', sans-serif; color:black;">
            <tbody>
                <tr>
                    <td style="{{$td.$text_center.$border_bottom_none}}" width="14%">General Manager</td>
                    <td style="{{$td.$text_center.$border_bottom_none}}" width="14%">Regional Manager</td>
                    @if ($pk->total_harga < 1000000)
                        <td style="{{$td.$text_center.$border_bottom_none}}" width="14%">Finance</td>
                    @endif
                </tr>
                <tr>
                    @php
                        $path2 = url('/assets/img/approved.png');
                        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                        $data2 = file_get_contents($path2);
                        $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                    @endphp
                    @if ($pk->total_harga < 1000000)
                        <td style="{{$td.$bold.$text_center.$border_top_none.$border_bottom_none}} height:50px">
                            @if ($pk->ua && $pk->ua->hasRole('finance'))
                                <img src="{{ $base642 }}" style="height: 60px;width: auto;" >
                            @endif
                        </td>
                    @endif
                    <td style="{{$td.$bold.$text_center.$border_top_none.$border_bottom_none}} height:50px">
                        @if ($pk->ua && $pk->ua->hasRole('regional_manager'))
                            <img src="{{ $base642 }}" style="height: 60px;width: auto;" >
                        @endif
                    </td>
                    <td style="{{$td.$bold.$text_center.$border_top_none.$border_bottom_none}} height:50px">
                        @if ($pk->ua && $pk->ua->hasRole('general_manager'))
                            <img src="{{ $base642 }}" style="height: 60px;width: auto;" >
                        @endif
                    </td>
                </tr>
                <tr>
                    @if ($pk->total_harga < 1000000)
                        <td style="{{$td.$bold.$text_center.$border_top_none}}">(______________)</td>
                    @endif
                    <td style="{{$td.$bold.$text_center.$border_top_none}}">(______________)</td>
                    <td style="{{$td.$bold.$text_center.$border_top_none}}">(______________)</td>
                </tr>
            </tbody>
        </table>
    </footer>

    <table style="margin-bottom:15px; border-collapse: collapse; width: 100%; font-size:9px; font-family: 'Open Sans', sans-serif; color:black;">
        <tbody>
            <tr>
                <td style="text-align: center; font-weight:bold; font-size:20px;">
                    LEMBAR PERSETUJUAN
                </td>
            </tr>
        </tbody>
    </table>

    <table style="font-size: 13px;width: 100%;font-family: 'Open Sans', sans-serif; color:rgb(0, 0, 0);margin-left:20%; margin-top:5%">
        <tbody>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Nomor Pengajuan</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{{ $pk->nomor ?? '-' }}</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Nama Pegawai</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{{ $pk->user->name ?? '-' }}</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Divisi</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{{ $pk->user->Jabatan->nama_jabatan ?? '-' }}</td>
          </tr>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Tanggal</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
            <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">
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
          </tr>
          @foreach ($pk->items as $key => $item)
            <tr>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">ITEM {{ $key + 1 }}</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">
                    <table style="font-size: 13px;width: 100%;font-family: 'Open Sans', sans-serif; color:rgb(0, 0, 0);">
                        <tbody>
                            <tr>
                                <td style="width: 20%">Nama Barang</td>
                                <td style="width: 5%">=</td>
                                <td style="width: 75%">{{ $item->nama }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Qty</td>
                                <td style="width: 5%">=</td>
                                <td style="width: 75%">{{ $item->qty }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Harga</td>
                                <td style="width: 5%">=</td>
                                <td style="width: 75%">Rp {{ number_format($item->harga) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%">Total</td>
                                <td style="width: 5%">=</td>
                                <td style="width: 75%">Rp {{ number_format($item->total) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
          @endforeach
            <tr>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Total Pengajuan</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">Rp {{ number_format($pk->total_harga) }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Keterangan</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{!! $pk->keterangan ? nl2br(e($pk->keterangan)) : '-' !!}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">User Approval</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{{ $pk->ua->name ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; font-weight:bold; width:20%">Status</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:5%">:</td>
                <td style="padding-left: 10px; padding-right: 10px; padding-top:5px; vertical-align:top; width:75%">{!! $pk->status ? nl2br(e($pk->status)) : '-' !!}</td>
            </tr>
        </tbody>
      </table>

</body>
</html>
