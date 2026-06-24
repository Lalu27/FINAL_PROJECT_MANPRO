@extends('layouts.app')

@section('title', 'StayFind - Platform Cari Kost Mahasiswa STT NF Terbaik')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ activeFilter: 'semua', searchKeyword: '' }" class="bg-[#fcfdff] text-slate-800 antialiased overflow-x-hidden min-h-screen">
    
    <section class="max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative">
        <div class="lg:col-span-7 space-y-6 text-center md:text-left z-10 animate__animated animate__fadeInLeft">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100/80 text-[#004ac6] px-4 py-1.5 rounded-full text-xs font-bold tracking-wide">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#004ac6]"></span>
                </span>
                Khusus Mahasiswa STT Terpadu Nurul Fikri
            </div>

            <h1 class="text-4xl md:text-6xl font-black tracking-tight text-slate-900 leading-[1.1]">
                Mulai Perjalanan <br/>
                Akademikmu dari <br/>
                <span class="bg-gradient-to-r from-[#004ac6] via-blue-600 to-indigo-600 bg-clip-text text-transparent">Kost Terbaik.</span>
            </h1>
            
            <p class="text-sm md:text-base text-slate-500 max-w-lg font-medium leading-relaxed">
                Platform pencarian hunian kos terverifikasi, aman, dan strategis di sekitar lingkungan kampus STT NF dengan penawaran harga terbaik.
            </p>
            
            <div class="bg-white p-2.5 rounded-2xl shadow-xl shadow-blue-900/[0.04] border border-slate-100/80 flex flex-col sm:flex-row items-center gap-2 focus-within:ring-4 focus-within:ring-blue-100 transition-all duration-300">
                <div class="flex items-center flex-1 w-full px-3 gap-3">
                    <span class="material-symbols-outlined text-[#004ac6] text-xl font-bold">search</span>
                    <input x-model="searchKeyword" class="w-full bg-transparent border-none text-xs font-semibold py-3 text-slate-700 outline-none placeholder:text-slate-400" placeholder="Ketik nama area, alamat, atau fasilitas kost..." type="text"/>
                </div>
                <button type="button" class="w-full sm:w-auto bg-[#004ac6] hover:bg-[#003bb0] text-white px-8 py-3.5 rounded-xl text-xs font-extrabold uppercase tracking-widest active:scale-95 duration-200 transition-all shadow-lg shadow-blue-200 cursor-pointer whitespace-nowrap">
                    Temukan Unit
                </button>
            </div>
        </div>

        <div class="lg:col-span-5 relative hidden lg:flex justify-center items-center h-[400px] animate__animated animate__fadeInRight">
            <div class="absolute w-72 h-72 bg-gradient-to-tr from-blue-600 to-indigo-500 rounded-3xl rotate-12 opacity-80 shadow-2xl shadow-blue-500/30 overflow-hidden flex items-center justify-center group">
                <span class="material-symbols-outlined text-white text-8xl opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-500">night_shelter</span>
            </div>
            <div class="absolute w-64 h-64 bg-white/40 backdrop-blur-md rounded-3xl -rotate-12 border border-white/60 shadow-xl flex flex-col justify-between p-6">
                <div class="flex justify-between items-start">
                    <span class="bg-blue-500 text-white p-2.5 rounded-xl material-symbols-outlined text-lg shadow-md shadow-blue-200">local_fire_department</span>
                    <span class="text-[10px] font-black uppercase tracking-wider text-green-600 bg-green-50 px-2 py-1 rounded-md">Terverifikasi</span>
                </div>
                <div>
                    <h4 class="font-black text-slate-800 text-sm">Kost Eksklusif Depok</h4>
                    <p class="text-[10px] text-slate-400 font-bold mt-0.5">5 Menit dari Kampus B STT NF</p>
                </div>
            </div>
            <div class="absolute -bottom-10 right-10 w-32 h-32 bg-indigo-100 rounded-full blur-2xl -z-10 animate-pulse"></div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 mb-16 animate__animated animate__fadeInUp">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-[11px] font-black tracking-widest uppercase text-slate-400">Pencarian Berdasarkan Wilayah</h3>
            <!-- Tombol reset muncul otomatis hanya jika filter wilayah sedang aktif -->
            <button x-show="searchKeyword !== ''" @click="searchKeyword = ''" class="text-[11px] font-bold text-red-500 hover:text-red-600 flex items-center gap-0.5 transition-all cursor-pointer">
                <span class="material-symbols-outlined text-xs">close</span> Bersihkan Filter
            </button>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div @click="searchKeyword = 'Srengseng Sawah'" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg group-hover:bg-white transition-colors">domain</span>
                <div>
                    <h5 class="text-xs font-bold text-slate-800">Srengseng Sawah</h5>
                    <p class="text-[10px] font-medium text-slate-400">Dekat Kampus A</p>
                </div>
            </div>
            <div @click="searchKeyword = 'Kelapa Dua'" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                <span class="material-symbols-outlined text-purple-500 bg-purple-50 p-2 rounded-lg group-hover:bg-white transition-colors">holiday_village</span>
                <div>
                    <h5 class="text-xs font-bold text-slate-800">Kelapa Dua</h5>
                    <p class="text-[10px] font-medium text-slate-400">Akses Cepat & Strategis</p>
                </div>
            </div>
            <div @click="searchKeyword = 'Margonda'" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg group-hover:bg-white transition-colors">storefront</span>
                <div>
                    <h5 class="text-xs font-bold text-slate-800">Margonda Raya</h5>
                    <p class="text-[10px] font-medium text-slate-400">Pusat Kuliner & Kafe</p>
                </div>
            </div>
            <div @click="searchKeyword = 'Lenteng Agung'" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                <span class="material-symbols-outlined text-emerald-500 bg-emerald-50 p-2 rounded-lg group-hover:bg-white transition-colors">train</span>
                <div>
                    <h5 class="text-xs font-bold text-slate-800">Lenteng Agung</h5>
                    <p class="text-[10px] font-medium text-slate-400">Dekat Stasiun KRL</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 max-w-7xl mx-auto mb-10">
        <div class="flex items-center gap-2.5 overflow-x-auto pb-2 border-b border-slate-100">
            <button @click="activeFilter = 'semua'" :class="activeFilter === 'semua' ? 'bg-[#004ac6] text-white shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50'" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 cursor-pointer">
                <span class="material-symbols-outlined text-base">grid_view</span> Semua Tipe Kost
            </button>
            <button @click="activeFilter = 'Putra'" :class="activeFilter === 'Putra' ? 'bg-[#004ac6] text-white shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider cursor-pointer">
                👨‍🎓 Khusus Putra
            </button>
            <button @click="activeFilter = 'Putri'" :class="activeFilter === 'Putri' ? 'bg-[#004ac6] text-white shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider cursor-pointer">
                👩‍🎓 Khusus Putri
            </button>
            <button @click="activeFilter = 'Campur'" :class="activeFilter === 'Campur' ? 'bg-[#004ac6] text-white shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50'" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider cursor-pointer">
                👫 Kost Campur
            </button>
        </div>
    </section>

    <section class="px-6 max-w-7xl mx-auto pb-24">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Rekomendasi Kost Terpopuler</h2>
                <p class="text-xs text-slate-400 font-medium">Hunian berfasilitas lengkap dengan ulasan rating tinggi oleh mahasiswa.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($featuredProperties ?? $properties ?? [] as $property)
                <div x-show="(activeFilter === 'semua' || activeFilter.toLowerCase() === '{{ strtolower($property->tipe_hunian) }}') && ('{{ strtolower($property->nama_properti) }}'.includes(searchKeyword.toLowerCase()) || '{{ strtolower($property->alamat) }}'.includes(searchKeyword.toLowerCase()) || '{{ strtolower($property->fasilitas) }}'.includes(searchKeyword.toLowerCase()))"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100/80 hover:shadow-xl hover:shadow-blue-900/[0.03] hover:scale-[1.01] transition-all duration-300 flex flex-col h-full relative">
                    
                    <div class="relative h-48 overflow-hidden bg-slate-50 shrink-0">
                        @if($property->gambar)
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $property->gambar) }}" alt="{{ $property->nama_properti }}"/>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-1">
                                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'wght' 100;">bed</span>
                                <span class="text-[9px] uppercase font-black tracking-wider">No Photo</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-3 left-3 right-3 flex justify-between items-center">
                            <span class="bg-red-500 text-white px-2.5 py-1 rounded-lg font-black text-[9px] uppercase tracking-wider shadow-sm">
                                Sisa {{ $property->kamar_tersedia ?? 2 }} Kamar
                            </span>
                            <button x-data="{ liked: false }" @click="liked = !liked" :class="liked ? 'text-red-500 scale-110' : 'text-slate-600'" class="bg-white/90 backdrop-blur-md p-1.5 rounded-lg hover:bg-white shadow-sm transition-all cursor-pointer flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm" :style="liked && 'font-variation-settings: \'FILL\' 1;'">favorite</span>
                            </button>
                        </div>

                        <div class="absolute bottom-3 left-3">
                            @if($property->tipe_hunian === 'Putri')
                                <span class="bg-pink-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Putri</span>
                            @elseif($property->tipe_hunian === 'Putra')
                                <span class="bg-blue-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Putra</span>
                            @else
                                <span class="bg-purple-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Campur</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 flex flex-col flex-grow justify-between gap-4">
                        <div class="space-y-2">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-sm text-slate-800 leading-snug line-clamp-1 group-hover:text-[#004ac6] transition-colors">
                                    {{ $property->nama_properti }}
                                </h3>
                                <div class="flex items-center gap-0.5 bg-amber-50 border border-amber-100/50 px-1.5 py-0.5 rounded-md text-amber-700 font-bold shrink-0">
                                    <span class="material-symbols-outlined text-[11px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-[9px] font-black">4.9</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-1 text-slate-400">
                                <span class="material-symbols-outlined text-xs text-[#004ac6]">location_on</span>
                                <span class="text-[11px] line-clamp-1 font-medium text-slate-500">{{ $property->alamat }}</span>
                            </div>

                            <div class="flex items-center gap-3 pt-1 text-slate-400">
                                <div class="flex items-center gap-1" title="Wifi Gratis">
                                    <span class="material-symbols-outlined text-sm">wifi</span>
                                    <span class="text-[9px] font-bold text-slate-500">Free Wifi</span>
                                </div>
                                <div class="flex items-center gap-1" title="Kamar Mandi Dalam">
                                    <span class="material-symbols-outlined text-sm">shower</span>
                                    <span class="text-[9px] font-bold text-slate-500">KM Dalam</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-3 border-t border-slate-50 shrink-0">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Harga Sewa</span>
                                <span class="text-sm font-black text-[#004ac6]">Rp {{ number_format($property->harga_bulanan, 0, ',', '.') }}<span class="text-[10px] font-normal text-slate-400">/bln</span></span>
                            </div>
                            
                            <div>
                                <a href="{{ route('mahasiswa.show', $property->id) }}" class="bg-primary text-on-primary text-[10px] font-black px-3 py-2 rounded-xl text-center block duration-200 transition-all">
                                    Lihat Unit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center p-16 text-xs font-bold text-slate-400 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    Belum ada properti kos terverifikasi yang tersedia saat ini.
                </div>
            @endforelse
        </div>
    </section>

</div>

<style>
    .animate-blob { animation: blob 8s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    @keyframes blob {
        0%, 100% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(40px, -30px) scale(1.05); }
        66% { transform: translate(-20px, 30px) scale(0.95); }
    }
</style>
@endsection