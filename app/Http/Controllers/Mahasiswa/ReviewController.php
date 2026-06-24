<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Review;   // Model ulasan
use App\Models\Property; // 🌟 TAMBAHAN: Import Model Property/Kost
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan semua data riwayat ulasan milik mahasiswa yang login
     */
    public function index()
    {
        $reviews = Review::where('user_id', auth()->id())
            ->with('property') // Load data properti kost yang diulas
            ->latest()
            ->get();

        return view('mahasiswa.reviews.index', compact('reviews'));
    }

    /**
     * 🌟 TAMBAHAN BARU: Menampilkan formulir pembuatan ulasan (Halaman Terpisah)
     * Menangkap parameter ?property_id=... dari URL tombol Ulas
     */
    public function create(Request $request)
    {
        // Ambil property_id dari parameter URL
        $propertyId = $request->query('property_id');
        
        // Cari data kost terkait, jika tidak ada langsung lempar 404
        $property = Property::findOrFail($propertyId);

        // Mengarah ke file create.blade.php di folder mahasiswa/reviews
        return view('mahasiswa.reviews.create', compact('property'));
    }

    /**
     * Menyimpan data ulasan baru dari form ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input form ulasan
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating'      => 'required|integer|min:1|max:5',
            'komentar'    => 'required|string|min:5',
        ]);

        // 2. Simpan data review ke tabel database
        Review::create([
            'user_id'     => auth()->id(),
            'property_id' => $request->property_id,
            'rating'      => $request->rating,
            'komentar'    => $request->komentar,
            'is_approved_by_admin' => false, // Menunggu disetujui admin StayFind
        ]);

        // 3. 🌟 PERBAIKAN REDIRECT: Setelah sukses, arahkan kembali ke halaman riwayat booking
        return redirect()->route('mahasiswa.bookings.index')->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim dan menunggu persetujuan admin.');
    }
}