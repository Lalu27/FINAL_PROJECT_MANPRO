<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyViewController extends Controller
{
    public function index(Request $request)
    {
        // Koordinat default kampus (Contoh: STT NF Jakarta)
        $campusLat = $request->input('latitude', -6.3529); 
        $campusLong = $request->input('longitude', 106.8327);
        $radiusKm = $request->input('radius', 5); // Default radius pencarian 5 KM

        $query = Property::where('is_approved_by_admin', true);

        // Filter Spasial: Hitung jarak dari titik koordinat kos ke koordinat kampus
        // Modifikasi baris select di PropertyViewController.php bagian index:
        $query->select('*')
            ->selectRaw("ST_X(koordinat) as longitude")
            ->selectRaw("ST_Y(koordinat) as latitude")
            ->selectRaw("ST_Distance_Sphere(koordinat, ST_GeomFromText(?, 4326)) / 1000 AS jarak_km", ["POINT($campusLong $campusLat)"])
            ->having('jarak_km', '<=', $radiusKm);

        // Filter Rentang Harga
        if ($request->filled('harga_min')) {
            $query->where('harga_per_bulan', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga_per_bulan', '<=', $request->harga_max);
        }

        // Filter Tipe Hunian (putra/putri/campur)
        if ($request->filled('tipe_hunian')) {
            $query->where('tipe_hunian', $request->tipe_hunian);
        }

        $properties = $query->orderBy('jarak_km', 'asc')->get();

        return view('mahasiswa.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('mahasiswa.detail', compact('property'));
    }
}