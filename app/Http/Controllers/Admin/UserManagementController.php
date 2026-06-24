<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna (Mahasiswa & Owner)
     */
    public function index()
    {
        // 🌟 POLAN: Saring agar akun Admin tidak ikut masuk daftar antrean hapus
        $users = User::where('role', '!=', 'admin')
                     ->latest()
                     ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menghapus akun pengguna dari sistem
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus dari sistem.');
    }
}