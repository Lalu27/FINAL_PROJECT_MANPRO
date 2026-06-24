<?php

namespace App\Services;

use App\Models\Property;

class PropertyService
{
    public function createProperty(array $data, int $ownerId): Property
    {
        return Property::create([
            'user_id' => $ownerId,
            'nama_properti' => $data['nama_properti'],
            'harga_bulanan' => $data['harga_bulanan'],
            'deskripsi' => $data['deskripsi'],
            'alamat' => $data['alamat'],
            'is_approved_by_admin' => false,
        ]);
    }
}