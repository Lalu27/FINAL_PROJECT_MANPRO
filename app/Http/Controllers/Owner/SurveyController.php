<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request; // 🌟 Memastikan Request sudah ter-import

class SurveyController extends Controller
{
    public function index()
    {
        $ownerId = auth()->id();
        $surveys = Survey::whereHas('property', function ($query) use ($ownerId) {
            $query->where('user_id', $ownerId);
        })->with(['user', 'property'])->latest()->get();

        return view('owner.surveys.index', compact('surveys'));
    }

    /**
     * 🌟 TARUH DI SINI: Fitur konfirmasi status survei (Terima/Tolak) oleh Owner
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. Validasi status harus approved atau rejected
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        // 2. Cari data survei berdasarkan ID
        $survey = Survey::findOrFail($id);
        
        // 3. Update status ke database
        $survey->update([
            'status' => $request->status
        ]);

        // 4. Redirect kembali ke halaman index dengan alert sukses
        return redirect()->route('owner.surveys.index')
            ->with('success', 'Status pengajuan survei berhasil diperbarui!');
    }
}