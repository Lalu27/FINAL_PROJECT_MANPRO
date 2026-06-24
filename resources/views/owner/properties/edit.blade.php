@extends('layouts.owner')
@section('title', 'Edit Data Kost')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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

<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-2xl mx-auto px-4 py-6">
        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-200/60 shadow-md">
            
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-50 text-[#4648d4] rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">edit_note</span>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-900 tracking-tight">Perbarui Informasi Kost</h2>
                    <p class="text-xs text-slate-400 font-medium">Ubah detail unit hunian StayFind milik Anda dengan data terbaru.</p>
                </div>
            </div>
            
            <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf 
                @method('PUT')
                
                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Nama Properti / Unit Kost</label>
                    <input type="text" name="nama_properti" value="{{ old('nama_properti', $property->nama_properti) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-bold text-slate-700 @error('nama_properti') border-red-500 @enderror">
                    @error('nama_properti') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Harga Bulanan (Rp)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-xs font-black text-slate-400">Rp</span>
                            <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan', $property->harga_bulanan) }}" required class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-bold text-slate-700 @error('harga_bulanan') border-red-500 @enderror">
                        </div>
                        @error('harga_bulanan') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- 🌟 PERBAIKAN SINKRONISASI DATA KAMAR TERSEDIA -->
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Kamar Tersedia Saat Ini</label>
                        <!-- Menggunakan ?? 1 agar data lama yang bernilai NULL/kosong di database otomatis menampilkan angka awal -->
                        <input type="number" name="kamar_tersedia" value="{{ old('kamar_tersedia', $property->kamar_tersedia ?? 1) }}" min="0" required placeholder="Contoh: 5" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-bold text-slate-700 @error('kamar_tersedia') border-red-500 @enderror">
                        @error('kamar_tersedia') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Tipe Hunian Kost</label>
                    <select name="tipe_hunian" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-bold text-slate-700">
                        <option value="Putra" {{ old('tipe_hunian', $property->tipe_hunian) === 'Putra' || old('tipe_hunian', $property->tipe_hunian) === 'putra' ? 'selected' : '' }}>Kost Putra</option>
                        <option value="Putri" {{ old('tipe_hunian', $property->tipe_hunian) === 'Putri' || old('tipe_hunian', $property->tipe_hunian) === 'putri' ? 'selected' : '' }}>Kost Putri</option>
                        <option value="Campur" {{ old('tipe_hunian', $property->tipe_hunian) === 'Campur' || old('tipe_hunian', $property->tipe_hunian) === 'campur' ? 'selected' : '' }}>Kost Campur</option>
                    </select>
                </div>

                <div class="space-y-1.5" x-data="{ preview: null }">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Foto Kamar Kost</label>
                    
                    @if($property->gambar)
                        <div class="mb-2 text-xs font-medium text-slate-400 flex items-center gap-2">
                            <img src="{{ asset('storage/' . $property->gambar) }}" class="w-20 h-14 object-cover rounded-lg border border-slate-200" alt="Foto Lama">
                            <span>Foto saat ini (Akan diganti jika Anda mengunggah foto baru)</span>
                        </div>
                    @endif

                    <input type="file" name="gambar" accept="image/*" @change="const file = $event.target.files[0]; if(file) { preview = URL.createObjectURL(file) }" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-[#4648d4] hover:file:bg-blue-100 cursor-pointer @error('gambar') border-red-500 @enderror">
                    
                    <template x-if="preview">
                        <div class="mt-2">
                            <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Pratinjau Foto Baru:</p>
                            <img :src="preview" class="w-40 h-28 object-cover rounded-xl border border-dashed border-slate-300">
                        </div>
                    </template>
                    @error('gambar') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Deskripsi Kamar</label>
                    <textarea name="deskripsi" rows="3" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-medium text-slate-600 leading-relaxed">{{ old('deskripsi', $property->deskripsi) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider block mb-1">Daftar Fasilitas Kost</label>
                    <div class="flex flex-wrap gap-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                        @php 
                            $dbFasilitas = explode(', ', $property->fasilitas ?? '');
                            $oldFasilitas = old('fasilitas', $dbFasilitas);
                        @endphp
                        <label class="inline-flex items-center text-xs font-bold text-slate-700 cursor-pointer"><input type="checkbox" name="fasilitas[]" value="WiFi" {{ in_array('WiFi', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> WiFi</label>
                        <label class="inline-flex items-center text-xs font-bold text-slate-700 cursor-pointer"><input type="checkbox" name="fasilitas[]" value="AC" {{ in_array('AC', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> AC</label>
                        <label class="inline-flex items-center text-xs font-bold text-slate-700 cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam" {{ in_array('Kamar Mandi Dalam', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> KM Dalam</label>
                        <label class="inline-flex items-center text-xs font-bold text-slate-700 cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Dapur" {{ in_array('Dapur', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> Dapur</label>
                        <label class="inline-flex items-center text-xs font-bold text-slate-700 cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Parkir" {{ in_array('Parkir', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> Parkir</label>
                    </div>
                    @error('fasilitas') <p class="text-[10px] text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Alamat Kost Lengkap</label>
                    <textarea name="alamat" rows="2" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-[#4648d4] focus:bg-white text-xs font-medium text-slate-600 leading-relaxed">{{ old('alamat', $property->alamat) }}</textarea>
                </div>

                <div class="pt-2 flex gap-3">
                    <a href="{{ route('owner.properties.index') }}" class="w-1/3 py-3.5 bg-slate-100 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl text-center hover:bg-slate-200">Batal</a>
                    <button type="submit" class="w-2/3 py-3.5 bg-[#4648d4] text-white font-black text-xs uppercase tracking-widest rounded-xl shadow-md hover:bg-opacity-95 active:scale-[0.98] transition-all cursor-pointer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection