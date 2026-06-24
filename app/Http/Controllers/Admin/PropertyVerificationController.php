<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyVerificationController extends Controller
{
    public function index()
    {
        $pendingProperties = Property::with('owner')
            ->where('is_approved_by_admin', false)
            ->latest()
            ->get();

        return view('admin.properties.index', compact('pendingProperties'));
    }

    public function verify($id, Request $request)
    {
        $request->validate(['approve' => 'required|boolean']);
        $property = Property::findOrFail($id);
        
        if ($request->approve == '1') {
            $property->is_approved_by_admin = true;
            $property->save();
            $msg = 'Properti kost berhasil disetujui dan dipublikasikan!';
        } else {
            $property->delete();
            $msg = 'Pengajuan properti kost ditolak.';
        }

        return redirect()->route('admin.properties.index')->with('success', $msg);
    }
}