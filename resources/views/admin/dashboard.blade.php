@extends('layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-7xl mx-auto px-4 md:px-6 py-6 space-y-8">
        
        <section class="space-y-1 py-2">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Admin Dashboard Overview</h2>
            <p class="text-sm text-gray-500">Pantau ekosistem data digital platform StayFind secara real-time.</p>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-[#4648d4] rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Mahasiswa Aktif</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $totalMahasiswa }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">shield_person</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Total Owner</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $totalOwner }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">apartment</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Kost Terdaftar</p>
                    <p class="text-2xl font-black text-gray-900 mt-0.5">{{ $totalKostTerdaftar }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 {{ $butuhVerifikasiKost > 0 ? 'bg-red-50 text-red-600 animate-pulse' : 'bg-slate-50 text-slate-400' }} rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Butuh Verifikasi Kost</p>
                    <p class="text-2xl font-black {{ $butuhVerifikasiKost > 0 ? 'text-red-600' : 'text-gray-900' }} mt-0.5">{{ $butuhVerifikasiKost }}</p>
                </div>
            </div>
        </section>

        <section class="space-y-3">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Navigasi Verifikasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.owners.index') }}" class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.005] transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl">badge</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Verifikasi Akun Owner</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Setujui berkas pendaftaran data KTP para pemilik kost baru.</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-[#4648d4] group-hover:translate-x-1 transition-all">arrow_forward</span>
                </a>

                <a href="{{ route('admin.properties.index') }}" class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.005] transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl">holiday_village</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Verifikasi Pengajuan Kost</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Validasi kelayakan koordinat peta spasial dan fasilitas kamar kost.</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-[#4648d4] group-hover:translate-x-1 transition-all">arrow_forward</span>
                </a>
            </div>
        </section>

        <section class="space-y-3">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Navigasi Manajemen & Konten</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.users.index') }}" class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.005] transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl">manage_accounts</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Manajemen Pengguna Aplikasi</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Pantau daftar seluruh akun mahasiswa, owner, dan blokir akun mencurigakan.</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-[#4648d4] group-hover:translate-x-1 transition-all">arrow_forward</span>
                </a>

                <a href="{{ route('admin.moderation.index') }}" class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.005] transition-all flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl">rate_review</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-800">Moderasi Ulasan Kamar</h4>
                            <p class="text-xs text-slate-400 mt-0.5">Saring ulasan atau komentar kasar mahasiswa demi kenyamanan komunitas.</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-slate-300 group-hover:text-[#4648d4] group-hover:translate-x-1 transition-all">arrow_forward</span>
                </a>
            </div>
        </section>

    </main>
</div>
@endsection