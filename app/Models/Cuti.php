<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function ua()
    {
        return $this->belongsTo(User::class, 'user_approval');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
