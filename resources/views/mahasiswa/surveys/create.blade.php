@extends('layouts.app')
@section('title', 'Form Pengajuan Survei - StayFind')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-[#f8f9ff] min-h-screen pb-24 animate__animated animate__fadeIn">
    <main class="max-w-[1200px] mx-auto px-4 md:px-6 py-6 space-y-6">
        
        <div class="py-2">
            <a href="javascript:history.back()" class="text-xs text-[#004ac6] font-black flex items-center gap-1.5 w-fit hover:underline group tracking-wider">
                <span class="material-symbols-outlined text-sm transition-transform group-hover:-translate-x-0.5">arrow_back</span> 
                KEMBALI KE DETAIL KOST
            </a>
        </div>

        <div class="max-w-2xl mx-auto bg-white p-6 md:p-8 rounded-3xl border border-slate-200/60 shadow-md">
            
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-50 text-[#004ac6] rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">calendar_month</span>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 tracking-tight">Form Pengajuan Survei Lokasi</h2>
                    <p class="text-xs text-slate-400 font-medium">Tentukan rencana tanggal kedatangan kunjungan Anda ke lokasi hunian.</p>
                </div>
            </div>

            <form action="{{ route('mahasiswa.surveys.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div class="p-4 bg-slate-50/70 rounded-2xl border border-slate-100 flex gap-4 items-center">
                    @if($property->gambar)
                        <img src="{{ asset('storage/' . $property->gambar) }}" class="w-20 h-20 object-cover rounded-xl border border-slate-200/40 shadow-sm" alt="{{ $property->nama_properti }}">
                    @else
                        <div class="w-20 h-20 bg-slate-100 border border-slate-200/40 rounded-xl flex flex-col items-center justify-center text-slate-300">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'wght' 200;">bed</span>
                        </div>
                    @endif
                    <div class="text-xs flex-1 space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full {{ $property->tipe_hunian === 'putri' ? 'bg-rose-50 text-rose-600' : ($property->tipe_hunian === 'putra' ? 'bg-blue-50 text-[#004ac6]' : 'bg-purple-50 text-purple-600') }}">
                                Kost {{ $property->tipe_hunian ?? 'Campur' }}
                            </span>
                        </div>
                        <p class="font-black text-sm text-slate-800 tracking-tight leading-snug">{{ $property->nama_properti }}</p>
                        <p class="text-slate-400 font-medium line-clamp-1 flex items-center gap-1"><span class="material-symbols-outlined text-sm text-[#004ac6]">location_on</span> {{ $property->alamat }}</p>
                        <p class="text-[#004ac6] font-black text-sm pt-0.5">Rp {{ number_format($property->harga_bulanan, 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-medium"> / bulan</span></p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Pilih Rencana Tanggal Kunjungan</label>
                    <div class="relative flex items-center">
                        <input type="date" name="tanggal_survei" value="{{ old('tanggal_survei', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#004ac6] focus:bg-white text-xs font-bold text-slate-700 @error('tanggal_survei') border-red-500 @enderror">
                    </div>
                    @error('tanggal_survei') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="p-4 bg-amber-50/60 rounded-2xl border border-amber-200/40 flex gap-2.5 items-start">
                    <span class="material-symbols-outlined text-amber-600 text-lg" style="font-variation-settings: 'FILL' 1;">info</span>
                    <div class="text-[11px] text-amber-800 font-medium leading-relaxed">
                        <p class="font-bold">Informasi Kunjungan Lapangan:</p>
                        <p class="mt-0.5">Setelah dikirim, harap pantau halaman <strong>Survei Lokasi</strong> secara berkala guna melihat kesediaan waktu luang pemilik hunian (Owner) untuk menemani Anda melihat kamar kost.</p>
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <a href="javascript:history.back()" class="w-1/3 py-3.5 bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center hover:bg-slate-200 transition-all active:scale-[0.99]">Batal</a>
                    <button type="submit" class="w-2/3 py-3.5 bg-[#004ac6] hover:bg-blue-700 text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-md shadow-blue-100 active:scale-[0.98] transition-all cursor-pointer">Kirim Jadwal Survei</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection