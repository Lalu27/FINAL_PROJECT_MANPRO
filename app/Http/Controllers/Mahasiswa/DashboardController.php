<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Booking; // Pastikan Model Booking sudah di-import di atas
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->id();

        // Ambil data booking milik mahasiswa yang sedang login beserta data propertinya
        $bookings = Booking::where('user_id', $mahasiswaId)
            ->with('property')
            ->latest()
            ->take(5) // Ambil 5 data terbaru saja untuk ringkasan di dashboard
            ->get();

        // Kirim variabel $bookings ke halaman view mahasiswa
        return view('mahasiswa.dashboard', compact('bookings'));
    }
}