<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();
        $bookings = Booking::whereHas('property', function ($query) use ($ownerId) {
            $query->where('user_id', $ownerId);
        })->with(['user', 'property'])->latest()->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    // DISELARASKAN: Request ditaruh di depan agar form data terbaca dengan aman
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status pengajuan sewa berhasil diperbarui.');
    }
}