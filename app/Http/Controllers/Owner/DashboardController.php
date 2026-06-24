<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Tampilan Utama Dashboard Space Kerja Owner
     */
    public function index()
    {
        $ownerId = auth()->id();

        // Mengambil statistik data dinamis khusus milik owner yang sedang login
        $totalPropertiSaya = Property::where('user_id', $ownerId)->count();
        $totalBookingMasuk = Booking::whereHas('property', function ($query) use ($ownerId) {
            $query->where('user_id', $ownerId);
        })->count();

        return view('owner.dashboard', compact('totalPropertiSaya', 'totalBookingMasuk'));
    }
}