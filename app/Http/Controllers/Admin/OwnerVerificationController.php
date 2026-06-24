<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerVerificationController extends Controller
{
    public function index()
    {
        $pendingOwners = User::where('role', 'owner')
            ->where('is_verified', false)
            ->latest()
            ->get();

        return view('admin.owners.index', compact('pendingOwners'));
    }

    public function verify($id, Request $request)
    {
        $request->validate(['approve' => 'required|boolean']);
        $owner = User::findOrFail($id);

        if ($request->approve == '1') {
            $owner->is_verified = true;
            $owner->save();
            $msg = "Akun Owner '{$owner->nama}' berhasil disetujui!";
        } else {
            $owner->delete();
            $msg = "Pendaftaran akun Owner '{$owner->nama}' telah ditolak.";
        }

        return redirect()->route('admin.owners.index')->with('success', $msg);
    }
}