<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Booking; 
use App\Models\Survey; // <-- Pastikan import model Survey jika ada tabel survei
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->id();

        // 1. Ambil data booking milik mahasiswa beserta propertinya
        $bookings = Booking::where('user_id', $mahasiswaId)
            ->with('property')
            ->latest()
            ->take(5) 
            ->get();

        // 2. Hitung jumlah booking yang statusnya 'approved' dari data di atas
        $activeBookingsCount = Booking::where('user_id', $mahasiswaId)
            ->where('status', 'approved')
            ->count();

        // 3. Hitung jumlah agenda survei milik mahasiswa yang belum selesai (opsional)
        // Sesuaikan dengan nama model/tabel survei kamu jika ada
        $mySurveysCount = Survey::where('user_id', $mahasiswaId)->count(); 

        // 4. Kirim SEMUA variabel yang dibutuhkan Blade ke fungsi compact()
        return view('mahasiswa.dashboard', compact('bookings', 'activeBookingsCount', 'mySurveysCount'));
    }
}