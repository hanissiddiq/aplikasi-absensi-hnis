<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function pegawai()
    {
        return $this->hasMany(RapatPegawai::class, 'rapat_id');
    }

    public function notulen()
    {
        return $this->hasMany(RapatNotulen::class, 'rapat_id');
    }
}
