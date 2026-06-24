@extends('layouts.admin')
@section('title', 'Review Moderation')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="space-y-6 animate__animated animate__fadeIn">
    <div class="flex items-center gap-3 py-2">
        <div class="p-2 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center shadow-sm">
            <span class="material-symbols-outlined text-xl">gavel</span>
        </div>
        <div>
            <h2 class="text-xl font-black text-gray-900 tracking-tight">Antrean Moderasi Ulasan</h2>
            <p class="text-xs text-slate-400 font-medium">Saring ulasan atau komentar kasar mahasiswa demi kenyamanan komunitas StayFind.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-500">Daftar Komentar Masuk</h3>
            <span class="text-[10px] bg-slate-200 text-slate-700 font-bold px-2 py-0.5 rounded-full">{{ $reviews->count() }} Antrean</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 text-[10px] font-black uppercase tracking-wider text-slate-400 border-b border-slate-100">
                        <th class="p-4 pl-6 w-1/5">Pengirim</th>
                        <th class="p-4 w-1/4">Kost Tujuan</th>
                        <th class="p-4">Isi Komentar</th>
                        <th class="p-4 pr-6 text-center w-1/6">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse($reviews as $review)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="p-4 pl-6">
                                <div class="flex flex-col">
                                    <span class="font-extrabold text-slate-800">{{ $review->user->nama ?? 'Anonymous' }}</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Role: {{ $review->user->role ?? 'mahasiswa' }}</span>
                                </div>
                            </td>

                            <td class="p-4">
                                <span class="font-bold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-lg text-[11px]">
                                    {{ $review->property->nama_properti ?? 'Kost Terhapus' }}
                                </span>
                            </td>

                            <td class="p-4 text-slate-500 italic max-w-md break-words">
                                "{{ $review->komentar }}"
                            </td>

                            <td class="p-4 pr-6 text-center">
                                <form action="{{ route('admin.moderation.hide', $review->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin melakukan TAKE DOWN / menyembunyikan ulasan ini?')">
                                    @csrf 
                                    @method('PUT')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 hover:bg-red-600 border border-red-200 text-red-600 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-wider transition-all cursor-pointer shadow-sm hover:shadow-red-100">
                                        <span class="material-symbols-outlined text-xs">visibility_off</span>
                                        Take Down
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-slate-400 font-bold">
                                <div class="inline-flex p-3 bg-slate-50 text-slate-300 rounded-full mb-2">
                                    <span class="material-symbols-outlined text-2xl">verified_user</span>
                                </div>
                                <p class="text-xs text-slate-400">Belum ada ulasan yang masuk ke dalam sistem.</p>
                            </td>
                        </tr>
                    @endforelse </tbody>
            </table>
        </div>
    </div>
</div>
@endsection