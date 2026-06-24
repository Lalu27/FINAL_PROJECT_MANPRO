<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Booking; 
use Illuminate\Http\Request;
use App\Models\Property; // Pastikan model Property di-import di atas

class BookingController extends Controller
{
    /**
     * Menampilkan daftar semua riwayat booking mahasiswa terkait
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('property') 
            ->latest()
            ->get();

        return view('mahasiswa.bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        // Tangkap ID properti dari URL (?property_id=X)
        $propertyId = $request->query('property_id');
        
        // Cari data kostnya, jika tidak ada lempar error 404
        $property = Property::findOrFail($propertyId);

        // Tampilkan halaman form pemesanan
        return view('mahasiswa.bookings.create', compact('property'));
    }

    /**
     * 🌟 PERBAIKAN: Memproses penyimpanan data booking baru dari halaman detail kost
     */
    public function store(Request $request)
    {
        // A. Validasi data kiriman dari form detail properti
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'durasi_sewa' => 'required|integer|min:1',
        ]);

        // B. Simpan data transaksi ke database
        Booking::create([
            'user_id'     => auth()->id(), // Mahasiswa yang sedang login
            'property_id' => $request->property_id,
            'durasi_sewa' => $request->durasi_sewa,
            'status'      => 'pending', // Menunggu persetujuan owner kost
        ]);

        // C. Alihkan kembali ke halaman riwayat booking dengan alert sukses
        return redirect()->route('mahasiswa.bookings.index')
            ->with('success', 'Permintaan booking kost berhasil dikirim! Silakan tunggu konfirmasi pihak owner.');
    }
}