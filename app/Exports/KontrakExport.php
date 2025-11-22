<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Kontrak;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class KontrakExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
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
            'Tanggal',
            'Jenis Kontrak',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Keterangan',
        ];
    }

    public function map($model): array
    {
        if ($model->tanggal) {
            Carbon::setLocale('id');
            $tanggal = Carbon::createFromFormat('Y-m-d', $model->tanggal);
            $new_tanggal = $tanggal->translatedFormat('d F Y');
        } else {
            $new_tanggal = '-';
        }

        if ($model->tanggal_mulai) {
            Carbon::setLocale('id');
            $tanggal_mulai = Carbon::createFromFormat('Y-m-d', $model->tanggal_mulai);
            $new_tanggal_mulai = $tanggal_mulai->translatedFormat('d F Y');
        } else {
            $new_tanggal_mulai = '-';
        }

        if ($model->tanggal_selesai) {
            Carbon::setLocale('id');
            $tanggal_selesai = Carbon::createFromFormat('Y-m-d', $model->tanggal_selesai);
            $new_tanggal_selesai = $tanggal_selesai->translatedFormat('d F Y');
        } else {
            $new_tanggal_selesai = '-';
        }

        return [
            $model->user->name ?? '-',
            $new_tanggal,
            $model->jenis_kontrak ?? '-',
            $new_tanggal_mulai,
            $new_tanggal_selesai,
            $model->keterangan ?? '-',
        ];


    }

    public function columnFormats(): array
    {
        return [

        ];
    }

    public function query()
    {
        date_default_timezone_set('Asia/Jakarta');
        $title = 'Kontrak Kerja';
        $nama = request()->input('nama');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $kontraks = Kontrak::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                $query->whereBetween('tanggal', [$mulai, $akhir]);
                            })
                            ->when($nama, function ($query) use ($nama) {
                                $query->whereHas('user', function ($q) use ($nama) {
                                    $q->where('name', 'LIKE', '%' . $nama . '%');
                                });
                            })
                            ->orderBy('tanggal', 'DESC');

        return $kontraks;
    }
}
