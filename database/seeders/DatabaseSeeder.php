<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Test untuk Admin
        User::create([
            'nama' => 'Admin StayFind',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'is_verified' => true,
            'foto_ktp_dokumen' => null,
        ]);

        // 2. Akun Test untuk Owner (Sudah Terverifikasi Admin)
        $ownerAktif = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'), 
            'role' => 'owner',
            'is_verified' => true, 
            'foto_ktp_dokumen' => 'verification_docs/seed_ktp_budi.jpg',
        ]);

        // 3. Akun Test untuk Owner Pending (Untuk testing menu persetujuan di Admin)
        User::create([
            'nama' => 'Ahmad Sulthon',
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'is_verified' => false, 
            'foto_ktp_dokumen' => 'verification_docs/seed_ktp_ahmad.jpg',
        ]);

        // 4. Akun Test untuk Mahasiswa (Pencari Kost)
        User::create([
            'nama' => 'Lalu Firman Syah',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'is_verified' => true, // Mahasiswa otomatis true sesuai logika AuthController kamu
            'foto_ktp_dokumen' => null,
        ]);


        // ====================================================================
        // DATA TAMBAHAN: PROPERTI KOST (Tautkan ke Owner Aktif: Budi Santoso)
        // ====================================================================

       // Kost 1
        Property::create([
            'user_id' => $ownerAktif->id,
            'nama_properti' => 'Kost StayFind Melati Eksklusif Depok',
            'harga_bulanan' => 1500000,
            'deskripsi' => 'Kost nyaman dekat kampus STT NF. Fasilitas lengkap AC, Wi-Fi, kasur, lemari.',
            'alamat' => 'Jl. Margonda Raya No. 45, Kecamatan Cimanggis, Kota Depok',
            'tipe_hunian' => 'putri', // 👈 Sesuai dengan UI barumu (Tag Pink)
            'is_approved_by_admin' => true,
        ]);

        // Kost 2
        Property::create([
            'user_id' => $ownerAktif->id,
            'nama_properti' => 'SinggahSini Kost Putra Margonda',
            'harga_bulanan' => 850000,
            'deskripsi' => 'Kost khusus pria/mahasiswa. Lingkungan tenang, sudah termasuk listrik.',
            'alamat' => 'Jl. Jalan Kapuk No. 12, Kelurahan Pondok Cina, Kota Depok',
            'tipe_hunian' => 'putra', // 👈 Sesuai dengan UI barumu (Tag Biru)
            'is_approved_by_admin' => true,
        ]);
    }
}