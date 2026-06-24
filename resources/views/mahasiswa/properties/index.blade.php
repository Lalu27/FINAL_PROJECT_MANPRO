@extends('layouts.mahasiswa')
@section('title', 'Jelajah Pilihan Hunian')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="space-y-6 w-full animate__animated animate__fadeIn">
    
    <form action="{{ route('mahasiswa.index') }}" method="GET" id="formPencarianInternal">
        
        <div class="bg-white p-2.5 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col sm:flex-row items-center gap-2 focus-within:ring-4 focus-within:ring-primary/10 transition-all duration-300">
            <div class="flex items-center flex-1 w-full px-3 gap-3">
                <span class="material-symbols-outlined text-primary text-xl font-bold">search</span>
                <input name="search" value="{{ request('search') }}" id="inputSearchText" class="w-full bg-transparent border-none text-xs font-semibold py-3 text-slate-700 outline-none placeholder:text-slate-400 focus:ring-0" placeholder="Ketik nama area, alamat, atau fasilitas kost..." type="text"/>
                
                @if(request('tipe'))
                    <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                @endif
            </div>
            <button type="submit" class="w-full sm:w-auto bg-primary text-on-primary px-8 py-3.5 rounded-xl text-xs font-extrabold uppercase tracking-widest active:scale-95 duration-200 transition-all shadow-md shadow-blue-100 cursor-pointer whitespace-nowrap">
                Temukan Unit
            </button>
        </div>

        <div class="pt-2">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-[10px] font-black tracking-widest uppercase text-slate-400">Pencarian Berdasarkan Wilayah</h3>
                @if(request('search') || request('tipe'))
                    <a href="{{ route('mahasiswa.index') }}" class="text-[10px] font-bold text-red-500 hover:text-red-600 flex items-center gap-0.5 transition-all">
                        <span class="material-symbols-outlined text-xs">close</span> Bersihkan Filter
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <div onclick="pilihWilayahDanCari('Srengseng Sawah')" class="bg-white hover:bg-blue-50/50 p-3.5 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                    <span class="material-symbols-outlined text-blue-500 bg-blue-50 p-2 rounded-lg group-hover:bg-white transition-colors">domain</span>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Srengseng Sawah</h5>
                        <p class="text-[9px] font-medium text-slate-400">Dekat Kampus A</p>
                    </div>
                </div>
                <div onclick="pilihWilayahDanCari('Kelapa Dua')" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                    <span class="material-symbols-outlined text-purple-500 bg-purple-50 p-2 rounded-lg group-hover:bg-white transition-colors">holiday_village</span>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Kelapa Dua</h5>
                        <p class="text-[9px] font-medium text-slate-400">Akses Cepat & Strategis</p>
                    </div>
                </div>
                <div onclick="pilihWilayahDanCari('Margonda')" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                    <span class="material-symbols-outlined text-amber-500 bg-amber-50 p-2 rounded-lg group-hover:bg-white transition-colors">storefront</span>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Margonda Raya</h5>
                        <p class="text-[9px] font-medium text-slate-400">Pusat Kuliner & Kafe</p>
                    </div>
                </div>
                <div onclick="pilihWilayahDanCari('Lenteng Agung')" class="bg-white hover:bg-blue-50/50 p-4 rounded-xl border border-slate-100 shadow-sm cursor-pointer transition-all flex items-center gap-3 group">
                    <span class="material-symbols-outlined text-emerald-500 bg-emerald-50 p-2 rounded-lg group-hover:bg-white transition-colors">train</span>
                    <div>
                        <h5 class="text-xs font-bold text-slate-800">Lenteng Agung</h5>
                        <p class="text-[9px] font-medium text-slate-400">Dekat Stasiun KRL</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4">
            <div class="flex items-center gap-2.5 overflow-x-auto pb-2 border-b border-slate-100">
                <a href="{{ route('mahasiswa.index', array_merge(request()->except('tipe'), ['tipe' => 'all'])) }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 {{ !request('tipe') || request('tipe') === 'all' ? 'bg-primary text-on-primary shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50' }}">
                    <span class="material-symbols-outlined text-base">grid_view</span> Semua Tipe Kost
                </a>
                <a href="{{ route('mahasiswa.index', array_merge(request()->except('tipe'), ['tipe' => 'putra'])) }}" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider {{ request('tipe') === 'putra' ? 'bg-primary text-on-primary shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50' }}">
                    👨‍🎓 Khusus Putra
                </a>
                <a href="{{ route('mahasiswa.index', array_merge(request()->except('tipe'), ['tipe' => 'putri'])) }}" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider {{ request('tipe') === 'putri' ? 'bg-primary text-on-primary shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50' }}">
                    👩‍🎓 Khusus Putri
                </a>
                <a href="{{ route('mahasiswa.index', array_merge(request()->except('tipe'), ['tipe' => 'campur'])) }}" class="px-5 py-2.5 rounded-xl text-xs font-bold shrink-0 transition-all duration-200 uppercase tracking-wider {{ request('tipe') === 'campur' ? 'bg-primary text-on-primary shadow-md shadow-blue-100' : 'bg-white text-slate-500 border border-slate-200/50 hover:bg-slate-50' }}">
                    👫 Kost Campur
                </a>
            </div>
        </div>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        @forelse($properties as $item)
            <div class="group bg-white rounded-2xl border border-slate-200/60 overflow-hidden shadow-sm flex flex-col h-full hover:shadow-xl hover:scale-[1.01] duration-300">
                
                <div class="h-44 bg-slate-50 flex items-center justify-center text-slate-300 relative shrink-0 overflow-hidden">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-1">
                            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'wght' 100;">bed</span>
                        </div>
                    @endif
                    
                    <button x-data="{ fav: false }" @click="fav = !fav" :class="fav ? 'text-error animate__animated animate__heartBeat' : 'text-slate-600'" class="absolute top-3 right-3 p-1.5 rounded-full bg-white/90 backdrop-blur-sm shadow-sm cursor-pointer hover:bg-white flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm" :style="fav && 'font-variation-settings: \'FILL\' 1;'">favorite</span>
                    </button>

                    <div class="absolute bottom-3 left-3">
                        @if(strtolower($item->tipe_hunian) === 'putri')
                            <span class="bg-pink-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Putri</span>
                        @elseif(strtolower($item->tipe_hunian) === 'putra')
                            <span class="bg-blue-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Putra</span>
                        @else
                            <span class="bg-purple-500 text-white px-2.5 py-1 rounded-md font-black text-[9px] uppercase tracking-widest shadow-sm">Campur</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 flex flex-col flex-grow justify-between gap-4">
                    <div class="space-y-2">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-1 group-hover:text-primary transition-colors">
                                {{ $item->nama_properti }}
                            </h3>
                            <div class="flex items-center gap-0.5 bg-amber-50 border border-amber-100/50 px-1.5 py-0.5 rounded-md text-amber-700 font-bold shrink-0">
                                <span class="material-symbols-outlined text-[11px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-[9px] font-black">4.9</span>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-500 line-clamp-1 flex items-start gap-0.5">
                            <span class="material-symbols-outlined text-xs text-primary shrink-0 mt-0.5">location_on</span>
                            <span>{{ $item->alamat }}</span>
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex justify-between items-center shrink-0">
                        <div class="flex flex-col">
                            <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">Harga Bulanan</span>
                            <span class="text-sm font-black text-primary">Rp {{ number_format($item->harga_bulanan, 0, ',', '.') }}<span class="text-[10px] font-normal text-slate-400">/bln</span></span>
                        </div>
                        <a href="{{ route('mahasiswa.show', $item->id) }}" class="bg-primary text-on-primary text-[10px] font-black px-4 py-2.5 rounded-xl uppercase tracking-wider hover:bg-primary-container transition-all active:scale-95 shadow-sm shadow-blue-50">
                            Lihat Unit
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center p-16 text-slate-400 text-xs font-semibold bg-white rounded-2xl border border-slate-100 shadow-sm">
                Tidak ada pilihan properti kos dengan kriteria saat ini.
            </div>
        @endforelse
    </div>
</div>

<script>
    // Handler klik wilayah instan
    function pilihWilayahDanCari(namaWilayah) {
        let inputText = document.getElementById('inputSearchText');
        let formMaster = document.getElementById('formPencarianInternal');
        
        if(inputText && formMaster) {
            inputText.value = namaWilayah;
            formMaster.submit();
        }
    }
</script>
@endsection