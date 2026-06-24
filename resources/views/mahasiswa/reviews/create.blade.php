@extends('layouts.mahasiswa')
@section('title', 'Tulis Ulasan Kost')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="max-w-2xl mx-auto space-y-6 pb-12 animate__animated animate__fadeIn">
    <div class="flex items-center gap-3">
        <a href="{{ route('mahasiswa.bookings.index') }}" class="p-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-600 rounded-xl transition-all flex items-center justify-center shadow-sm">
            <span class="material-symbols-outlined text-sm font-bold">arrow_back</span>
        </a>
        <div>
            <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Berikan Ulasan Kamar Kost</h2>
            <p class="text-xs text-slate-400 font-medium">Bagikan pengalaman nyata Anda tinggal di properti ini.</p>
        </div>
    </div>

    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100/50 p-4 rounded-2xl flex items-center gap-4">
        <div class="p-3 bg-white text-[#004ac6] rounded-xl material-symbols-outlined text-2xl shadow-sm">
            night_shelter
        </div>
        <div>
            <span class="text-[9px] font-black uppercase text-blue-500 tracking-wider block">Anda sedang mengulas:</span>
            <h4 class="font-extrabold text-slate-800 text-sm">{{ $property->nama_properti }}</h4>
            <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $property->alamat }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
        <form action="{{ route('mahasiswa.reviews.store') }}" method="POST" class="space-y-5 m-0" x-data="{ rating: 5 }">
            @csrf
            <input type="hidden" name="property_id" value="{{ $property->id }}">

            <div class="space-y-1.5">
                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block">Rating Fasilitas & Layanan</label>
                <div class="flex items-center gap-1.5">
                    <template x-for="i in 5">
                        <button type="button" @click="rating = i" class="cursor-pointer focus:outline-none transition-transform active:scale-125">
                            <span class="material-symbols-outlined text-3xl" 
                                  :class="i <= rating ? 'text-amber-400' : 'text-slate-200'"
                                  :style="i <= rating && 'font-variation-settings: \'FILL\' 1;'">star</span>
                        </button>
                    </template>
                    <input type="hidden" name="rating" :value="rating">
                </div>
            </div>

            <div class="space-y-1.5">
                <label for="komentar" class="text-[10px] font-black uppercase tracking-widest text-slate-400 block">Isi Testimoni / Komentar</label>
                <textarea id="komentar" name="komentar" rows="5" required
                          class="w-full text-xs font-medium p-4 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:border-[#004ac6] focus:bg-white transition-all placeholder:text-slate-400 leading-relaxed"
                          placeholder="Ceritakan kondisi kamar, keramahan pemilik kost, kestabilan jaringan internet WiFi, kebersihan lingkungan, atau kemudahan akses lokasi..."></textarea>
            </div>

            <div class="flex gap-3 pt-2 border-t border-slate-50">
                <a href="{{ route('mahasiswa.bookings.index') }}" class="w-1/3 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition-colors text-center block">
                    Kembali
                </a>
                <button type="submit" class="w-2/3 bg-[#004ac6] hover:bg-[#003bb0] text-white font-black py-3 rounded-xl text-xs uppercase tracking-widest shadow-md shadow-blue-100 transition-all cursor-pointer">
                    Kirim Ulasan Resmi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection