<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'durasi_sewa',
        'status',
    ];

    /**
     * Relasi: Booking ini diajukan oleh seorang Mahasiswa (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Booking ini ditujukan untuk properti kost tertentu
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}