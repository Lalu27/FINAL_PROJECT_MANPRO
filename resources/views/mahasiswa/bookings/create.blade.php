@extends('layouts.mahasiswa')
@section('title', 'Form Pemesanan Kost - StayFind')

@section('content')
<div class="bg-[#f8f9ff] min-h-screen py-10">
    <div class="max-w-xl mx-auto bg-white p-6 md:p-8 rounded-3xl border border-slate-200/60 shadow-md">
        
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-blue-50 text-[#004ac6] rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-xl">receipt_long</span>
            </div>
            <div>
                <h2 class="text-xl font-black text-gray-900 tracking-tight">Form Konfirmasi Pemesanan</h2>
                <p class="text-xs text-slate-400 font-medium">Lengkapi data masa sewa Anda untuk unit <strong>{{ $property->nama_properti }}</strong></p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.bookings.store') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Input Hidden ID Properti -->
            <input type="hidden" name="property_id" value="{{ $property->id }}">

            <!-- Info Singkat Kost -->
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex gap-3 items-center">
                @if($property->gambar)
                    <img src="{{ asset('storage/' . $property->gambar) }}" class="w-16 h-16 object-cover rounded-xl">
                @endif
                <div class="text-xs">
                    <p class="font-black text-slate-800">{{ $property->nama_properti }}</p>
                    <p class="text-slate-400 mt-0.5">{{ $property->alamat }}</p>
                    <p class="text-[#004ac6] font-bold mt-1">Rp {{ number_format($property->harga_bulanan, 0, ',', '.') }} / bulan</p>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Durasi Sewa (Bulan)</label>
                <div class="relative flex items-center">
                    <input type="number" name="durasi_sewa" value="1" min="1" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#004ac6] focus:bg-white text-xs font-bold text-slate-700 @error('durasi_sewa') border-red-500 @enderror">
                    <span class="absolute right-4 text-xs font-bold text-slate-400">Bulan</span>
                </div>
                @error('durasi_sewa') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-2 flex gap-3">
                <a href="javascript:history.back()" class="w-1/3 py-3.5 bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center hover:bg-slate-200">Batal</a>
                <button type="submit" class="w-2/3 py-3.5 bg-[#004ac6] text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-md hover:bg-opacity-95 active:scale-[0.98] transition-all cursor-pointer">Ajukan Pesanan</button>
            </div>
        </form>
    </div>
</div>
@endsection