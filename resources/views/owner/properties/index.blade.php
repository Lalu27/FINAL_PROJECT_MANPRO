@extends('layouts.owner')
@section('title', 'Daftar Properti Hunian Anda')

@section('content')
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

<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-7xl mx-auto px-4 md:px-6 py-6 space-y-6">
        
        <section class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 py-4">
            <div class="space-y-1">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Daftar Properti Hunian Anda</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola dan pantau publikasi status operasional iklan kost Anda secara terpusat.</p>
            </div>
            <a href="{{ route('owner.properties.create') }}" class="w-fit px-4 py-2.5 bg-[#4648d4] hover:bg-opacity-95 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm shadow-indigo-100 flex items-center gap-2 duration-200 transition-all hover:scale-[1.01] cursor-pointer">
                <span class="material-symbols-outlined text-sm">add</span> Tambah Kost Baru
            </a>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($properties as $prop)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-md hover:scale-[1.01] transition-all duration-200">
                    
                    <div class="relative h-48 bg-slate-50 overflow-hidden w-full">
                        @if($prop->gambar)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $prop->gambar) }}" alt="{{ $prop->nama_properti }}"/>
                        @else
                            <img class="w-full h-full object-cover opacity-80" src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=500&q=80" alt="Placeholder StayFind"/>
                        @endif

                        <div class="absolute top-3 left-3">
                            @if($prop->is_approved_by_admin)
                                <span class="bg-green-50 text-green-700 border border-green-200/40 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm">Aktif / Publik</span>
                            @else
                                <span class="bg-amber-50 text-amber-700 border border-amber-200/40 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm animate-pulse">Pending Verifikasi</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between gap-4">
                        <div>
                            <span class="text-[9px] font-black text-[#4648d4] bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-widest">{{ $prop->tipe_hunian ?? 'Campur' }}</span>
                            <h4 class="font-extrabold text-base text-gray-900 mb-1 mt-2 tracking-tight truncate">{{ $prop->nama_properti }}</h4>
                            
                            <div class="flex items-start gap-1 text-gray-400 text-xs mt-1">
                                <span class="material-symbols-outlined text-sm text-[#4648d4] shrink-0 mt-0.5">location_on</span>
                                <span class="truncate max-w-full leading-relaxed">{{ $prop->alamat }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mt-2 pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider">Harga Bulanan</p>
                                <p class="font-black text-[#4648d4] text-base mt-0.5">
                                    Rp {{ number_format($prop->harga_bulanan, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal">/bln</span>
                                </p>
                            </div>
                            
                            <a href="{{ route('owner.properties.edit', $prop->id) }}" class="px-3 py-2 bg-slate-50 text-slate-700 hover:bg-[#4648d4] hover:text-white rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all duration-200 flex items-center gap-1 cursor-pointer">
                                <span class="material-symbols-outlined text-xs">edit</span> Kelola
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white text-center py-20 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full mb-3">
                        <span class="material-symbols-outlined text-3xl">holiday_village</span>
                    </div>
                    <p class="text-xs font-bold text-slate-400">Belum ada properti kost terdaftar atas nama akun Anda.</p>
                </div>
            @endforelse
        </section>

    </main>
</div>
@endsection