<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung data dinamis dari database
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalOwner = User::where('role', 'owner')->count();
        
        $totalKostTerdaftar = Property::count();
        // Hitung kost yang butuh verifikasi (is_approved_by_admin = false)
        $butuhVerifikasiKost = Property::where('is_approved_by_admin', false)->count();

        return view('admin.dashboard', compact(
            'totalMahasiswa', 
            'totalOwner', 
            'totalKostTerdaftar', 
            'butuhVerifikasiKost'
        ));
    }
}