<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Survey; 
use App\Models\Property;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Menampilkan daftar semua riwayat pengajuan survei milik mahasiswa terkait
     */
    public function index()
    {
        $surveys = Survey::where('user_id', auth()->id())
            ->with('property') 
            ->latest()
            ->get();

        return view('mahasiswa.surveys.index', compact('surveys'));
    }

    /**
     * 🌟 TEMPATKAN DI SINI (1): Fungsi menampilkan halaman form input tanggal survei
     */
    public function create(Request $request)
    {
        // Tangkap parameter ID properti dari URL (?property_id=X)
        $propertyId = $request->query('property_id');
        
        // Cari data kostnya di database, jika tidak ada langsung lempar error 404
        $property = Property::findOrFail($propertyId);

        // Buka halaman form pengisian tanggal survei
        return view('mahasiswa.surveys.create', compact('property'));
    }

    /**
     * 🌟 TEMPATKAN DI SINI (2): Fungsi menyimpan data pengajuan survei ke database
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'property_id'    => 'required|exists:properties,id',
            'tanggal_survei' => 'required|date|after_or_equal:today', // Mengunci agar tidak bisa pilih tanggal kemarin
        ]);

        // Simpan ke tabel surveys
        Survey::create([
            'user_id'        => auth()->id(), // ID Mahasiswa yang sedang login
            'property_id'    => $request->property_id,
            'tanggal_survei' => $request->tanggal_survei,
            'status'         => 'pending', // Status awal pengajuan
        ]);

        // Alihkan kembali ke halaman indeks riwayat survei dengan alert sukses
        return redirect()->route('mahasiswa.surveys.index')
            ->with('success', 'Pengajuan jadwal survei lokasi berhasil dikirim! Silakan tunggu konfirmasi dari Owner.');
    }
}