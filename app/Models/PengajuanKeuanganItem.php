<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKeuanganItem extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function pk()
    {
        return $this->belongsTo(PengajuanKeuangan::class, 'pengajuan_keuangan_id');
    }
}
