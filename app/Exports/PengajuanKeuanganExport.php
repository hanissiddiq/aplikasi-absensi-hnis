<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\PengajuanKeuangan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PengajuanKeuanganExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
{
    use Exportable;

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle("A1:" . $highestColumn . "1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setWrapText(true);

        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Nomor Pengajuan',
            'Nama Pegawai',
            'Tanggal',
            'Items',
            'Total Pengajuan',
            'Keterangan',
            'Status',
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

        $items = $model->items->map(function ($item) {
            return "Nama: {$item->nama}\nQty: {$item->qty}\nHarga: Rp " . number_format($item->harga, 0, ',', '.') . "\nTotal: Rp " . number_format($item->total, 0, ',', '.');
        })->implode("\n\n");

        return [
            $model->nomor ?? '-',
            $model->user->name ?? '-',
            $new_tanggal ?? '-',
            $items,
            'Rp ' . number_format($model->total_harga, 0, ',', '.'),
            $model->keterangan ?? '-',
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
        $search = request()->input('search');
        $status = request()->input('status');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $pk_id = request()->input('pk_id');

        $pengajuan_keuangans = PengajuanKeuangan::when($search, function ($query) use ($search) {
                                        $query->where('nomor', 'LIKE', '%' . $search . '%')
                                        ->whereHas('user', function ($q) use ($search) {
                                            $q->where('name', 'LIKE', '%' . $search . '%');
                                        });
                                    })
                                    ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                                    })
                                    ->when($status, function ($query) use ($status) {
                                        $query->where('status', $status);
                                    })
                                    ->when($pk_id, function ($query) use ($pk_id) {
                                        $query->where('id', $pk_id);
                                    })
                                    ->orderBy('id', 'DESC');

        return $pengajuan_keuangans;
    }
}
