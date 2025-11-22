<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapatNotulen extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function rapat()
    {
        return $this->belongsTo(Rapat::class, 'rapat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
