<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_properti',
        'harga_bulanan',
        'deskripsi',
        'fasilitas',
        'alamat',
        'gambar',
        'tipe_hunian',
        'kamar_tersedia',
        'is_approved_by_admin',
    ];

    protected $casts = [
        'is_approved_by_admin' => 'boolean',
        'harga_bulanan' => 'integer',
    ];

    /**
     * Relasi: Properti ini dimiliki oleh seorang Owner (User)
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Properti ini bisa memiliki banyak riwayat booking sewa
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Relasi: Properti ini bisa memiliki banyak ulasan dari mahasiswa
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'property_id');
    }
}