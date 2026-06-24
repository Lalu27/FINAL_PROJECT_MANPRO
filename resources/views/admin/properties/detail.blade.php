@extends('layouts.admin')
@section('title', 'Detail Pengajuan Kost')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.properties.index') }}" class="text-slate-400 hover:text-slate-600"><span class="material-symbols-outlined">arrow_back</span></a>
        <h2 class="text-xl font-extrabold text-slate-900">Validasi Iklan Kost</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="h-48 bg-slate-100 flex items-center justify-center text-slate-300 border-b border-slate-100">
            @if($property->gambar)
                <img src="{{ asset('storage/' . $property->gambar) }}" class="w-full h-full object-cover">
            @else
                <span class="material-symbols-outlined text-5xl">maps_home_work</span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            <div>
                <h3 class="text-lg font-black text-slate-800">{{ $property->nama_properti }}</h3>
                <p class="text-xs font-bold text-[#004ac6] mt-1">Rp {{ number_format($property->harga_bulanan, 0, ',', '.') }} / Bulan</p>
            </div>
            <div class="text-xs space-y-2 border-t border-slate-50 pt-4">
                <p class="font-bold text-slate-400 uppercase">Pemilik: <span class="text-slate-700 font-black normal-case">{{ $property->owner->nama }}</span></p>
                <p class="font-bold text-slate-400 uppercase">Alamat Lokasi:</p>
                <p class="text-slate-600 font-medium normal-case leading-relaxed">{{ $property->alamat }}</p>
                <p class="font-bold text-slate-400 uppercase mt-2">Deskripsi Fasilitas:</p>
                <p class="text-slate-600 font-medium normal-case leading-relaxed">{{ $property->deskripsi }}</p>
            </div>
            <form action="{{ route('admin.properties.verify', $property->id) }}" method="POST" class="pt-2">
                @csrf @method('PUT')
                <input type="hidden" name="approve" value="1">
                <button class="w-full bg-[#004ac6] hover:bg-[#003bb0] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider cursor-pointer">Loloskan & Tayangkan Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection