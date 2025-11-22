<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanItem extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'penugasan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
