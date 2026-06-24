<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'rating',
        'komentar',
    ];

    /**
     * Relasi: Ulasan ditulis oleh seorang Mahasiswa
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Ulasan ditujukan untuk properti kost tertentu
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}