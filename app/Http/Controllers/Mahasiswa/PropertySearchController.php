<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertySearchController extends Controller
{
    /**
     * Tampilan Publik Landing Page Utama (Akses Tanpa Login)
     */
    public function landing()
    {
        $featuredProperties = Property::where('is_approved_by_admin', true)
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('featuredProperties'));
    }

    /**
     * Fitur Pencarian & Filtrasi Kost Kamar (Akses Tanpa Login)
     */
    public function index(Request $request)
    {
        $query = Property::where('is_approved_by_admin', true);

        // 1. Fitur pencarian berdasarkan keyword nama/alamat jika diisi mahasiswa
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama_properti', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        // 🌟 2. PERBAIKAN UTAMA: Tambahkan logika filter tipe kost di sini
        if ($request->has('tipe') && $request->tipe != 'all') {
            $tipe = $request->tipe;
            $query->where(function($q) use ($tipe) {
                // Mencocokkan format huruf kecil (putra) maupun kapital (Putra) di database
                $q->where('tipe_hunian', $tipe)
                  ->orWhere('tipe_hunian', ucfirst($tipe));
            });
        }

        // Jalankan pagination bawaan kamu
        $properties = $query->latest()->paginate(9);
        return view('mahasiswa.properties.index', compact('properties'));
    }

    /**
     * Menampilkan profil informasi detail kamar kost secara lengkap
     */
    public function show($id)
    {
        // 🌟 PERBAIKAN: Tambahkan with('reviews') agar data ulasan ikut ditarik secara efisien
        $property = Property::where('is_approved_by_admin', true)
            ->with('reviews')
            ->findOrFail($id);
            
        return view('public.show', compact('property'));
    }
}