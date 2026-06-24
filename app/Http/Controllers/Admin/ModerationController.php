<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review; // Pastikan model Review sudah di-import dengan benar
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    /**
     * Menampilkan halaman daftar ulasan untuk dimoderasi
     */
    public function index()
    {
        // 🌟 PERBAIKAN: Hanya ambil ulasan yang data User (mahasiswa) dan Property (kost)-nya MASIH ADA di DB
        $reviews = Review::with(['user', 'property'])
                         ->whereHas('user')
                         ->whereHas('property')
                         ->latest()
                         ->get();

        // Oper variabel $reviews ke dalam view admin
        return view('admin.moderation.index', compact('reviews'));
    }

    /**
     * Menyembunyikan ulasan yang melanggar aturan (Take Down)
     */
    public function hide($id)
    {
        $review = Review::findOrFail($id);
        
        // Eksekusi hapus data ulasan dari tabel reviews
        $review->delete(); 

        return redirect()->back()->with('success', 'Ulasan berhasil di-take down dari sistem!');
    }
}