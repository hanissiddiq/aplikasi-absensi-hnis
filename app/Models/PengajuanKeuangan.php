<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKeuangan extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(PengajuanKeuanganItem::class, 'pengajuan_keuangan_id');
    }

    public function ua()
    {
        return $this->belongsTo(User::class, 'user_approval');
    }
}
