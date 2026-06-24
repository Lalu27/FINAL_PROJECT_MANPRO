@extends('layouts.owner')

@section('title', 'StayFind Owner Dashboard')

@section('content')
<!-- Tambahan Pustaka Mikro-Interaksi & Animasi Halus (Sama persis di semua menu) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script id="tailwind-config">
    tailwind.config = { 
        theme: { 
            extend: { 
                "colors": { 
                    "primary": "#4648d4", 
                    "secondary": "#006c49", 
                    "background": "#f8f9ff" 
                } 
            } 
        } 
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<!-- 🌟 SINKRON: Menggunakan struktur dan efek pudar transisi yang identik dengan menu lainnya -->
<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-7xl mx-auto px-4 md:px-6 py-6 space-y-6">
        
        <!-- Welcome Section (Ukuran & Spacing Identik) -->
        <section class="py-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Halo, {{ Auth::user()->nama }} 👋</h2>
            <p class="text-sm text-gray-500 mt-1">Berikut adalah ringkasan manajemen hunian Anda hari ini.</p>
        </section>

        <!-- Stats Section: 4 Kolom Diselaraskan Total (Struktur, Radius, & Padding Sama) -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            
            <!-- Kartu 1: Total Properti -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100/70 flex flex-col gap-3 hover:shadow-md hover:scale-[1.01] transition-all duration-200">
                <div class="inline-flex p-2.5 bg-blue-50 text-blue-600 rounded-xl w-fit">
                    <span class="material-symbols-outlined text-2xl">apartment</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Properti</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $totalPropertiSaya ?? 0 }}</p>
                </div>
            </div>
            
            <!-- Kartu 2: Permintaan Booking -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100/70 flex flex-col gap-3 hover:shadow-md hover:scale-[1.01] transition-all duration-200">
                <div class="inline-flex p-2.5 bg-green-50 text-emerald-600 rounded-xl w-fit">
                    <span class="material-symbols-outlined text-2xl">receipt_long</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Permintaan Booking</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">
                        {{ \App\Models\Booking::whereIn('property_id', \App\Models\Property::where('user_id', auth()->id())->pluck('id'))->where('status', 'pending')->count() }}
                    </p>
                </div>
            </div>
            
            <!-- Kartu 3: Estimasi Omzet -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100/70 flex flex-col gap-3 hover:shadow-md hover:scale-[1.01] transition-all duration-200">
                <div class="inline-flex p-2.5 bg-indigo-50 text-indigo-600 rounded-xl w-fit">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Estimasi Omzet</p>
                    <p class="text-2xl font-black text-indigo-600 mt-1">
                        Rp {{ number_format(\App\Models\Property::where('user_id', auth()->id())->sum('harga_bulanan'), 0, ',', '.') }}
                    </p>
                </div>
            </div>
            
            <!-- Kartu 4: Total Unit Kost Terdaftar -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100/70 flex flex-col gap-3 hover:shadow-md hover:scale-[1.01] transition-all duration-200">
                <div class="inline-flex p-2.5 bg-red-50 text-red-500 rounded-xl w-fit">
                    <span class="material-symbols-outlined text-2xl">meeting_room</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kost Terdaftar</p>
                    <p class="text-2xl font-black text-red-600 mt-1">
                        {{ \App\Models\Property::where('user_id', auth()->id())->count() ?? 0 }} <span class="text-xs font-normal text-gray-400">Unit</span>
                    </p>
                </div>
            </div>

        </section>

        <!-- Aksi Cepat Manajemen Section -->
        <section class="mb-8">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Aksi Cepat Manajemen</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <a href="{{ route('owner.properties.create') }}" class="group bg-primary hover:bg-opacity-95 p-6 rounded-2xl text-white flex flex-col justify-end min-h-[140px] transition-all shadow-md shadow-indigo-100 hover:scale-[1.01] cursor-pointer">
                    <span class="material-symbols-outlined text-3xl mb-2 transition-transform group-hover:-translate-y-1">add_home</span>
                    <p class="text-lg font-bold tracking-tight">Tambah Kost Baru</p>
                </a>
                
                <a href="{{ route('owner.properties.index') }}" class="group bg-white border border-slate-200/60 p-6 rounded-2xl flex flex-col justify-end min-h-[140px] hover:bg-slate-50/80 transition-all hover:scale-[1.01] cursor-pointer">
                    <span class="material-symbols-outlined text-3xl text-primary mb-2 transition-transform group-hover:-translate-y-1">holiday_village</span>
                    <p class="text-lg font-bold text-gray-900 tracking-tight">Kelola Properti Saya</p>
                </a>

                <a href="https://wa.me/" target="_blank" class="group bg-white border border-slate-200/60 p-6 rounded-2xl flex flex-col justify-end min-h-[140px] hover:bg-slate-50/80 transition-all hover:scale-[1.01] cursor-pointer">
                    <span class="material-symbols-outlined text-3xl text-green-600 mb-2 transition-transform group-hover:scale-110">forum</span>
                    <p class="text-lg font-bold text-gray-900 tracking-tight">Hubungi Mahasiswa</p>
                </a>
                
            </div>
        </section>

    </main>
</div>
@endsection