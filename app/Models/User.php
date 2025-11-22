<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function MappingShift()
    {
        return $this->hasMany(MappingShift::class);
    }

    public function dinasLuar()
    {
        return $this->hasMany(dinasLuar::class);
    }

    public function reimbursement()
    {
        return $this->hasMany(Reimbursement::class);
    }

    public function reimbursementItem()
    {
        return $this->hasMany(ReimbursementsItem::class);
    }

    public function Sip()
    {
        return $this->hasMany(Sip::class);
    }

    public function Lembur()
    {
        return $this->hasMany(Lembur::class);
    }

    public function Payroll()
    {
        return $this->hasMany(Payroll::class);
    }

    public function Pajak()
    {
        return $this->hasMany(Pajak::class);
    }

    public function Cuti()
    {
        return $this->hasMany(Cuti::class);
    }

    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function Lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function whatsapp($phoneNumber) {
        if (substr($phoneNumber, 0, 1) == '0') {
            return '62' . substr($phoneNumber, 1);
        }
        return $phoneNumber;
    }

    public function lastlk($id)
    {
        return LaporanKinerja::where('user_id', $id)->latest()->first();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
