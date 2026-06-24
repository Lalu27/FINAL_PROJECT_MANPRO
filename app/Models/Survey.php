<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'tanggal_survei',
        'status',
    ];

    protected $casts = [
        'tanggal_survei' => 'date',
    ];

    /**
     * Relasi: Survei diajukan oleh calon penyewa (Mahasiswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Survei ditujukan ke lokasi kost tertentu
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}