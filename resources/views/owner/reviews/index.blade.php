@extends('layouts.owner')
@section('title', 'Ulasan Penghuni')

@section('content')
<link class="animate-css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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
        
        <section class="py-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Ulasan & Umpan Balik Penghuni</h2>
            <p class="text-sm text-gray-500 mt-1">Pantau testimoni, kritik, dan tingkat kepuasan mahasiswa terhadap fasilitas kamar kost Anda.</p>
        </section>

        <section class="mb-8">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm space-y-4">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-3">Testimoni Kamar Kost Saya</h3>
                
                <div class="divide-y divide-slate-100">
                    @forelse($reviews as $rev)
                        <div class="py-5 first:pt-2 last:pb-2 flex justify-between items-start gap-4 transition-colors hover:bg-slate-50/30 px-2 rounded-xl">
                            <div class="space-y-1.5 flex-1">
                                <p class="text-xs font-bold text-gray-900">
                                    {{ $rev->user->nama }} 
                                    <span class="font-medium text-slate-400 text-[11px] ml-1">di {{ $rev->property->nama_properti }}</span>
                                </p>
                                <p class="text-xs text-gray-600 leading-relaxed italic bg-slate-50/50 p-3 rounded-xl border border-slate-100/50 block w-full">
                                    "{!! e($rev->komentar) !!}"
                                </p>
                            </div>
                            
                            <div class="flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200/50 px-2.5 py-1 rounded-full font-black text-[11px] shrink-0 shadow-sm">
                                <span class="material-symbols-outlined text-amber-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span> 
                                {{ number_format($rev->rating, 1) }}
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center">
                            <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full mb-3">
                                <span class="material-symbols-outlined text-3xl">star_half</span>
                            </div>
                            <p class="text-xs font-bold text-slate-400">Properti kost Anda belum menerima ulasan bintang dari mahasiswa.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

    </main>
</div>
@endsection