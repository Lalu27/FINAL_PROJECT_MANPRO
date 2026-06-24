<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'foto_ktp_dokumen',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean',
    ];

    /**
     * Relasi: Seorang Owner/User bisa memiliki banyak properti kost
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Relasi: Seorang Mahasiswa bisa memiliki banyak riwayat booking
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
}