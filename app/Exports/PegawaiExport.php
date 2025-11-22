<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PegawaiExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
{
    use Exportable;

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        //BORDER
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // HEADER
        $sheet->getStyle("A1:" . $highestColumn . "1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // WRAP TEXT
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setWrapText(true);

        // ALIGNMENT TEXT
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        //BOLD FIRST ROW
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Pegawai',
            'Username',
            'Email',
            'Nomor Handphone',
            'Lokasi Kantor',
            'Divisi',
            'Tanggal Lahir',
            'Gender',
            'Tanggal Masuk Perusahaan',
            'Status Pernikahan',
            'Nomor KTP',
            'Nomor Kartu Keluarga',
            'Nomor BPJS Kesehatan',
            'Nomor BPJS Ketenagakerjaan',
            'Nomor NPWP',
            'Nomor SIM',
            'Nomor PKWT',
            'Nomor Kontrak',
            'Tanggal Mulai PKWT',
            'Tanggal Berakhir PKWT',
            'Nomor Rekening',
            'Nama Pemilik Rekening',
            'Alamat',
            '-- CUTI & IZIN --',
            'Cuti',
            'Izin Masuk',
            'Izin Telat',
            'Izin Pulang Cepat',
            '-- PENJUMLAHAN GAJI --',
            'Gaji Pokok',
            'Makan & Transport',
            'Lembur',
            '100% Kehadiran',
            'THR',
            'Bonus Pribadi',
            'Bonus Team',
            'Bonus Jackpot',
            '-- PENGURANGAN GAJI --',
            'Izin',
            'Terlambat',
            'Mangkir',
            'Kasbon',
        ];
    }

    public function map($model): array
    {

        return [
            $model->name ?? '-',
            $model->username ?? '-',
            $model->email ?? '-',
            $model->telepon ?? '-',
            $model->Lokasi->nama_lokasi ?? '-',
            $model->Jabatan->nama_jabatan ?? '-',
            $model->tgl_lahir ?? '-',
            $model->gender ?? '-',
            $model->tgl_join ?? '-',
            $model->status_nikah ?? '-',
            $model->ktp ?? '-',
            $model->kartu_keluarga ?? '-',
            $model->bpjs_kesehatan ?? '-',
            $model->bpjs_ketenagakerjaan ?? '-',
            $model->npwp ?? '-',
            $model->sim ?? '-',
            $model->no_pkwt ?? '-',
            $model->no_kontrak ?? '-',
            $model->tanggal_mulai_pkwt ?? '-',
            $model->tanggal_berakhir_pkwt ?? '-',
            $model->rekening ?? '-',
            $model->nama_rekening ?? '-',
            $model->alamat ?? '-',
            '>>>',
            $model->izin_cuti . ' x' ?? '-',
            $model->izin_lainnya . ' x' ?? '-',
            $model->izin_telat . ' x' ?? '-',
            $model->izin_pulang_cepat . ' x' ?? '-',
            '>>>',
            'Rp ' . number_format($model->gaji_pokok, 0, ',', '.'),
            'Rp ' . number_format($model->makan_transport, 0, ',', '.'),
            'Rp ' . number_format($model->lembur, 0, ',', '.'),
            'Rp ' . number_format($model->kehadiran, 0, ',', '.'),
            'Rp ' . number_format($model->thr, 0, ',', '.'),
            'Rp ' . number_format($model->bonus_pribadi, 0, ',', '.'),
            'Rp ' . number_format($model->bonus_team, 0, ',', '.'),
            'Rp ' . number_format($model->bonus_jackpot, 0, ',', '.'),
            '>>>',
            'Rp ' . number_format($model->izin, 0, ',', '.'),
            'Rp ' . number_format($model->terlambat, 0, ',', '.'),
            'Rp ' . number_format($model->mangkir, 0, ',', '.'),
            'Rp ' . number_format($model->saldo_kasbon, 0, ',', '.'),
        ];


    }

    public function columnFormats(): array
    {
        return [

        ];
    }

    public function query()
    {
        $search = request()->input('search');
        $data = User::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                  ->orWhere('email', 'LIKE', '%'.$search.'%')
                  ->orWhere('telepon', 'LIKE', '%'.$search.'%')
                  ->orWhere('username', 'LIKE', '%'.$search.'%')
                  ->orWhereHas('Jabatan', function ($query) use ($search) {
                      $query->where('nama_jabatan', 'LIKE', '%'.$search.'%');
                  });
        })
        ->orderBy('name', 'ASC');

        return $data;
    }
}
