<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();

        // 1. Ambil semua ID properti milik owner yang sedang login
        $propertyIds = Property::where('user_id', $ownerId)->pluck('id');

        // 2. Ambil semua riwayat booking yang sudah disetujui (Approved) untuk laporan keuangan
        $financialBookings = Booking::whereIn('property_id', $propertyIds)
            ->where('status', 'approved')
            ->with(['user', 'property'])
            ->latest()
            ->get();

        // 3. Hitung akumulasi total pendapatan bersih dari kalkulasi (harga_bulanan * durasi_sewa)
        $totalPendapatan = 0;
        foreach ($financialBookings as $book) {
            $harga = $book->property->harga_bulanan ?? 0;
            $durasi = $book->durasi_sewa ?? 1;
            $totalPendapatan += ($harga * $durasi);
        }

        return view('owner.reports.index', compact('financialBookings', 'totalPendapatan'));
    }
}