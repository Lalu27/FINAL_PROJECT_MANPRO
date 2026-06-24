@extends('layouts.mahasiswa')
@section('title', 'Ulasan Saya')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto pb-12">
    
    <div>
        <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Manajemen Ulasan Kost</h2>
        <p class="text-xs text-slate-400 font-medium">Berikan penilaian jujur untuk membantu mahasiswa STT NF lainnya menemukan hunian terbaik.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm flex items-center gap-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl material-symbols-outlined text-2xl shadow-sm">
                rate_review
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block">Total Kontribusi</span>
                <span class="text-xl font-black text-slate-800">{{ $reviews->count() }} Testimoni</span>
            </div>
        </div>

        <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm flex items-center gap-4">
            <div class="p-3 bg-blue-50 text-[#004ac6] rounded-xl material-symbols-outlined text-2xl shadow-sm" style="font-variation-settings: 'FILL' 1;">
                star
            </div>
            <div>
                <span class="text-[10px] font-black uppercase text-slate-400 tracking-wider block">Rata-rata Rating</span>
                <span class="text-xl font-black text-slate-800 flex items-center gap-1">
                    {{ number_format($reviews->avg('rating') ?? 0.0, 1) }} 
                    <span class="text-xs font-normal text-slate-400">/ 5.0</span>
                </span>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-900 to-blue-950 p-5 rounded-2xl shadow-sm text-white flex flex-col justify-between min-h-[100px]">
            <span class="text-[9px] font-black uppercase tracking-widest text-blue-300">Sistem StayFind</span>
            <p class="text-[11px] text-slate-300 leading-relaxed font-medium">Ulasan kamu akan langsung tampil di halaman pencarian setelah disetujui oleh tim admin.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-sm font-bold text-slate-400">history</span>
                Histori Testimoni & Rating Anda
            </h3>
            <span class="text-[10px] font-bold text-slate-400 bg-white border border-slate-100 px-2 py-0.5 rounded-md">Terurut Terbaru</span>
        </div>

        <div class="divide-y divide-slate-100 px-6">
            
            @forelse($reviews as $review)
                <div class="py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 group transition-colors duration-150">
                    <div class="space-y-2 flex-1">
                        <div class="flex items-center gap-2.5">
                            <h4 class="font-extrabold text-slate-800 text-sm group-hover:text-[#004ac6] transition-colors">
                                {{ $review->property->nama_properti ?? 'Kost Terdaftar' }}
                            </h4>
                            
                            @if($review->is_approved_by_admin)
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 bg-green-50 text-green-600 rounded-md font-black text-[9px] uppercase tracking-wide border border-green-100/50">
                                    <span class="material-symbols-outlined text-[10px] font-bold">verified</span> Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 bg-amber-50 text-amber-600 rounded-md font-black text-[9px] uppercase tracking-wide border border-amber-100/50">
                                    <span class="material-symbols-outlined text-[10px] font-bold">pending</span> Pending
                                </span>
                            @endif
                        </div>
                        
                        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 relative max-w-2xl">
                            <p class="text-xs font-medium text-slate-600 leading-relaxed italic">
                                "{{ $review->komentar }}"
                            </p>
                        </div>

                        <p class="text-[10px] text-slate-400 font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">schedule</span>
                            Dikirim pada {{ $review->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-1 bg-amber-50 border border-amber-100/50 px-3 py-1.5 rounded-xl text-amber-700 font-bold shrink-0 self-start sm:self-center">
                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="text-xs font-black">{{ number_format($review->rating, 1) }}</span>
                    </div>
                </div>
            @empty
                <div class="p-16 text-center text-xs font-bold text-slate-400">
                    <span class="material-symbols-outlined text-4xl block mb-2 text-slate-300">rate_review</span>
                    Anda belum pernah memberikan ulasan untuk kost apapun.
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection