@extends('layouts.app')
@section('title', $property->nama_properti . ' - StayFind')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-[#fcfdff] min-h-screen pb-24 animate__animated animate__fadeIn" x-data="{ copied: false, alamatText: @json($property->alamat) }">
    <div class="max-w-7xl mx-auto px-4 md:px-8 pt-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-[11px] font-black tracking-widest text-[#004ac6] bg-blue-50/60 hover:bg-blue-100 border border-blue-100/50 px-4 py-2 rounded-xl transition-all group uppercase">
            <span class="material-symbols-outlined text-xs font-bold transition-transform group-hover:-translate-x-1">arrow_back</span> 
            Kembali Ke Daftar Kost
        </a>
    </div>

    <main class="max-w-7xl mx-auto px-4 md:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden h-[28rem] md:h-[34rem] relative group">
                    @if($property->gambar)
                        <img class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105" src="{{ asset('storage/' . $property->gambar) }}" alt="{{ $property->nama_properti }}"/>
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 text-slate-300 gap-2">
                            <span class="material-symbols-outlined text-7xl" style="font-variation-settings: 'wght' 100;">bed</span>
                            <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Belum ada foto hunian</span>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>

                    <div class="absolute top-4 left-4">
                        @if(strtolower($property->tipe_hunian) === 'putri')
                            <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-pink-500/20">Kost Putri</span>
                        @elseif(strtolower($property->tipe_hunian) === 'putra')
                            <span class="bg-gradient-to-r from-full via-[#004ac6] to-blue-500 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-500/20">Kost Putra</span>
                        @else
                            <span class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-purple-500/20">Kost Campur</span>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div class="space-y-2">
                            <h2 class="text-xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight">{{ $property->nama_properti }}</h2>
                            
                            <div @click="navigator.clipboard.writeText(alamatText); copied = true; setTimeout(() => copied = false, 2000)"
                                 class="flex items-center gap-1.5 text-slate-500 text-xs cursor-pointer hover:text-primary transition-colors group bg-slate-50 py-1.5 px-3 rounded-lg w-fit border border-slate-100 selection:bg-transparent">
                                <span class="material-symbols-outlined text-sm text-[#004ac6]">location_on</span>
                                <span class="font-semibold leading-relaxed" x-text="copied ? 'Alamat Berhasil Disalin!' : alamatText">{{ $property->alamat }}</span>
                                <span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-opacity">content_copy</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200/50 px-4 py-2 rounded-xl font-black text-sm shrink-0 shadow-sm">
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span>
                                @if($property->reviews && $property->reviews->count() > 0)
                                    {{ number_format($property->reviews->avg('rating'), 1) }}
                                @else
                                    0.0
                                @endif
                                <span class="text-[10px] text-amber-500 font-bold">/ 5.0</span>
                            </span>
                        </div>
                    </div>

                    <hr class="border-slate-100">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-100 flex items-center gap-3">
                            <span class="material-symbols-outlined text-2xl text-[#004ac6] bg-blue-100/50 p-2 rounded-xl">square_foot</span>
                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider">Dimensi Luas</p>
                                <p class="font-extrabold text-slate-800 mt-0.5">3 x 4 Meter</p>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-100 flex items-center gap-3">
                            <span class="material-symbols-outlined text-2xl text-amber-600 bg-amber-100/40 p-2 rounded-xl">bolt</span>
                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider">Biaya Listrik</p>
                                <p class="font-extrabold text-slate-800 mt-0.5">{{ Str::contains(Str::lower($property->deskripsi), 'listrik') ? 'Include Sewa' : 'Token Mandiri' }}</p>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-100 flex items-center gap-3">
                            <span class="material-symbols-outlined text-2xl text-emerald-600 bg-emerald-100/40 p-2 rounded-xl">check_box</span>
                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-wider">Status Kamar</p>
                                <p class="font-extrabold text-emerald-600 mt-0.5">Ready Unit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-3">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">description</span> Deskripsi Lengkap Hunian
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-medium bg-slate-50/50 p-4 rounded-2xl border border-slate-50">
                        {{ $property->deskripsi }}
                    </p>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">apps</span> Fasilitas Terintegrasi
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs text-slate-700 font-bold">
                        @if($property->fasilitas)
                            @foreach(explode(',', $property->fasilitas) as $item)
                                @php $facilityName = trim($item); @endphp
                                <div class="flex items-center gap-2.5 p-3 bg-white border border-slate-100 rounded-xl hover:border-primary/20 hover:bg-slate-50/30 transition-all duration-200">
                                    @if(Str::contains(Str::lower($facilityName), 'ac'))
                                        <span class="material-symbols-outlined text-base text-blue-500 bg-blue-50 p-1.5 rounded-lg">ac_unit</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'wi-fi') || Str::contains(Str::lower($facilityName), 'wifi'))
                                        <span class="material-symbols-outlined text-base text-indigo-500 bg-indigo-50 p-1.5 rounded-lg">wifi</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'mandi') || Str::contains(Str::lower($facilityName), 'wc'))
                                        <span class="material-symbols-outlined text-base text-cyan-500 bg-cyan-50 p-1.5 rounded-lg">shower</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'kasur') || Str::contains(Str::lower($facilityName), 'tidur') || Str::contains(Str::lower($facilityName), 'bed'))
                                        <span class="material-symbols-outlined text-base text-amber-500 bg-amber-50 p-1.5 rounded-lg">bed</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'parker') || Str::contains(Str::lower($facilityName), 'parkir'))
                                        <span class="material-symbols-outlined text-base text-emerald-500 bg-emerald-50 p-1.5 rounded-lg">local_parking</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'dapur'))
                                        <span class="material-symbols-outlined text-base text-orange-500 bg-orange-50 p-1.5 rounded-lg">kitchen</span>
                                    @elseif(Str::contains(Str::lower($facilityName), 'lemari'))
                                        <span class="material-symbols-outlined text-base text-purple-500 bg-purple-50 p-1.5 rounded-lg">wardrobe</span>
                                    @else
                                        <span class="material-symbols-outlined text-base text-slate-500 bg-slate-50 p-1.5 rounded-lg">check_circle</span>
                                    @endif
                                    <span class="text-slate-700 text-[11px] font-extrabold">{{ $facilityName }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-xs text-slate-400 font-medium italic col-span-full">Info fasilitas hubungi langsung owner.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">rate_review</span> Suara Penghuni Kost ({{ $property->reviews ? $property->reviews->count() : 0 }} Ulasan)
                        </h3>
                    </div>

                    <div class="space-y-4">
                        @forelse($property->reviews ?? [] as $review)
                            <div class="p-4 bg-slate-50/60 rounded-2xl border border-slate-100 space-y-2.5 transition-all hover:bg-slate-50">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-primary/10 text-primary font-black text-[10px] flex items-center justify-center uppercase">
                                            {{ substr($review->user->name ?? 'M', 0, 2) }}
                                        </div>
                                        <div>
                                            <h5 class="text-xs font-bold text-slate-800">{{ $review->user->name ?? 'Mahasiswa StayFind' }}</h5>
                                            <p class="text-[9px] text-slate-400 font-medium">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-0.5 text-amber-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? '1' : '0' }};">star</span>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 font-medium leading-relaxed pl-9">
                                    "{{ $review->komentar }}"
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                                <span class="material-symbols-outlined text-3xl text-slate-300">chat_bubble</span>
                                <p class="text-[11px] font-bold text-slate-400 mt-1">Belum ada ulasan testimoni tertulis untuk kost ini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="lg:col-span-4 lg:sticky lg:top-24 space-y-4">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 space-y-5 backdrop-blur-md">
                    <div>
                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Investasi Hunian</span>
                        <p class="text-3xl font-black text-[#004ac6] mt-1 tracking-tight">
                            Rp {{ number_format($property->harga_bulanan, 0, ',', '.') }}<span class="text-xs font-normal text-slate-400"> / bulan</span>
                        </p>
                    </div>

                    <hr class="border-slate-50">

                    <div class="flex flex-col gap-2.5">
                        @auth
                            @if(auth()->user()->role === 'mahasiswa')
                                <a href="{{ route('mahasiswa.bookings.create', ['property_id' => $property->id]) }}" 
                                   class="w-full py-3.5 bg-[#004ac6] hover:bg-blue-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-lg shadow-blue-100 transition-all text-center flex items-center justify-center gap-2 active:scale-[0.98]">
                                    <span class="material-symbols-outlined text-base">bolt</span> Pesan Unit Sekarang
                                </a>

                                <a href="{{ route('mahasiswa.surveys.create', ['property_id' => $property->id]) }}" 
                                   class="w-full py-3.5 bg-slate-50 border border-slate-200 text-slate-700 font-black text-xs uppercase tracking-widest rounded-xl text-center hover:bg-slate-100 transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                                    <span class="material-symbols-outlined text-base">calendar_month</span> Ajukan Jadwal Survei
                                </a>
                            @else
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-center text-[11px] font-bold text-slate-400 italic">
                                    Pemesanan kost hanya tersedia untuk akun bertipe Mahasiswa STT NF.
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="w-full py-3.5 bg-[#004ac6] hover:bg-blue-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-lg shadow-blue-100 text-center transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                                <span class="material-symbols-outlined text-base">login</span> Login Untuk Memesan dan Survey
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection