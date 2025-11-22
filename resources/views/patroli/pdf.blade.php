
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        body {
          font-family: Arial, sans-serif;
        }
        .container {
          max-width: 800px;
          margin: 0 auto;
        }
        .header {
          font-size: 20px;
          font-weight: bold;
          margin-bottom: 20px;
        }
      </style>
</head>
<body>
    @php
        $settings = App\Models\settings::first();
        $logo_path = storage_path('app/public/' . $settings->logo);
        if (file_exists($logo_path)) {
            $logo_mime = mime_content_type($logo_path);
            $logo_data = base64_encode(file_get_contents($logo_path));
        } else {
            $logo_mime = null;
            $logo_data = null;
        }
    @endphp
    <div class="container">
        @if($logo_data)
            <img src="data:{{ $logo_mime }};base64,{{ $logo_data }}" style="width: 80px; float:right">
        @endif
        <h3 style="text-transform: uppercase;">{{ $settings->name }}</h3>
        <span style="font-size: 10px; color:rgb(112, 112, 112);">{{ $settings->alamat }}</span>
        <br>
        <span style="font-size: 10px; color:rgb(112, 112, 112);">{{ $settings->email }} - {{ $settings->phone }}</span>
        <hr>
        <center>
        <div class="header">{{ $title }}</div>
        </center>


        <table style="border-collapse: collapse; width: 100%; font-size: 8px;">
            <thead>
                <tr>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;background-color:rgb(233, 233, 233);">Nama Pegawai</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;background-color:rgb(233, 233, 233);">Lokasi</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;background-color:rgb(233, 233, 233);">Tanggal</td>
                    <td style="border: 1px solid black; padding: 8px; text-align: center; font-weight: bold; text-transform: uppercase;background-color:rgb(233, 233, 233);">Jam</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($patroli as $pat)
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">{{ $pat->user->name ?? '-' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $pat->lokasi->nama_lokasi ?? '-' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">
                            @if ($pat->tanggal)
                                @php
                                    Carbon\Carbon::setLocale('id');
                                    $tanggal = Carbon\Carbon::createFromFormat('Y-m-d', $pat->tanggal);
                                    $new_tanggal = $tanggal->translatedFormat('d F Y');
                                @endphp
                                {{ $new_tanggal  }}
                            @else
                                -
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $pat->jam ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
</html>
