@extends('layouts.owner')

@section('title', 'Daftarkan Kost Baru')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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
    <main class="max-w-3xl mx-auto px-4 py-6">
        
        <div class="mb-6">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Daftarkan Kost Baru Anda</h2>
            <p class="text-sm text-gray-500 mt-1">Isi detail kelayakan, fasilitas, dan gunakan peta picker interaktif di bawah.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6 shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-1">
                    <span class="material-symbols-outlined text-sm">error</span>
                    <span>Gagal Mengajukan Kost, Periksa Kembali Isian Anda:</span>
                </div>
                <ul class="list-disc pl-6 text-xs space-y-0.5 text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owner.properties.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Properti/Kos</label>
                    <input type="text" name="nama_properti" value="{{ old('nama_properti') }}" required class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Tipe Hunian</label>
                    <select name="tipe_hunian" required class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="Putra" {{ old('tipe_hunian') == 'Putra' ? 'selected' : '' }}>Putra</option>
                        <option value="Putri" {{ old('tipe_hunian') == 'Putri' ? 'selected' : '' }}>Putri</option>
                        <option value="Campur" {{ old('tipe_hunian') == 'Campur' ? 'selected' : '' }}>Campur</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Harga Sewa Bulanan (Rp)</label>
                    <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}" required placeholder="Contoh: 1500000" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Kamar Tersedia Saat Ini</label>
                    <input type="number" name="kamar_tersedia" value="{{ old('kamar_tersedia') }}" required placeholder="Contoh: 5" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase mb-1 tracking-wider">Pilihan Fasilitas Kos</label>
                <div class="flex flex-wrap gap-4 p-3 bg-gray-50 rounded-xl border border-gray-200">
                    @php $oldFasilitas = old('fasilitas', []); @endphp
                    <label class="inline-flex items-center text-sm cursor-pointer"><input type="checkbox" name="fasilitas[]" value="WiFi" {{ in_array('WiFi', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> WiFi</label>
                    <label class="inline-flex items-center text-sm cursor-pointer"><input type="checkbox" name="fasilitas[]" value="AC" {{ in_array('AC', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> AC</label>
                    <label class="inline-flex items-center text-sm cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam" {{ in_array('Kamar Mandi Dalam', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> KM Dalam</label>
                    <label class="inline-flex items-center text-sm cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Dapur" {{ in_array('Dapur', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> Dapur</label>
                    <label class="inline-flex items-center text-sm cursor-pointer"><input type="checkbox" name="fasilitas[]" value="Parkir" {{ in_array('Parkir', $oldFasilitas) ? 'checked' : '' }} class="rounded border-gray-300 mr-1.5 text-indigo-600"> Parkir</label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi Tambahan Kost</label>
                <textarea name="deskripsi" rows="3" required placeholder="Tuliskan peraturan kos, fasilitas sekitar, dll..." class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Alamat Lengkap Kos (Teks)</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" required placeholder="Jalan, RT/RW, Kecamatan, Kota" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 uppercase tracking-wider">Foto/Gambar Properti Kost</label>
                <input type="file" name="gambar" accept="image/*" required class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 outline-none">
                <p class="text-[10px] text-gray-400 mt-1">Format dokumen didukung: JPG, JPEG, PNG, WEBP (Maksimal 2MB).</p>
            </div>

            <div class="pt-2">
                <label class="block text-xs font-bold text-red-600 uppercase mb-1 tracking-wider">Tentukan Pin Koordinat Peta (Wajib Diklik Di Peta)</label>
                <div id="mapPicker" class="w-full h-60 rounded-xl border border-gray-300 z-0 shadow-inner"></div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400">Latitude</label>
                    <input type="text" name="latitude" id="latInput" value="{{ old('latitude') }}" readonly required class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-500 font-mono outline-none">
                </div>
                <div>
                    <label class="block text-[10px] uppercase font-bold text-gray-400">Longitude</label>
                    <input type="text" name="longitude" id="lngInput" value="{{ old('longitude') }}" readonly required class="w-full mt-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-500 font-mono outline-none">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition text-sm cursor-pointer">Ajukan Publikasi Kost</button>
        </form>
    </main>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map, marker;
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta di sekitar wilayah kampus utama STT-NF
        map = L.map('mapPicker').setView([-6.3529, 106.8327], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

        // Jika ada koordinat lama hasil redirect back old(), render marker secara otomatis
        var oldLat = "{{ old('latitude') }}";
        var oldLng = "{{ old('longitude') }}";
        if(oldLat && oldLng) {
            var oldLatLng = L.latLng(oldLat, oldLng);
            marker = L.marker(oldLatLng).addTo(map);
            map.setView(oldLatLng, 16);
        }

        // Event listener saat user mengklik peta
        map.on('click', function(e) {
            document.getElementById('latInput').value = e.latlng.lat;
            document.getElementById('lngInput').value = e.latlng.lng;
            if (marker) { 
                marker.setLatLng(e.latlng); 
            } else { 
                marker = L.marker(e.latlng).addTo(map); 
            }
        });
        setTimeout(function() { map.invalidateSize(); }, 400);
    });
</script>
@endsection