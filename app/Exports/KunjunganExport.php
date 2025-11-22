<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kunjungan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class KunjunganExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
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
            'Nama',
            'Tanggal',
            'Visit In',
            'Keterangan (In)',
            'Visit Out',
            'Keterangan (Out)',
            'Status',
        ];
    }

    public function map($model): array
    {
        if ($model->visit_in) {
            setlocale(LC_TIME, 'id_ID.UTF-8');
            $visit_in = Carbon::createFromFormat('Y-m-d H:i:s', $model->visit_in);
            $new_visit_in = $visit_in->locale('id')->isoFormat('dddd, D MMM YYYY HH:mm:ss');
        } else {
            $new_visit_in = '-';
        }

        if ($model->visit_out) {
            setlocale(LC_TIME, 'id_ID.UTF-8');
            $visit_out = Carbon::createFromFormat('Y-m-d H:i:s', $model->visit_out);
            $new_visit_out = $visit_out->locale('id')->isoFormat('dddd, D MMM YYYY HH:mm:ss');
        } else {
            $new_visit_out = '-';
        }
        
        return [
            $model->user->name ?? '-',
            $model->tanggal ?? '-',
            $new_visit_in,
            $model->keterangan_in ?? '-',
            $new_visit_out,
            $model->keterangan_out ?? '-',
            $model->status ?? '-',
        ];


    }

    public function columnFormats(): array
    {
        return [

        ];
    }

    public function query()
    {
        
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $user_id = request()->input('user_id');
        $users = User::orderBy('name')->get();
        $kunjungan = Kunjungan::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                    })
                    ->when($user_id, function ($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    })
                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->orderBy('tanggal', 'DESC');

        return $kunjungan;
    }
}
